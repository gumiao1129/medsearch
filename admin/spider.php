<?php
include_once ('models/CI_model_TBS.php');

class spider {
    //put your code here
   protected $_url, $_level, $_site_id, $_md5sum, $_domain, $_indexdate, $_sessid, $_can_leave_domain, $_reindex, $_maxlevel, $_soption, $_url_inc, $_url_not_inc, $_db_obj;
    
    public function __construct($url, $reindex, $maxlevel, $soption, $url_inc, $url_not_inc, $can_leave_domain) 
    {
        $this->_url = $url;
        //$this->_level = $level;
        //$this->_site_id = $site_id;
        //$this->_md5sum = $md5sum;
       // $this->_domain = $domain;
       // $this->_indexdate = $indexdate;
        //$this->_sessid = $sessid;
        $this->_can_leave_domain = $can_leave_domain;
        $this->_reindex = $reindex;
        $this->_maxlevel= $maxlevel;
        $this->_soption = $soption;
        $this->_url_inc = $url_inc;
        $this->_url_not_inc = $url_not_inc;
        $this->_db_obj = new CI_model_TBS;
    }
    
    public function index_site()
    {
        	//global $command_line, $mainurl,  $tmp_urls, $domain_arr, $all_keywords;
                $all_keywords = Array();
                $url = $this->_url;
                $reindex = $this->_reindex;
                $maxlevel = $this->_maxlevel;
                $soption = $this->_soption;
                $url_inc = $this->_url_inc;
                $url_not_inc = $this->_url_not_inc;
                $can_leave_domain = $this->_can_leave_domain;
                
                
                if ($all_keywords == null) {
                        $table = "keywords"; $attributes = "keyword_ID, keyword"; $otherReq = null;
                        $result = $this->_db_obj->TBS_select($table, $attributes, $otherReq);
			//$result = mysql_query("select keyword_ID, keyword from ".$mysql_table_prefix."keywords");
			//echo mysql_error();
			foreach($result as $row) {
				$all_keywords[mysql_real_escape_string($row[1])] = $row[0];
			}
		}
                
		$compurl = parse_url($url);
                
		if ($compurl['path'] == '')
			$url = $url . "/";
	
		$t = microtime();
		$a =  getenv("REMOTE_ADDR");
		$sessid = md5 ($t.$a);
	
	
		$urlparts = parse_url($url);
	
		$domain = $urlparts['host'];
		if (isset($urlparts['port'])) {
			$port = (int)$urlparts['port'];
		}else {
			$port = 80;
		}

		$table = "sites"; $attributes = "site_id"; $otherReq = "url='$url'";
                $result = $this->_db_obj->TBS_select($table, $attributes, $otherReq);
		//$result = mysql_query("select site_id from ".$mysql_table_prefix."sites where url='$url'");
		//echo mysql_error();
		//$row = mysql_fetch_row($result);
		$site_id = $result[0][0];
		
		if ($site_id != "" && $reindex == 1) 
                {
                        $table = "temp"; $attributes = "link, level, id"; $content = "'$url', 0, '$sessid'";
                        $this->_db_obj->dbInsert($table, $attributes, $content);
			//mysql_query ("insert into ".$mysql_table_prefix."temp (link, level, id) values ('$url', 0, '$sessid')");
			//echo mysql_error();
                        $table = "links"; $attributes = "url, level"; $otherReq = "site_id = $site_id";
                        $result = $this->_db_obj->TBS_select($table, $attributes, $otherReq);
			//$result = mysql_query("select url, level from ".$mysql_table_prefix."links where site_id = $site_id");
			foreach($result as $row) 
                        {
				$site_link = $row['url'];
				$link_level = $row['level'];
				if ($site_link != $url) {
                                    $table = "temp"; $attributes = "link, level, id"; $content = "'$site_link', '$link_level', '$sessid'";
                                    $this->_db_obj->dbInsert($table, $attributes, $content);
				}
			}
                        
                        $table = 'sites'; $updateContent = "indexdate=now(), spider_depth = $maxlevel, required = '$url_inc', disallowed = '$url_not_inc', can_leave_domain='$can_leave_domain' where site_id=$site_id";
			$this->_db_obj->dbUpdate($table, $updateContent);
			//$qry = "update ".$mysql_table_prefix."sites set indexdate=now(), spider_depth = $maxlevel, required = '$url_inc'," .
			//		"disallowed = '$url_not_inc', can_leave_domain=$can_leave_domain where site_id=$site_id";
			//mysql_query ($qry);
			//echo mysql_error();
		} 
                else if ($site_id == '') 
                {
                        $table = "sites"; $attributes = "url, indexdate, spider_depth, required, disallowed, can_leave_domain"; 
                        $content = "'$url', now(), '$maxlevel', '$url_inc', '$url_not_inc', '$can_leave_domain'";
                        $this->_db_obj->dbInsert($table, $attributes, $content);
			//mysql_query ("insert into ".$mysql_table_prefix."sites (url, indexdate, spider_depth, required, disallowed, can_leave_domain) " .
			//		"values ('$url', now(), $maxlevel, '$url_inc', '$url_not_inc', $can_leave_domain)");
			//echo mysql_error();
                        $table = "sites"; $attributes = "site_id"; $otherReq = "url='$url'";
                        $result = $this->_db_obj->TBS_select($table, $attributes, $otherReq); 
			//$result = mysql_query("select site_ID from ".$mysql_table_prefix."sites where url='$url'");
			//$row = mysql_fetch_row($result);
			$site_id = $row[0];
		} 
                else 
                {
                        $table = 'sites'; $updateContent = "indexdate=now(), spider_depth = $maxlevel, required = '$url_inc', disallowed = '$url_not_inc', can_leave_domain='$can_leave_domain' where site_id=$site_id";
			$this->_db_obj->dbUpdate($table, $updateContent);   
			//mysql_query ("update ".$mysql_table_prefix."sites set indexdate=now(), spider_depth = $maxlevel, required = '$url_inc'," .
			//		"disallowed = '$url_not_inc', can_leave_domain=$can_leave_domain where site_id=$site_id");
			//echo mysql_error();
		}
	
                $table = "pending"; $attributes = "site_id, temp_id, level, count, num"; $otherReq = "site_id='$site_id'";
                $result = $this->_db_obj->TBS_select($table, $attributes, $otherReq); 
		//$result = mysql_query("select site_id, temp_id, level, count, num from ".$mysql_table_prefix."pending where site_id='$site_id'");
		//echo mysql_error();
		//$row = mysql_fetch_row($result);
		$pending = $result[0][0];
		$level = 0;
		$domain_arr = $this->get_domains();
		if ($pending == '') 
                {
                        $table = "temp"; $attributes = "link, level, id"; 
                        $content = "'$url', 0, '$sessid'";
                        $this->_db_obj->dbInsert($table, $attributes, $content);
                        
			//mysql_query ("insert into ".$mysql_table_prefix."temp (link, level, id) values ('$url', 0, '$sessid')");
			//echo mysql_error();
		} 
                else if ($pending != '') 
                {
			//printStandardReport('continueSuspended',$command_line);
                        $table = "pending"; $attributes = "temp_id, level, count"; $otherReq = "site_id='$site_id'";
                        $result = $this->_db_obj->TBS_select($table, $attributes, $otherReq); 
			//mysql_query("select temp_id, level, count from ".$mysql_table_prefix."pending where site_id='$site_id'");
			//echo mysql_error();
			$sessid = $result[1];
			$level = $result[2];
			$pend_count = $result[3] + 1;
			$num = $result[4];
			$pending = 1;
			$tmp_urls = $this->get_temp_urls($sessid);
		}
	
		if ($reindex != 1) 
                {
                    $table = "pending"; $attributes = "site_id, temp_id, level, count"; 
                    $content = "'$site_id', '$sessid', '0', '0'";
                    $this->_db_obj->dbInsert($table, $attributes, $content);
			//mysql_query ("insert into ".$mysql_table_prefix."pending (site_id, temp_id, level, count) values ('$site_id', '$sessid', '0', '0')");
			//echo mysql_error();
		}
	
	
		$time = time();
		$omit = $this->check_robot_txt($url);
	
		//printHeader ($omit, $url, $command_line);
	
	
		$mainurl = $url;
		$num = 0;
	
		while (($level <= $maxlevel && $soption == 'level') || ($soption == 'full')) {
			if ($pending == 1) {
				$count = $pend_count;
				$pending = 0;
			} else
				$count = 0;
	
			$links = array();
	
                        $table = "temp"; $attributes = "distinct link"; $otherReq = "level=$level && id='$sessid' order by link";
                        $result = $this->_db_obj->TBS_select($table, $attributes, $otherReq);
                        
			//$result = mysql_query("select distinct link from ".$mysql_table_prefix."temp where level=$level && id='$sessid' order by link");
			//echo mysql_error();
			//$rows = mysql_num_rows($result);
	
			if ($result == null) {
				break;
			}
	
			$i = 0;
	
			foreach($result as $row)  
                        {
                            $links[] = $row['link'];
			}
	
			reset ($links);
	
	
			while ($count < count($links)) {
				$num++;
				$thislink = $links[$count];
				$urlparts = parse_url($thislink);
				reset ($omit);
				$forbidden = 0;
				foreach ($omit as $omiturl) {
					$omiturl = trim($omiturl);
	
					$omiturl_parts = parse_url($omiturl);
					if ($omiturl_parts['scheme'] == '') {
						$check_omit = $urlparts['host'] . $omiturl;
					} else {
						$check_omit = $omiturl;
					}
	
					if (strpos($thislink, $check_omit)) {
						//printRobotsReport($num, $thislink, $command_line);
						$this->check_for_removal($thislink); 
						$forbidden = 1;
						break;
					}
				}
				
				if (!$this->check_include($thislink, $url_inc, $url_not_inc )) {
					//printUrlStringReport($num, $thislink, $command_line);
					$this->check_for_removal($thislink); 
					$forbidden = 1;
				} 
	
				if ($forbidden == 0) {
					//printRetrieving($num, $thislink, $command_line);
                                        $table = "links"; $attributes = "md5sum, indexdate"; $otherReq = "url='$thislink'";
                                        $result = $this->_db_obj->TBS_select($table, $attributes, $otherReq);
					//$query = "select md5sum, indexdate from ".$mysql_table_prefix."links where url='$thislink'";
					//$result = mysql_query($query);
					//echo mysql_error();
					//$rows = mysql_num_rows($result);
					if ($result == null) {
						$this->index_url($thislink, $level+1, $site_id, '',  $domain, '', $sessid, $can_leave_domain, $reindex, $all_keywords, $mainurl);
                                                
                                                $table = "pending"; $updateContent = "level = $level, count = $count, num = $num where site_id = $site_id";
                                                $this->_db_obj->dbUpdate($table, $updateContent);
						//mysql_query("update ".$mysql_table_prefix."pending set level = $level, count=$count, num=$num where site_id=$site_id");
						//echo mysql_error();
					}
                                        else if ($reindex == 1) 
                                        {
						$md5sum = $result[0]['md5sum'];
						$indexdate = $result[0]['indexdate'];
						$this->index_url($thislink, $level+1, $site_id, $md5sum,  $domain, $indexdate, $sessid, $can_leave_domain, $reindex, $all_keywords, $mainurl);
                                                
                                                $table = "pending"; $updateContent = "level = $level, count=$count, num=$num where site_id=$site_id";
                                                $this->_db_obj->dbUpdate($table, $updateContent);
						//mysql_query("update ".$mysql_table_prefix."pending set level = $level, count=$count, num=$num where site_id=$site_id");
						//echo mysql_error();
					}else {
						//printStandardReport('inDatabase',$command_line);
					}

				}
				$count++;
			}
			$level++;
		}
                
                $table = "temp"; $deleteContent = "id = '$sessid'";
                $this->_db_obj->dbDelete($table, $deleteContent);
		//mysql_query ("delete from ".$mysql_table_prefix."temp where id = '$sessid'");
		//echo mysql_error();
                
                $table = "pending"; $deleteContent = "site_id = '$site_id'";
                $this->_db_obj->dbDelete($table, $deleteContent);
		//mysql_query ("delete from ".$mysql_table_prefix."pending where site_id = '$site_id'");
		//echo mysql_error();
		//printStandardReport('completed',$command_line);
    }
    
 
    
    
    //They will be extends class
    
    private function index_url($url, $level, $site_id, $md5sum, $domain, $indexdate, $sessid, $can_leave_domain, $reindex, $all_keywords, $mainurl) 
    {
        $url_status = $this->url_status($url);

        $thislevel = $level - 1;
        
        if (strstr($url_status['state'], "Relocation")) 
        {
            $url = preg_replace("/ /", "", $this->url_purify($url_status['path'], $url, $can_leave_domain, $mainurl));
            
            if ($url != null) 
            {
                $table = "temp"; $attributes = "link"; $otherReq = "link='$url' && id = '$sessid'";
                $result = $this->_db_obj->TBS_select($table, $attributes, $otherReq);
		//$result = mysql_query("select link from ".$mysql_table_prefix."temp where link='$url' && id = '$sessid'");
		//echo mysql_error();
		//$rows = mysql_numrows($result);
		if ($result == null) 
                {
                    $table = "temp"; $attributes = "link, level, id"; $content = "'$url', '$level', '$sessid'";
                    $this->_db_obj->dbInsert($table, $attributes, $content);
                    //mysql_query ("insert into ".$mysql_table_prefix."temp (link, level, id) values ('$url', '$level', '$sessid')");
                    //echo mysql_error();
		}
            }
		$url_status['state'] == "redirected";
        }
        
                ini_set('max_execution_time', 300);
                
		if ($url_status['state'] == 'ok') {
			$OKtoIndex = 1;
			$file_read_error = 0;
			
//			if ((time() - $delay_time) < $min_delay) {
//				sleep ($min_delay- (time() - $delay_time));
//			}
			$delay_time = time();
			if (!$this->fst_lt_snd(phpversion(), "4.3.0")) {
				$file = file_get_contents($url);
				if ($file === FALSE) {
					$file_read_error = 1;
				}
			} else {
				$fl = @fopen($url, "r");
				if ($fl) {
					while ($buffer = @fgets($fl, 4096)) {
						$file .= $buffer;
					}
				} else {
					$file_read_error = 1;
				}

				fclose ($fl);
			}
			if ($file_read_error) {
				$contents = $this->getFileContents($url);
				$file = $contents['file'];
			}
			

			$pageSize = number_format(strlen($file)/1024, 2, ".", "");
			//printPageSizeReport($pageSize);

			if ($url_status['content'] != 'text') {
				$file = $this->extract_text($file, $url_status['content']);
			}

			//printStandardReport('starting', $command_line);
		

			$newmd5sum = md5($file);
			

			if ($md5sum == $newmd5sum) {
				//printStandardReport('md5notChanged',$command_line);
				$OKtoIndex = 0;
			} else if ($this->isDuplicateMD5($newmd5sum)) {
				$OKtoIndex = 0;
				//printStandardReport('duplicate',$command_line);
			}

			if (($md5sum != $newmd5sum || $reindex ==1) && $OKtoIndex == 1) {
				$urlparts = parse_url($url);
				$newdomain = $urlparts['host'];
				$type = 0;
				
				// remove link to css file
				//get all links from file
				$data = $this->clean_file($file, $url, $url_status['content']);

				if ($data['noindex'] == 1) {
					$OKtoIndex = 0;
					$deletable = 1;
					//printStandardReport('metaNoindex',$command_line);
				}
	

				$wordarray = $this->unique_array(explode(" ", $data['content']));
	
				if ($data['nofollow'] != 1) {
					$links = $this->get_links($file, $url, $can_leave_domain, $data['base'], $mainurl);
					$links = $this->distinct_array($links);
					$all_links = count($links);
					$numoflinks = 0;
					//if there are any, add to the temp table, but only if there isnt such url already
					if (is_array($links)) {
						reset ($links);

						while ($thislink = each($links)) {
							if ($tmp_urls[$thislink[1]] != 1) {
								$tmp_urls[$thislink[1]] = 1;
								$numoflinks++;
                                                                
                                                                $table = "temp"; $attributes = "link, level, id"; $content = "'$thislink[1]', '$level', '$sessid'";
                                                                $this->_db_obj->dbInsert($table, $attributes, $content);
								//mysql_query ("insert into ".$mysql_table_prefix."temp (link, level, id) values ('$thislink[1]', '$level', '$sessid')");
								//echo mysql_error();
							}
						}
					}
				} else {
					//printStandardReport('noFollow',$command_line);
				}
				
				if ($OKtoIndex == 1) {
					
					$title = $data['title'];
					$host = $data['host'];
					$path = $data['path'];
					$fulltxt = $data['fulltext'];
					$desc = substr($data['description'], 0,254);
					$url_parts = parse_url($url);
					$domain_for_db = $url_parts['host'];

					if (isset($domain_arr[$domain_for_db])) {
						$dom_id = $domain_arr[$domain_for_db];
					} else {
                                            
                                                $table = "domains"; $attributes = "domain"; $content = "'$domain_for_db'";
                                                $this->_db_obj->dbInsert($table, $attributes, $content);
						//mysql_query("insert into ".$mysql_table_prefix."domains (domain) values ('$domain_for_db')");
						$dom_id = $this->_db_obj->last_insert_id();
						$domain_arr[$domain_for_db] = $dom_id;
					}

					$wordarray = $this->calc_weights ($wordarray, $title, $host, $path, $data['keywords']);

					//if there are words to index, add the link to the database, get its id, and add the word + their relation
					if (is_array($wordarray) && count($wordarray) > $min_words_per_page) {
						if ($md5sum == '') {
                                                        $table = "links"; $attributes = "site_id, url, title, description, fulltxt, indexdate, size, md5sum, level"; $content = "'$site_id', '$url', '$title', '$desc', '$fulltxt', curdate(), '$pageSize', '$newmd5sum', '$thislevel'";
                                                        $this->_db_obj->dbInsert($table, $attributes, $content); 
							//mysql_query ("insert into ".$mysql_table_prefix."links (site_id, url, title, description, fulltxt, indexdate, size, md5sum, level) values ('$site_id', '$url', '$title', '$desc', '$fulltxt', curdate(), '$pageSize', '$newmd5sum', $thislevel)");
							//echo mysql_error();
                                                        $table = "links"; $attributes = "link_id"; $otherReq = "url='$url'";
                                                        $result = $this->_db_obj->TBS_select($table, $attributes, $otherReq);
							//$result = mysql_query("select link_id from ".$mysql_table_prefix."links where url='$url'");
							//echo mysql_error();
							//$row = mysql_fetch_row($result);
							$link_id = $result[0][0];

							$this->save_keywords($wordarray, $link_id, $dom_id, $all_keywords);
							
							//printStandardReport('indexed', $command_line);
						}else if (($md5sum <> '') && ($md5sum <> $newmd5sum)) { //if page has changed, start updating
                                                        $table = "links"; $attributes = "link_id"; $otherReq = "url='$url'";
                                                        $result = $this->_db_obj->TBS_select($table, $attributes, $otherReq);
							$link_id = $result[0][0];
							for ($i=0;$i<=15; $i++) {
								$char = dechex($i);
                                                                $table = "link_keyword$char"; $deleteContent = "link_id=$link_id";
                                                                $this->_db_obj->dbDelete($table, $deleteContent);
								//mysql_query ("delete from ".$mysql_table_prefix."link_keyword$char where link_id=$link_id");
								//echo mysql_error();
							}
							$this->save_keywords($wordarray, $link_id, $dom_id, $all_keywords);
                                                        $table = "links";  $updateContent = "title='$title', description ='$desc', fulltxt = '$fulltxt', indexdate=now(), size = '$pageSize', md5sum='$newmd5sum', level=$thislevel where link_id=$link_id";
                                                        $this->_db_obj->dbUpdate($table, $updateContent);
							//$query = "update ".$mysql_table_prefix."links set title='$title', description ='$desc', fulltxt = '$fulltxt', indexdate=now(), size = '$pageSize', md5sum='$newmd5sum', level=$thislevel where link_id=$link_id";
							//mysql_query($query);
							//echo mysql_error();
							//printStandardReport('re-indexed', $command_line);
						}
					}else {
						//printStandardReport('minWords', $command_line);

					}
				}
			}
		} else {
			$deletable = 1;
			//printUrlStatus($url_status['state'], $command_line);

		}
		if ($reindex ==1 && $deletable == 1) {
			$this->check_for_removal($url); 
		} else if ($reindex == 1) {
			
		}
		if (!isset($all_links)) {
			$all_links = 0;
		}
		if (!isset($numoflinks)) {
			$numoflinks = 0;
		}
		//printLinksReport($numoflinks, $all_links, $command_line);
        }
  
    
    private function get_domains() 
    {
        $table = "domains"; $attributes = "domain_id, domain"; $otherReq = null;
        $result = $this->_db_obj->TBS_select($table, $attributes, $otherReq); 
	//$result = mysql_query("select domain_id, domain from ".$mysql_table_prefix."domains");
	//echo mysql_error();
	$domains = Array();
    	foreach($result as $row)
        {
		$domains[$row[1]] = $row[0];
        }
	return $domains;		
    }
    
    private function get_temp_urls ($sessid) 
    {
        $table = "temp"; $attributes = "link"; $otherReq = "id='$sessid'";
        $result = $this->_db_obj->TBS_select($table, $attributes, $otherReq); 
	//$result = mysql_query("select link from ".$mysql_table_prefix."temp where id='$sessid'");
	//echo mysql_error();
	$tmp_urls = Array();
    	foreach($result as $row) 
        {
		$tmp_urls[$row[0]] = 1;
	}
	return $tmp_urls;
    }    
    
    private function getFileContents($url)
    {
	$urlparts = parse_url($url);
	$path = $urlparts['path'];
	$host = $urlparts['host'];
	if ($urlparts['query'] != "")
		$path .= "?".$urlparts['query'];
	if (isset ($urlparts['port'])) {
		$port = (int) $urlparts['port'];
	} else
		if ($urlparts['scheme'] == "http") {
			$port = 80;
		} else
			if ($urlparts['scheme'] == "https") {
				$port = 443;
			}

	if ($port == 80) {
		$portq = "";
	} else {
		$portq = ":$port";
	}

	$all = "*/*";

	echo $request = "GET $path HTTP/1.0\r\nHost: $host$portq\r\nAccept: $all\r\nUser-Agent: \r\n\r\n";

	$fsocket_timeout = 30;
	if (substr($url, 0, 5) == "https") {
		echo $target = "ssl://".$host;
	} else {
		$target = $host;
	}


	$errno = 0;
	$errstr = "";
	$fp =  fsockopen($target, $port, $errno, $errstr, $fsocket_timeout);

	print $errstr;
	if (!$fp) {
                echo "bad ";
		$contents['state'] = "NOHOST";
		//printConnectErrorReport($errstr);
		return $contents;
	} else {
		if (!fputs($fp, $request)) {
			$contents['state'] = "Cannot send request";
			return $contents;
		}
		$data = null;
		socket_set_timeout($fp, $fsocket_timeout);
		do{
			$status = socket_get_status($fp);
			$data .= fgets($fp, 8192);
		} while (!feof($fp) && !$status['timed_out']) ;

		fclose($fp);
		if ($status['timed_out'] == 1) {
			$contents['state'] = "timeout";
		} else
			$contents['state'] = "ok";
		$contents['file'] = substr($data, strpos($data, "\r\n\r\n") + 4);
	}
	return $contents;
    }
    
    private function url_status($url)
    {
        //global $user_agent, $index_pdf, $index_doc, $index_xls, $index_ppt;
	$urlparts = parse_url($url);
	$path = $urlparts['path'];
	$host = $urlparts['host'];
        
        //check port
	if (isset ($urlparts['port'])) 
        {
		$port = (int) $urlparts['port'];
	} 
        else if ($urlparts['scheme'] == "http") 
        {
		$port = 80;
	}
        else if ($urlparts['scheme'] == "https") 
        {
		$port = 443;
	}

	if ($port == 80) {
		$portq = "";
	} else {
		$portq = ":$port";
	}
        
        //check require: after question amrk
        if (isset($urlparts['query']))
        {
            $path .= "?".$urlparts['query'];
        }
		

	$all = "*/*"; //just to prevent "comment effect" in get accept
        $request = "HEAD $path HTTP/1.1\r\nHost: $host$portq\r\nAccept: $all\r\nUser-Agent: \r\n\r\n";

	if (substr($url, 0, 5) == "https") {
		$target = "ssl://".$host;
	} else {
		$target = $host;
	}

	$fsocket_timeout = 30;
	$errno = 0;
	$errstr = "";
	$fp = fsockopen($target, $port, $errno, $errstr, $fsocket_timeout);
	print $errstr;
	$linkstate = "ok";
	if (!$fp) {
		$status['state'] = "NOHOST";
	} else {
		socket_set_timeout($fp, 30);
		fputs($fp, $request);
		$answer = fgets($fp, 4096);
		$regs = Array ();
		if (preg_match("@HTTP/[0-9.]+ (([0-9])[0-9]{2})@", $answer, $regs)) {
			$httpcode = $regs[2];
			$full_httpcode = $regs[1];

			if ($httpcode <> 2 && $httpcode <> 3) {
				$status['state'] = "Unreachable: http $full_httpcode";
				$linkstate = "Unreachable";
			}
		}

		if ($linkstate <> "Unreachable") {
			while ($answer) {
				$answer = fgets($fp, 4096);

				if (preg_match("/Location: *([^\n\r ]+)/", $answer, $regs) && $httpcode == 3 && $full_httpcode != 302) {
					$status['path'] = $regs[1];
					$status['state'] = "Relocation: http $full_httpcode";
					fclose($fp);
					return $status;
				}

				if (preg_match("/Last-Modified: *([a-z0-9,: ]+)/i", $answer, $regs)) {
					$status['date'] = $regs[1];
				}

				if (preg_match("/Content-Type:/i", $answer)) {
					$content = $answer;
					$answer = '';
					break;
				}
			}
			$socket_status = socket_get_status($fp);
			if (preg_match("/Content-Type: *([a-z\/.-]*)/i", $content, $regs)) {
				if ($regs[1] == 'text/html' || $regs[1] == 'text/' || $regs[1] == 'text/plain') {
					$status['content'] = 'text';
					$status['state'] = 'ok';
				} else if ($regs[1] == 'application/pdf' && $index_pdf == 1) {
					$status['content'] = 'pdf';
					$status['state'] = 'ok';                                 
				} else if (($regs[1] == 'application/msword' || $regs[1] == 'application/vnd.ms-word') && $index_doc == 1) {
					$status['content'] = 'doc';
					$status['state'] = 'ok';
				} else if (($regs[1] == 'application/excel' || $regs[1] == 'application/vnd.ms-excel') && $index_xls == 1) {
					$status['content'] = 'xls';
					$status['state'] = 'ok';
				} else if (($regs[1] == 'application/mspowerpoint' || $regs[1] == 'application/vnd.ms-powerpoint') && $index_ppt == 1) {
					$status['content'] = 'ppt';
					$status['state'] = 'ok';
				} else {
					$status['state'] = "Not text or html";
				}

			} else
				if ($socket_status['timed_out'] == 1) {
					$status['state'] = "Timed out (no reply from server)";

				} else
					$status['state'] = "Not text or html";

		}
	}
	fclose($fp);
	return $status;
    }
    

    private function check_robot_txt($url)
    {
	$urlparts = parse_url($url);
	$url = 'http://'.$urlparts['host']."/robots.txt";

	$url_status = $this->url_status($url);
	$omit = array ();

	if ($url_status['state'] == "ok") {
		$robot = file($url);
		if (!$robot) {
			$contents = $this->getFileContents($url);
			$file = $contents['file'];
			$robot = explode("\n", $file);
		}

		$regs = Array ();
		$this_agent= "";
		while (list ($id, $line) = each($robot)) {
			if (preg_match("/^user-agent: *([^#]+) */", $line, $regs)) {
				$this_agent = trim($regs[1]);
				if ($this_agent == '*')
					$check = 1;
				else
					$check = 0;
			}

			if (preg_match("/disallow: *([^#]+)/", $line, $regs) && $check == 1) {
				$disallow_str = preg_replace("/[\n ]+/i", "", $regs[1]);
				if (trim($disallow_str) != "") {
					$omit[] = $disallow_str;
				} else {
					if ($this_agent == '*') {
						return null;
					}
				}
			}
		}
	}
	return $omit;
    }
    
    private function remove_file_from_url($url) 
    {
        $url_parts = parse_url($url);
	$path = $url_parts['path'];

	$regs = Array ();
	if (preg_match('/([^\/]+)$/i', $path, $regs)) {
		$file = $regs[1];
		$check = $file.'$';
		$path = preg_replace("/$check"."/i", "", $path);
	}

	if ($url_parts['port'] == 80 || $url_parts['port'] == "") {
		$portq = "";
	} else {
		$portq = ":".$url_parts['port'];
	}

	$url = $url_parts['scheme']."://".$url_parts['host'].$portq.$path;
	return $url;
    }
    

    private function get_links($file, $url, $can_leave_domain, $base, $mainurl)
    {
        $chunklist = array ();
        // The base URL comes from either the meta tag or the current URL.
        if (!empty($base)) {
            $url = $base;
        }

            $links = array ();
            $regs = Array ();
            $checked_urls = Array();

            preg_match_all("/href\s*=\s*[\'\"]?([+:%\/\?~=&;\\\(\),._a-zA-Z0-9-]*)(#[.a-zA-Z0-9-]*)?[\'\" ]?(\s*rel\s*=\s*[\'\"]?(nofollow)[\'\"]?)?/i", $file, $regs, PREG_SET_ORDER);
            foreach ($regs as $val) {
                    if ($checked_urls[$val[1]]!=1 && !isset ($val[4])) { //if nofollow is not set
                            if (($a =$this-> url_purify($val[1], $url, $can_leave_domain, $mainurl)) != '') {
                                    $links[] = $a;
                            }
                            $checked_urls[$val[1]] = 1;
                    }
            }
            preg_match_all("/(frame[^>]*src[[:blank:]]*)=[[:blank:]]*[\'\"]?(([[a-z]{3,5}:\/\/(([.a-zA-Z0-9-])+(:[0-9]+)*))*([+:%\/?=&;\\\(\),._ a-zA-Z0-9-]*))(#[.a-zA-Z0-9-]*)?[\'\" ]?/i", $file, $regs, PREG_SET_ORDER);
            foreach ($regs as $val) {
                    if ($checked_urls[$val[1]]!=1 && !isset ($val[4])) { //if nofollow is not set
                            if (($a = $this->url_purify($val[1], $url, $can_leave_domain)) != '') {
                                    $links[] = $a;
                            }
                            $checked_urls[$val[1]] = 1;
                    }
            }
            preg_match_all("/(window[.]location)[[:blank:]]*=[[:blank:]]*[\'\"]?(([[a-z]{3,5}:\/\/(([.a-zA-Z0-9-])+(:[0-9]+)*))*([+:%\/?=&;\\\(\),._ a-zA-Z0-9-]*))(#[.a-zA-Z0-9-]*)?[\'\" ]?/i", $file, $regs, PREG_SET_ORDER);
            foreach ($regs as $val) {
                    if ($checked_urls[$val[1]]!=1 && !isset ($val[4])) { //if nofollow is not set
                            if (($a = $this->url_purify($val[1], $url, $can_leave_domain)) != '') {
                                    $links[] = $a;
                            }
                            $checked_urls[$val[1]] = 1;
                    }
            }
            preg_match_all("/(http-equiv=['\"]refresh['\"] *content=['\"][0-9]+;url)[[:blank:]]*=[[:blank:]]*[\'\"]?(([[a-z]{3,5}:\/\/(([.a-zA-Z0-9-])+(:[0-9]+)*))*([+:%\/?=&;\\\(\),._ a-zA-Z0-9-]*))(#[.a-zA-Z0-9-]*)?[\'\" ]?/i", $file, $regs, PREG_SET_ORDER);
            foreach ($regs as $val) {
                    if ($checked_urls[$val[1]]!=1 && !isset ($val[4])) { //if nofollow is not set
                            if (($a = $this->url_purify($val[1], $url, $can_leave_domain)) != '') {
                                    $links[] = $a;
                            }
                            $checked_urls[$val[1]] = 1;
                    }
            }

            preg_match_all("/(window[.]open[[:blank:]]*[(])[[:blank:]]*[\'\"]?(([[a-z]{3,5}:\/\/(([.a-zA-Z0-9-])+(:[0-9]+)*))*([+:%\/?=&;\\\(\),._ a-zA-Z0-9-]*))(#[.a-zA-Z0-9-]*)?[\'\" ]?/i", $file, $regs, PREG_SET_ORDER);
            foreach ($regs as $val) {
                    if ($checked_urls[$val[1]]!=1 && !isset ($val[4])) { //if nofollow is not set
                            if (($a = $this->url_purify($val[1], $url, $can_leave_domain)) != '') {
                                    $links[] = $a;
                            }
                            $checked_urls[$val[1]] = 1;
                    }
            }

            return $links;
    }
    
    private function unique_array($arr) 
    {
        $min_word_length = 3;
        $word_upper_bound = 100;
	$index_numbers = 1;
        $stem_words = 0;
        
        $common = array
		(
		);

	$lines = @file('common.txt');

	if (is_array($lines)) {
		while (list($id, $word) = each($lines))
			$common[trim($word)] = 1;
	}
        
	
	if ($stem_words == 1) {
		$newarr = Array();
		foreach ($arr as $val) {
			$newarr[] = stem($val);
		}
		$arr = $newarr;
	}
	sort($arr);
	reset($arr);
	$newarr = array ();

	$i = 0;
	$counter = 1;
	$element = current($arr);

	if ($index_numbers == 1) {
		$pattern = "/[a-z0-9]+/";
	} else {
		$pattern = "/[a-z]+/";
	}

	$regs = Array ();
	for ($n = 0; $n < sizeof($arr); $n ++) {
		//check if word is long enough, contains alphabetic characters and is not a common word
		//to eliminate/count multiple instance of words
		$next_in_arr = next($arr);
		if ($next_in_arr != $element) {
			if (strlen($element) >= $min_word_length && preg_match($pattern, $this->remove_accents($element)) && (@ $common[$element] <> 1)) {
				if (preg_match("/^(-|\\\')(.*)/", $element, $regs))
					$element = $regs[2];

				if (preg_match("/(.*)(\\\'|-)$/", $element, $regs))
					$element = $regs[1];

				$newarr[$i][1] = $element;
				$newarr[$i][2] = $counter;
				$element = current($arr);
				$i ++;
				$counter = 1;
			} else {
				$element = $next_in_arr;
			}
		} else {
				if ($counter < $word_upper_bound)
					$counter ++;
		}

	}
	return $newarr;
    }
    
    private function url_purify($url, $parent_url, $can_leave_domain, $mainurl) 
    {
        //global $mainurl;
        //Apache multi indexes parameters
	$apache_indexes = array (  
		"N=A" => 1,
		"N=D" => 1,
		"M=A" => 1,
		"M=D" => 1,
		"S=A" => 1,
		"S=D" => 1,
		"D=A" => 1,
		"D=D" => 1,
		"C=N;O=A" => 1,
		"C=M;O=A" => 1,
		"C=S;O=A" => 1,
		"C=D;O=A" => 1,
		"C=N;O=D" => 1,
		"C=M;O=D" => 1,
		"C=S;O=D" => 1,
		"C=D;O=D" => 1);
        $ext = array
		(
		);

	$lines = @file('ext.txt');

	if (is_array($lines)) {
		while (list($id, $word) = each($lines))
			$ext[] = trim($word);
	}
        
        $strip_sessids	= 1;
	$urlparts = parse_url($url);

	$main_url_parts = parse_url($mainurl);
	if ($urlparts['host'] != "" && $urlparts['host'] != $main_url_parts['host']  && $can_leave_domain != 1) {
		return '';
	}
	
	reset($ext);
	while (list ($id, $excl) = each($ext))
		if (preg_match("/\.$excl$/i", $url))
			return '';

	if (substr($url, -1) == '\\') {
		return '';
	}



	if (isset($urlparts['query'])) {
		if ($apache_indexes[$urlparts['query']]) {
			return '';
		}
	}

	if (preg_match("/[\/]?mailto:|[\/]?javascript:|[\/]?news:/i", $url)) {
		return '';
	}
	if (isset($urlparts['scheme'])) {
		$scheme = $urlparts['scheme'];
	} else {
		$scheme ="";
	}



	//only http and https links are followed
	if (!($scheme == 'http' || $scheme == '' || $scheme == 'https')) {
		return '';
	}

	//parent url might be used to build an url from relative path
	$parent_url = $this->remove_file_from_url($parent_url);
	$parent_url_parts = parse_url($parent_url);


	if (substr($url, 0, 1) == '/') {
		$url = $parent_url_parts['scheme']."://".$parent_url_parts['host'].$url;
	} else
		if (!isset($urlparts['scheme'])) {
			$url = $parent_url.$url;
		}

	$url_parts = parse_url($url);

	$urlpath = $url_parts['path'];

	$regs = Array ();
	
	while (preg_match("/[^\/]*\/[.]{2}\//", $urlpath, $regs)) {
		$urlpath = str_replace($regs[0], "", $urlpath);
	}

	//remove relative path instructions like ../ etc 
	$urlpath = preg_replace("/\/+/", "/", $urlpath);
	$urlpath = preg_replace("/[^\/]*\/[.]{2}/", "",  $urlpath);
	$urlpath = str_replace("./", "", $urlpath);
	$query = "";
	if (isset($url_parts['query'])) {
		$query = "?".$url_parts['query'];
	}
	if ($main_url_parts['port'] == 80 || $url_parts['port'] == "") {
		$portq = "";
	} else {
		$portq = ":".$main_url_parts['port'];
	}
	$url = $url_parts['scheme']."://".$url_parts['host'].$portq.$urlpath.$query;

	//if we index sub-domains
	if ($can_leave_domain == 1) {
		return $url;
	}

	$mainurl = $this->remove_file_from_url($mainurl);
	
	if ($strip_sessids == 1) {
		$url = $this->remove_sessid($url);
	}
	//only urls in staying in the starting domain/directory are followed	
	$url = $this->convert_url($url);
	if (strstr($url, $mainurl) == false) {
		return '';
	} else
		return $url;
        
    }
    
    private function save_keywords($wordarray, $link_id, $domain, $all_keywords)
    {
	reset($wordarray);
	while ($thisword = each($wordarray)) {
		$word = $thisword[1][1];
		$wordmd5 = substr(md5($word), 0, 1);
		$weight = $thisword[1][2];
		if (strlen($word)<= 30) {
			$keyword_id = $all_keywords[$word];
			if ($keyword_id  == "") {
                            $table = "keywords"; $attributes = "keyword"; $content = "'$word'";
                            $this->_db_obj->dbInsert($table, $attributes, $content);
                            //mysql_query("insert into ".$mysql_table_prefix."keywords (keyword) values ('$word')");
				if (mysql_errno() == 1062) { 
                                        $table = "keywords"; $attributes = "keyword_ID"; $otherReq = "keyword='$word'";
                                        $result = $this->_db_obj->TBS_select($table, $attributes, $otherReq);
					//$result = mysql_query("select keyword_ID from ".$mysql_table_prefix."keywords where keyword='$word'");
					//echo mysql_error();
					//$row = mysql_fetch_row($result);
					$keyword_id = $result[0];
				} else{
				$keyword_id = $this->_db_obj->last_insert_id();
				$all_keywords[$word] = $keyword_id;
				//echo mysql_error();
			} 
			} 
			$inserts[$wordmd5] .= ",($link_id[0], $keyword_id, $weight, $domain)"; 
		}
	}

	for ($i=0;$i<=15; $i++) {
		$char = dechex($i);
		$values= substr($inserts[$char], 1);
		if ($values!="") {
                        $table = "link_keyword$char"; $attributes = "link_id, keyword_id, weight, domain"; $content = "$values";
                        $this->_db_obj->TBS_Insert($table, $attributes, $content);
			//$query = "insert into ".$mysql_table_prefix."link_keyword$char (link_id, keyword_id, weight, domain) values $values";
			//mysql_query($query);
			//echo mysql_error();
		}
	}
    }
    
    private function get_head_data($file)   
    {
        $headdata = "";
           
	preg_match("@<head[^>]*>(.*?)<\/head>@si",$file, $regs);	
	
	$headdata = $regs[1];

	$description = "";
	$robots = "";
	$keywords = "";
    $base = "";
	$res = Array ();
	if ($headdata != "") {
		preg_match("/<meta +name *=[\"']?robots[\"']? *content=[\"']?([^<>'\"]+)[\"']?/i", $headdata, $res);
		if (isset ($res)) {
			$robots = $res[1];
		}

		preg_match("/<meta +name *=[\"']?description[\"']? *content=[\"']?([^<>'\"]+)[\"']?/i", $headdata, $res);
		if (isset ($res)) {
			$description = $res[1];
		}

		preg_match("/<meta +name *=[\"']?keywords[\"']? *content=[\"']?([^<>'\"]+)[\"']?/i", $headdata, $res);
		if (isset ($res)) {
			$keywords = $res[1];
		}
        // e.g. <base href="http://www.consil.co.uk/index.php" />
		preg_match("/<base +href *= *[\"']?([^<>'\"]+)[\"']?/i", $headdata, $res);
		if (isset ($res)) {
			$base = $res[1];
		}
		$keywords = preg_replace("/[, ]+/", " ", $keywords);
		$robots = explode(",", strtolower($robots));
		$nofollow = 0;
		$noindex = 0;
		foreach ($robots as $x) {
			if (trim($x) == "noindex") {
				$noindex = 1;
			}
			if (trim($x) == "nofollow") {
				$nofollow = 1;
			}
		}
		$data['description'] = addslashes($description);
		$data['keywords'] = addslashes($keywords);
		$data['nofollow'] = $nofollow;
		$data['noindex'] = $noindex;
		$data['base'] = $base;
	}
	return $data;
    }
    
    private function clean_file($file, $url, $type) 
    {
        $entities = $entities = array
		(
		"&amp" => "&",
		"&apos" => "'",
		"&THORN;"  => "�",
		"&szlig;"  => "�",
		"&agrave;" => "�",
		"&aacute;" => "�",
		"&acirc;"  => "�",
		"&atilde;" => "�",
		"&auml;"   => "�",
		"&aring;"  => "�",
		"&aelig;"  => "�",
		"&ccedil;" => "�",
		"&egrave;" => "�",
		"&eacute;" => "�",
		"&ecirc;"  => "�",
		"&euml;"   => "�",
		"&igrave;" => "�",
		"&iacute;" => "�",
		"&icirc;"  => "�",
		"&iuml;"   => "�",
		"&eth;"    => "�",
		"&ntilde;" => "�",
		"&ograve;" => "�",
		"&oacute;" => "�",
		"&ocirc;"  => "�",
		"&otilde;" => "�",
		"&ouml;"   => "�",
		"&oslash;" => "�",
		"&ugrave;" => "�",
		"&uacute;" => "�",
		"&ucirc;"  => "�",
		"&uuml;"   => "�",
		"&yacute;" => "�",
		"&thorn;"  => "�",
		"&yuml;"   => "�",
		"&THORN;"  => "�",
		"&szlig;"  => "�",
		"&Agrave;" => "�",
		"&Aacute;" => "�",
		"&Acirc;"  => "�",
		"&Atilde;" => "�",
		"&Auml;"   => "�",
		"&Aring;"  => "�",
		"&Aelig;"  => "�",
		"&Ccedil;" => "�",
		"&Egrave;" => "�",
		"&Eacute;" => "�",
		"&Ecirc;"  => "�",
		"&Euml;"   => "�",
		"&Igrave;" => "�",
		"&Iacute;" => "�",
		"&Icirc;"  => "�",
		"&Iuml;"   => "�",
		"&ETH;"    => "�",
		"&Ntilde;" => "�",
		"&Ograve;" => "�",
		"&Oacute;" => "�",
		"&Ocirc;"  => "�",
		"&Otilde;" => "�",
		"&Ouml;"   => "�",
		"&Oslash;" => "�",
		"&Ugrave;" => "�",
		"&Uacute;" => "�",
		"&Ucirc;"  => "�",
		"&Uuml;"   => "�",
		"&Yacute;" => "�",
		"&Yhorn;"  => "�",
		"&Yuml;"   => "�"
		);
        $index_host = 1;
        $index_meta_keywords = 1;
	$urlparts = parse_url($url);
	$host = $urlparts['host'];
	//remove filename from path
	$path = preg_replace('/([^\/]+)$/i', "", $urlparts['path']);
	$file = preg_replace("/<link rel[^<>]*>/i", " ", $file);
	$file = preg_replace("@<!--sphider_noindex-->.*?<!--\/sphider_noindex-->@si", " ",$file);	
	$file = preg_replace("@<!--.*?-->@si", " ",$file);	
	$file = preg_replace("@<script[^>]*?>.*?</script>@si", " ",$file);
	$headdata = $this->get_head_data($file);
	$regs = Array ();
	if (preg_match("@<title *>(.*?)<\/title*>@si", $file, $regs)) {
		$title = trim($regs[1]);
		$file = str_replace($regs[0], "", $file);
	} else if ($type == 'pdf' || $type == 'doc') { //the title of a non-html file is its first few words
		$title = substr($file, 0, strrpos(substr($file, 0, 40), " "));
	}

	$file = preg_replace("@<style[^>]*>.*?<\/style>@si", " ", $file);

	//create spaces between tags, so that removing tags doesnt concatenate strings
	$file = preg_replace("/<[\w ]+>/", "\\0 ", $file);
	$file = preg_replace("/<\/[\w ]+>/", "\\0 ", $file);
	$file = strip_tags($file);
	$file = preg_replace("/&nbsp;/", " ", $file);

	$fulltext = $file;
	$file .= " ".$title;
	if ($index_host == 1) {
		$file = $file." ".$host." ".$path;
	}
	if ($index_meta_keywords == 1) {
		$file = $file." ".$headdata['keywords'];
	}
	
	
	//replace codes with ascii chars
	$file = preg_replace('~&#x([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $file);
        $file = preg_replace('~&#([0-9]+);~e', 'chr("\\1")', $file);
	$file = strtolower($file);
	reset($entities);
	while ($char = each($entities)) {
		$file = preg_replace("/".$char[0]."/i", $char[1], $file);
	}
	$file = preg_replace("/&[a-z]{1,6};/", " ", $file);
	$file = preg_replace("/[\*\^\+\?\\\.\[\]\^\$\|\{\)\(\}~!\"\/@#�$%&=`�;><:,]+/", " ", $file);
	$file = preg_replace("/\s+/", " ", $file);
	$data['fulltext'] = addslashes($fulltext);
	$data['content'] = addslashes($file);
	$data['title'] = addslashes($title);
	$data['description'] = $headdata['description'];
	$data['keywords'] = $headdata['keywords'];
	$data['host'] = $host;
	$data['path'] = $path;
	$data['nofollow'] = $headdata['nofollow'];
	$data['noindex'] = $headdata['noindex'];
	$data['base'] = $headdata['base'];

	return $data;
    }
    
    private function calc_weights($wordarray, $title, $host, $path, $keywords)
    {
        $index_host = 1; $index_meta_keywords = 1;
	$hostarray = $this->unique_array(explode(" ", preg_replace("/[^[:alnum:]-]+/i", " ", strtolower($host))));
	$patharray = $this->unique_array(explode(" ", preg_replace("/[^[:alnum:]-]+/i", " ", strtolower($path))));
	$titlearray = $this->unique_array(explode(" ", preg_replace("/[^[:alnum:]-]+/i", " ", strtolower($title))));
	$keywordsarray = $this->unique_array(explode(" ", preg_replace("/[^[:alnum:]-]+/i", " ", strtolower($keywords))));
	$path_depth = $this->countSubstrs($path, "/");

	while (list ($wid, $word) = each($wordarray)) {
		$word_in_path = 0;
		$word_in_domain = 0;
		$word_in_title = 0;
		$meta_keyword = 0;
		if ($index_host == 1) {
			while (list ($id, $path) = each($patharray)) {
				if ($path[1] == $word[1]) {
					$word_in_path = 1;
					break;
				}
			}
			reset($patharray);

			while (list ($id, $host) = each($hostarray)) {
				if ($host[1] == $word[1]) {
					$word_in_domain = 1;
					break;
				}
			}
			reset($hostarray);
		}

		if ($index_meta_keywords == 1) {
			while (list ($id, $keyword) = each($keywordsarray)) {
				if ($keyword[1] == $word[1]) {
					$meta_keyword = 1;
					break;
				}
			}
			reset($keywordsarray);
		}
		while (list ($id, $tit) = each($titlearray)) {
			if ($tit[1] == $word[1]) {
				$word_in_title = 1;
				break;
			}
		}
		reset($titlearray);

		$wordarray[$wid][2] = (int) ($this->calc_weight($wordarray[$wid][2], $word_in_title, $word_in_domain, $word_in_path, $path_depth, $meta_keyword));
	}
	reset($wordarray);
	return $wordarray;
    }
    
    private function isDuplicateMD5($md5sum) 
    {
        $table = "links"; $attributes = "link_id"; $otherReq = "md5sum='$md5sum'";
        $this->_db_obj->TBS_select($table, $attributes, $otherReq);
        //$result = mysql_query("select link_id from ".$mysql_table_prefix."links where md5sum='$md5sum'");
	if ($result != null) {
		return true;
	}
	return false;
    }
    
    private function check_include($link, $inc, $not_inc) 
    {
        $url_inc = Array ();
	$url_not_inc = Array ();
	if ($inc != "") {
		$url_inc = explode("\n", $inc);
	}
	if ($not_inc != "") {
		$url_not_inc = explode("\n", $not_inc);
	}
	$oklinks = Array ();

	$include = true;
	foreach ($url_not_inc as $str) {
		$str = trim($str);
		if ($str != "") {
			if (substr($str, 0, 1) == '*') {
				if (preg_match(substr($str, 1), $link)) {
					$include = false;
					break;
				}
			} else {
				if (!(strpos($link, $str) === false)) {
					$include = false;
					break;
				}
			}
		}
	}
	if ($include && $inc != "") {
		$include = false;
		foreach ($url_inc as $str) {
			$str = trim($str);
			if ($str != "") {
				if (substr($str, 0, 1) == '*') {
					if (preg_match(substr($str, 1), $link)) {
						$include = true;
						break 2;
					}
				} else {
					if (strpos($link, $str) !== false) {
						$include = true;
						break;
					}
				}
			}
		}
	}
	return $include;
    }
    
    private function check_for_removal($url) 
    {
        $table = "links"; $attributes = "link_id, visible"; $otherReq = "url='$url'";
        $result = $this->_db_obj->TBS_select($table, $attributes, $otherReq);
        
	//$result = mysql_query("select link_id, visible from ".$mysql_table_prefix."links"." where url='$url'");
	//echo mysql_error();
	if ($result != null) 
        {
		//$row = mysql_fetch_row($result);
		$link_id = $result[0][0];
		$visible = $result[0][1];
		if ($visible > 0) {
			$visible --;
                        $table = "links"; $updateContent = "visible=$visible where link_id=$link_id";
                        $this->_db_obj->dbUpdate($table, $updateContent);
			//mysql_query("update ".$mysql_table_prefix."links set visible=$visible where link_id=$link_id");
			//echo mysql_error();
	} 
        else 
        {
            $table = "links"; $deleteContent = "link_id=$link_id";
            $this->_db_obj->dbDelete($table, $deleteContent);     
			//mysql_query("delete from ".$mysql_table_prefix."links where link_id=$link_id");
			//echo mysql_error();
			for ($i=0;$i<=15; $i++) {
				$char = dechex($i);                       
                                $table = "link_keyword$char"; $deleteContent = "link_id=$link_id";
                                $this->_db_obj->dbDelete($table, $deleteContent);  
				//mysql_query("delete from ".$mysql_table_prefix."link_keyword$char where link_id=$link_id");
				//echo mysql_error();
			}
			//printStandardReport('pageRemoved',$command_line);
	}
    }
}
    
    private function convert_url($url)
    {
        $url = str_replace("&amp;", "&", $url);
	$url = str_replace(" ", "%20", $url);
	return $url;
    }
    
    private function extract_text($contents, $source_type) 
    {
        global $tmp_dir, $pdftotext_path, $catdoc_path, $xls2csv_path, $catppt_path;

	$temp_file = "tmp_file";
	$filename = $tmp_dir."/".$temp_file ;
	if (!$handle = fopen($filename, 'w')) {
		die ("Cannot open file $filename");
	}

	if (fwrite($handle, $contents) === FALSE) {
		die ("Cannot write to file $filename");
	}
	
	fclose($handle);
	if ($source_type == 'pdf') {
		$command = $pdftotext_path." $filename -";
		$a = exec($command,$result, $retval);
	} else if ($source_type == 'doc') {
		$command = $catdoc_path." $filename";
		$a = exec($command,$result, $retval);
	} else if ($source_type == 'xls') {
		$command = $xls2csv_path." $filename";
		$a = exec($command,$result, $retval);
	} else if ($source_type == 'ppt') {
		$command = $catppt_path." $filename";
		$a = exec($command,$result, $retval);
	}

	unlink ($filename);
	return implode(' ', $result); 
    }
    
    private function calc_weight ($words_in_page, $word_in_title, $word_in_domain, $word_in_path, $path_depth, $meta_keyword)
    {
        // Relative weight of a word in the title of a webpage
        $title_weight  = 20;

        // Relative weight of a word in the domain name
        $domain_weight = 60;

        // Relative weight of a word in the path name
        $path_weight	= 10;

        // Relative weight of a word in meta_keywords
        $meta_weight	= 5;
	$weight = ($words_in_page + $word_in_title * $title_weight +
			  $word_in_domain * $domain_weight +
			  $word_in_path * $path_weight + $meta_keyword * $meta_weight) *10 / (0.8 +0.2*$path_depth);

	return $weight;
    }
    
    private function  remove_sessid($url) 
    {
        return preg_replace("/(\?|&)(PHPSESSID|JSESSIONID|ASPSESSIONID|sid)=[0-9a-zA-Z]+$/", "", $url);
    }
    
    private function fst_lt_snd($version1, $version2) {

	$list1 = explode(".", $version1);
	$list2 = explode(".", $version2);

	$length = count($list1);
	$i = 0;
	while ($i < $length) {
		if ($list1[$i] < $list2[$i])
			return true;
		if ($list1[$i] > $list2[$i])
			return false;
		$i++;
	}
	
	if ($length < count($list2)) {
		return true;
	}
	return false;

    }
    
    private function distinct_array($arr) {
		rsort($arr);
		reset($arr);
		$newarr = array();
		$i = 0;
		$element = current($arr);

		for ($n = 0; $n < sizeof($arr); $n++) {
			if (next($arr) != $element) {
				$newarr[$i] = $element;
				$element = current($arr);
				$i++;
			}
		}

		return $newarr;
	}
    
    
    private function remove_accents($string) {
		return (strtr($string, "�������������������������������������������������������������",
					  "aaaaaaaaaaaaaaoooooooooooooeeeeeeeeecceiiiiiiiiuuuuuuuunntsyy"));
	}
    
    private function countSubstrs($haystack, $needle) {
	$count = 0;
	while(strpos($haystack,$needle) !== false) {
	   $haystack = substr($haystack, (strpos($haystack,$needle) + 1));
	   $count++;
	}
	return $count;
}
}

?>
