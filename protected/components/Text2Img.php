<?php

/**
 * Created by PhpStorm.
 * User: Fdox-Rajib
 * Date: 4/10/2015
 * Time: 12:11 PM
 */
class Text2Img
{

    public function init()
    {
        //echo "Initiated";
    }

    var $font = 'fonts/arial.ttf'; //default font. directory
    // relative to
    // script
    // directory.
    var $msg = ""; // default text to display.
    var $size = 100; // default font size.
    var $rot = 0; // rotation in degrees.
    var $pad = 0; // padding
    var $transparent = 0; // transparency set to on.
    var $red = 0; // black text...
    var $grn = 0;
    var $blu = 0;
    var $bg_red = 255; // on white background.
    var $bg_grn = 255;
    var $bg_blu = 255;

    function draw($width, $height, $text, $size, $bgcolor, $textcolor)
    {
        $width = 0;
        $height = 0;
        $offset_x = 0;
        $offset_y = 0;
        $bounds = array();
        $image = "";

        // get the font height.
        $bounds = ImageTTFBBox($this->size, $this->rot, $this->font, "W");
        if ($this->rot < 0) {
            $font_height = abs($bounds[7] - $bounds[1]);
        } else if ($this->rot > 0) {
            $font_height = abs($bounds[1] - $bounds[7]);
        } else {
            $font_height = abs($bounds[7] - $bounds[1]);
        }
        // determine bounding box.
        $bounds = ImageTTFBBox($this->size, $this->rot, $this->font, $this->msg);
        if ($this->rot < 0) {
            $width = abs($bounds[4] - $bounds[0]);
            $height = abs($bounds[3] - $bounds[7]);
            $offset_y = $font_height;
            $offset_x = 0;
        } else if ($this->rot > 0) {
            $width = abs($bounds[2] - $bounds[6]);
            $height = abs($bounds[1] - $bounds[5]);
            $offset_y = abs($bounds[7] - $bounds[5]) + $font_height;
            $offset_x = abs($bounds[0] - $bounds[6]);
        } else {
            $width = abs($bounds[4] - $bounds[6]);
            $height = abs($bounds[7] - $bounds[1]);
            $offset_y = $font_height;;
            $offset_x = 0;
        }

        $image = imagecreate($width + ($this->pad * 2) + 1, $height + ($this->pad * 2) + 1);
        $background = ImageColorAllocate($image, $this->bg_red, $this->bg_grn, $this->bg_blu);
        $foreground = ImageColorAllocate($image, $this->red, $this->grn, $this->blu);

        if ($this->transparent)
            ImageColorTransparent($image, $background);
        ImageInterlace($image, false);

        // render the image
        ImageTTFText($image, $this->size, $this->rot, $offset_x + $this->pad, $offset_y + $this->pad, $foreground, $this->font, $this->msg);
        return $image;
        // output PNG object.
        //imagePNG($image);
    }

    //for hex2rgb convert

    function hex2rgb($hex)
    {
        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);
        //return implode(",", $rgb); // returns the rgb values separated by commas
        return $rgb; // returns an array with the rgb values
    }

    function testimg()
    {
        $bg = imagecreate(763, 45);
        imagecolorallocate($bg, 0, 0, 0);

        $front = imagecreate(381.5, 45);
        imagecolorallocate($front, 255, 255, 255);

        $back = imagecreate(381.5, 45);
        imagecolorallocate($back, 230, 29, 46);

        imagepng($bg);
    }

    function writeText($width, $height, $backColor, $color, $fs, $text)
    {
        $im = ImageCreate($width, $height);

        // white background and blue text
        $hex = $this->hex2rgb($backColor);
        $bg = ImageColorAllocate($im, $hex[0], $hex[1], [2]);

        // grey border
        //$border = ImageColorAllocate($im, 207, 199, 199);
        //ImageRectangle($im, 0, 0, $width - 1, $height - 1, $border);

        //$text = 'This is my photo description text.';
        $hex = $this->hex2rgb($color);
        $textcolor = ImageColorAllocate($im, $hex[0], $hex[1], $hex[2]);

        // Font Size
        $font = $fs;

        $font_width = ImageFontWidth($font);
        $font_height = ImageFontHeight($font);

        /*
        -----------
        Text Width
        -----------
        */

        $text_width = $font_width * strlen($text);

        // Position to align in center
        $position_center = ceil(($width - $text_width) / 2);

        /*
        -----------
        Text Height
        -----------
        */

        $text_height = $font_height;

        // Position to align in abs middle
        $position_middle = ceil(($height - $text_height) / 2);

        /*
        -----------------
        Write the string
        -----------------
        */

        $image_string = ImageString($im, $font, $position_center, $position_middle, $text, $textcolor);
        //return $im;
        imagepng($im);
    }


    function drawAgain($width, $height, $text, $size, $bgcolor, $textcolor, $font)
    {
        $offset_x = 0;
        $offset_y = 0;
        $bounds = array();
        $image = "";

        // get the font height.
        $bounds = ImageTTFBBox($font_size, 0, $font, 'AYWyi');
        $font_heights = abs($bounds[7]-$bounds[1]);

        $font_size = $this->gotsize($size, 0, $font, $text, $width);
        // determine bounding box.
        $bounds = ImageTTFBBox($font_size, 0, $font, $text);
        $font_height = abs($bounds[7]-$bounds[1]);
        $font_width = abs($bounds[4] - $bounds[6]);
        //$width = $this->gotsize($size, 0, $font, $text);
        //$height = abs($bounds[7] - $bounds[1]);
        //$offset_y = $font_size;
        $offset_y = $font_heights+32; //$this->gotY($font_size,$font_width,$font_height);
        $offset_x = round(($width - $font_width) / 2);

        //$image = imagecreate($width + (0 * 2) + 1, $height + (0 * 2) + 1);
        $image = imagecreate($width, $height);
        $bg = $this->hex2rgb($bgcolor);
        $background = ImageColorAllocate($image, $bg[0], $bg[1], $bg[2]);
        
        $col = $this->hex2rgb($textcolor);
        $foreground = ImageColorAllocate($image, $col[0], $col[1], $col[2]);
        
        

        //if ($this->transparent)
        ImageColorTransparent($image, $background);
        ImageInterlace($image, false);

        // render the image
        ImageTTFText($image, $font_size, 0, $offset_x, $offset_y, $foreground, $font, $text);
        return array('image'=>$image,'x'=>$offset_x,'w'=>$font_width,'h'=>$font_height);
        // output PNG object.
        //imagePNG($image);
    }
    
    function drawVinyl($width, $height, $text, $size, $bgcolor, $textcolor, $font)
    {
        $offset_x = 0;
        $offset_y = 0;
        $bounds = array();
        $image = "";

        // get the font height.
        $bounds = ImageTTFBBox($font_size, 0, $font, 'AYWyi');
        $font_heights = abs($bounds[7]-$bounds[1]);

        $font_size = $this->gotsize($size, 0, $font, $text, $width);
        // determine bounding box.
        $bounds = ImageTTFBBox($font_size, 0, $font, $text);
        $font_height = abs($bounds[7]-$bounds[1]);
        $font_width = abs($bounds[4] - $bounds[6]);
        //$width = $this->gotsize($size, 0, $font, $text);
        //$height = abs($bounds[7] - $bounds[1]);
        //$offset_y = $font_size;
        $offset_y = $font_heights+32; //$this->gotY($font_size,$font_width,$font_height);
        //$offset_x = round(($width - $font_width) / 2);
        $offset_x = 0;

        //$image = imagecreate($width + (0 * 2) + 1, $height + (0 * 2) + 1);
        $image = imagecreate($width, $height);
        $bg = $this->hex2rgb($bgcolor);
        $background = ImageColorAllocate($image, $bg[0], $bg[1], $bg[2]);
        
        $col = $this->hex2rgb($textcolor);
        $foreground = ImageColorAllocate($image, $col[0], $col[1], $col[2]);
        
        

        //if ($this->transparent)
        ImageColorTransparent($image, $background);
        ImageInterlace($image, false);

        // render the image
        ImageTTFText($image, $font_size, 0, $offset_x, $offset_y, $foreground, $font, $text);
        return array('image'=>$image,'x'=>$offset_x,'w'=>$font_width,'h'=>$font_height);
        // output PNG object.
        //imagePNG($image);
    }
    
    function drawTyvek($width, $height, $text, $size, $bgcolor, $textcolor, $font)
    {
        $offset_x = 0;
        $offset_y = 0;
        $bounds = array();
        $image = "";

        // get the font height.
        $bounds = ImageTTFBBox($font_size, 0, $font, 'AYWyi');
        $font_heights = abs($bounds[7]-$bounds[1]);

        //$font_size = $this->gotsize($size, 0, $font, $text, $width);
        $font_size = $size;
        // determine bounding box.
        $bounds = ImageTTFBBox($font_size, 0, $font, $text);
        $font_height = abs($bounds[7]-$bounds[1]);
        $font_width = abs($bounds[4] - $bounds[6]);
        //$width = $this->gotsize($size, 0, $font, $text);
        //$height = abs($bounds[7] - $bounds[1]);
        //$offset_y = $font_size;
        $offset_y = $font_heights+32; //$this->gotY($font_size,$font_width,$font_height);
        $offset_x = 0;//round(($width - $font_width) / 2);

        //$image = imagecreate($width + (0 * 2) + 1, $height + (0 * 2) + 1);
        $image = imagecreate($width, $height);
        $bg = $this->hex2rgb($bgcolor);
        $background = ImageColorAllocate($image, $bg[0], $bg[1], $bg[2]);
        
        $col = $this->hex2rgb($textcolor);
        $foreground = ImageColorAllocate($image, $col[0], $col[1], $col[2]);
        
        

        //if ($this->transparent)
        ImageColorTransparent($image, $background);
        ImageInterlace($image, false);

        // render the image
        ImageTTFText($image, $font_size, 0, $offset_x, $offset_y, $foreground, $font, $text);
        return array('image'=>$image,'x'=>$offset_x,'w'=>$font_width,'h'=>$font_height);
        // output PNG object.
        //imagePNG($image);
    }
    
    function drawLanyard($width, $height, $text, $size, $bgcolor, $textcolor, $font)
    {
        
        
        
        $offset_x = 0;
        $offset_y = 0;
        $bounds = array();
        $image = "";
        
        
        
        // get the font height.
        $bounds = ImageTTFBBox($font_size, 0, $font, $text);
        $font_heights = abs($bounds[7]-$bounds[1]);

        $font_size = $this->gotsize($size, 0, $font, $text, $width);
        // determine bounding box.
        $bounds = ImageTTFBBox($font_size, 0, $font, $text);
        $font_height = abs($bounds[7]-$bounds[1]);
        $font_width = abs($bounds[4] - $bounds[6]);
        //$width = $this->gotsize($size, 0, $font, $text);
        //$height = abs($bounds[7] - $bounds[1]);
        //$offset_y = $font_size;
        $offset_y = $font_heights+30; //$this->gotY($font_size,$font_width,$font_height);
        $offset_x = round(($width - $font_width) / 2);

        //$image = imagecreate($width + (0 * 2) + 1, $height + (0 * 2) + 1);
        $image = imagecreate($width, $height);
        
        $bg = $this->hex2rgb($bgcolor);
        $background = ImageColorAllocate($image, $bg[0], $bg[1], $bg[2]);
        /*$background = ImageColorAllocatealpha($image, 255, 255, 255, 127);
        imagealphablending($image, false);
        imagesavealpha($image, true);*/
        
        $col = $this->hex2rgb($textcolor);
        $foreground = ImageColorAllocate($image, $col[0], $col[1], $col[2]);
        
        //if ($this->transparent)
        ImageColorTransparent($image, $background);
        ImageInterlace($image, true);

        // render the image
        ImageTTFText($image, 25, 0, $offset_x, $offset_y, $foreground, $font, $text);
        return array('image'=>$image,'x'=>$offset_x,'w'=>$font_width,'h'=>$font_height);
        // output PNG object.
        //imagePNG($image);
    }


    function gotY($size, $width, $height){
        //return round((45-$height)/2);
        return ($height/2)+10;
    }

    function gotsize($size, $rot, $font, $text, $fixedwidth){
        $bb = ImageTTFBBox($size, $rot, $font, $text);
        $width = abs($bb[4] - $bb[6]);
        if($width>($fixedwidth-3))
            return $this->gotsize($size-1, $rot, $font, $text, $fixedwidth);
        else
            return $size;

    }
    
    

    function resizeMyImage($file, $destination, $w, $h) {
        //Get the original image dimensions + type
        list($source_width, $source_height, $source_type) = getimagesize($file);

        //Figure out if we need to create a new JPG, PNG or GIF
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if ($ext == "jpg" || $ext == "jpeg") {
            $source_gdim=imagecreatefromjpeg($file);
        } elseif ($ext == "png") {
            $source_gdim=imagecreatefrompng($file);
        } elseif ($ext == "gif") {
            $source_gdim=imagecreatefromgif($file);
        } else {
            //Invalid file type? Return.
            return;
        }

        //If a width is supplied, but height is false, then we need to resize by width instead of cropping
        if ($w && !$h) {
            $ratio = $w / $source_width;
            $temp_width = $w;
            $temp_height = $source_height * $ratio;

            $desired_gdim = imagecreatetruecolor($temp_width, $temp_height);
            imagealphablending($desired_gdim, false);
            imagesavealpha($desired_gdim,true);
            $transparent = imagecolorallocatealpha($desired_gdim, 255, 255, 255, 0);
            imagefilledrectangle($desired_gdim, 0, 0, $temp_width, $temp_height, $transparent);

            imagecopyresampled(
                $desired_gdim,
                $source_gdim,
                0, 0,
                0, 0,
                $temp_width, $temp_height,
                $source_width, $source_height
            );
        } else {
            $source_aspect_ratio = $source_width / $source_height;
            $desired_aspect_ratio = $w / $h;

            if ($source_aspect_ratio > $desired_aspect_ratio) {
                /*
                 * Triggered when source image is wider
                 */
                $temp_height = $h;
                $temp_width = ( int ) ($h * $source_aspect_ratio);
            } else {
                /*
                 * Triggered otherwise (i.e. source image is similar or taller)
                 */
                $temp_width = $w;
                $temp_height = ( int ) ($w / $source_aspect_ratio);
            }

            /*
             * Resize the image into a temporary GD image
             */

            $temp_gdim = imagecreatetruecolor($temp_width, $temp_height);
            imagealphablending($temp_gdim, false);
            imagesavealpha($temp_gdim, true);
            $transparent = imagecolorallocatealpha($temp_gdim, 255, 255, 255, 127);
            imagefilledrectangle($temp_gdim, 0, 0, $width, $height, $transparent);

            imagecopyresampled(
                $temp_gdim,
                $source_gdim,
                0, 0,
                0, 0,
                $temp_width, $temp_height,
                $source_width, $source_height
            );

            /*
             * Copy cropped region from temporary image into the desired GD image
             */

            $x0 = ($temp_width - $w) / 2;
            $y0 = ($temp_height - $h) / 2;
            $desired_gdim = imagecreatetruecolor($w, $h);
            imagecopy(
                $desired_gdim,
                $temp_gdim,
                0, 0,
                $x0, $y0,
                $w, $h
            );
        }

        /*
         * Render the image
         * Alternatively, you can save the image in file-system or database
         */

        /*if ($ext == "jpg" || $ext == "jpeg") {
            ImageJpeg($desired_gdim,$destination,100);
        } elseif ($ext == "png") {
            ImagePng($desired_gdim,$destination);
        } elseif ($ext == "gif") {
            ImageGif($desired_gdim,$destination);
        } else {
            return;
        }

        ImageDestroy ($desired_gdim);*/
        return $desired_gdim;
    }

    function resizePng($im, $dst_width, $dst_height,$color='#000') {
        $im = imagecreatefrompng($im);
        $fcolor = $this->hex2rgb($color);
        //imagefilter($im, IMG_FILTER_NEGATE);


        $width = imagesx($im);
        $height = imagesy($im);
        $newImg = imagecreatetruecolor($dst_width, $dst_height);

        imagealphablending($newImg, false);
        imagesavealpha($newImg, true);
        $transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);

        imagefilledrectangle($newImg, 0, 0, $width, $height, $transparent);
        imagecopyresampled($newImg, $im, 0, 0, 0, 0, $dst_width, $dst_height, $width, $height);
        imagefilter($newImg, IMG_FILTER_COLORIZE, $fcolor[0], $fcolor[1], $fcolor[2]);//change color
        return $newImg;
    }

    function getX($get){
        if($get>0)
            return $get;
        else
            return 2;
    }

    function getBoxSizes($type){
        if(isset($_GET['msgType']) && $_GET['msgType']=='Front/Back'){
            return array('l'=>'32','m'=>'300','r'=>'32','height'=>'45');
        }else{
            return array('l'=>'32','m'=>'600','r'=>'32','height'=>'45');
        }
    }
    
    function getBoxSizesTyvek($type){
        return array('l'=>'32','m'=>'456','r'=>'32','height'=>'45');
    }
}



