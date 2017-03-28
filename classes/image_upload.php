<?php

class image_upload{
    protected $upload_dir; 				// The directory for the images to be saved in
    protected $upload_path;				// The path to where the image will be saved
    protected $large_image_name; 		// New name of the large image
    protected $thumb_image_name; 	// New name of the thumbnail image
    protected $max_file; 						// Approx 1MB
    protected $max_width;							// Max width allowed for the large image
    protected $thumb_width;						// Width of thumbnail image
    protected $thumb_height;						// Height of thumbnail image
    
    public function __construct($upload_dir, $upload_path, $large_image_name, $thumb_image_name, $max_file, $max_width, $thumb_width,$thumb_height) 
    {
      $this->upload_dir = $upload_dir;
      $this->upload_path = $upload_path;
      $this->large_image_name = $large_image_name;
      $this->thumb_image_name = $thumb_image_name;
      $this->max_file = $max_file;
      $this->max_width = $max_width;
      $this->thumb_width = $thumb_width;
      $this->thumb_height = $thumb_height;
      
      //Create the upload directory with the right permissions if it doesn't exist
        if(!is_dir($this->upload_dir)){
                mkdir($this->upload_dir, 0777);
                chmod($this->upload_dir, 0777);
        }
    }

    public function image_pre_check($image_format, $image_size)
    {
        if(($image_format=="gd" || $image_format=="gd2" || $image_format=="gif" || $image_format=="jpeg" || $image_format=="jpg" || $image_format=="png" || $image_format=="bmp" || $image_format=="bm" || $image_format=="pm")&& ($image_size<= $this->max_file))
        {
            return "pass";
        }   
        else
        {
            return "fail";
        }
    }
    
    public function resizeImage($image, $file_ext, $width,$height,$scale) {
            $newImageWidth = ceil($width * $scale);
            $newImageHeight = ceil($height * $scale);
            $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
            
            $source = $this->image_convert_to_jpeg($image, $file_ext);
            
            imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
            imagejpeg($newImage,$image,90);
            chmod($image, 0777);
            return $image;
    }
    
    public function resizeNewImage($new_Image, $image, $file_ext, $width,$height,$scale) {
            $newImageWidth = ceil($width * $scale);
            $newImageHeight = ceil($height * $scale);
            $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
            
            $source = $this->image_convert_to_jpeg($image, $file_ext);
            
            imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
            imagejpeg($newImage,$new_Image,90);
            chmod($new_Image, 0777);
            return $new_Image;
    }
    
    public function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
            $newImageWidth = ceil($width * $scale);
            $newImageHeight = ceil($height * $scale);
            $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
            $source = imagecreatefromjpeg($image);
            imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
            imagejpeg($newImage,$thumb_image_name,90);
            chmod($thumb_image_name, 0777);
            return $thumb_image_name;
    }

    public function getHeight($image) {
            $sizes = getimagesize($image);
            $height = $sizes[1];
            return $height;
    }
    //You do not need to alter these functions
    public function getWidth($image) {
            $sizes = getimagesize($image);
            $width = $sizes[0];
            return $width;
    }
    
    public function image_convert_to_jpeg($image, $image_format)
    {
        try
        {
            if($image_format=="gd")
            {
                return imagecreatefromgd($image);
            }
            else if($image_format=="gd2")
            {
                return imagecreatefromgd2($image);
            }
            else if($image_format=="gif")
            {
                return imagecreatefromgif($image);
            }
            else if($image_format=="jpeg" || $image_format=="jpg")
            {
                return imagecreatefromjpeg($image);
            }
            else if($image_format=="png")
            {
                return imagecreatefrompng($image);
            }
            else if($image_format=="bmp")
            {
                return imagecreatefromwbmp($image);
            }
            else if($image_format=="bm")
            {   
                return imagecreatefromxbm($image);
            }
            else if($image_format=="pm")
            {
                return imagecreatefromxpm($image);
            }
            else
            {
                return ;
            }
        }
        catch (PDOException $e)
        {
          echo $e->getMessage();
        }
    }

}






?>
