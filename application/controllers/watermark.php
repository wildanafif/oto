<?php 

//---- KONFIGURASI WATERMARK 


function watermark_image_png($oldimage_name, $new_image_name){
    $text_show  = "otomotifstore"; // watermark text
    $image_show = "assets/wtr3.png";   // watermark image
    $image_path =  $image_show ; 
    $font_path  = "GILSANUB.TTF"; // font
    $font_size  = 20;       // contoh 20 = 20px  
    $path = "uploads/";   // folder upload gambar setelah proses watermark
    
    list($owidth,$oheight) = getimagesize($oldimage_name);
    $width = $height = 300;    // tentukan ukuran gambar akhir, contoh: 300 x 300
    $im = imagecreatetruecolor($width, $height);
    $img_src = imagecreatefrompng($oldimage_name);
    imagecopyresampled($im, $img_src, 0, 0, 0, 0, $width, $height, $owidth, $oheight);
    $watermark = imagecreatefrompng($image_path);
    list($w_width, $w_height) = getimagesize($image_path);        
    $pos_x = $width - $w_width; 
    $pos_y = $height - $w_height;
    imagecopy($im, $watermark, $pos_x, $pos_y, 0, 0, $w_width, $w_height);
    imagepng($im, $new_image_name, 9); 
    imagedestroy($im);
    unlink($oldimage_name);
    return true;
}

function watermark_image_jpg($oldimage_name, $new_image_name){
    $text_show  = "otomotifstore"; // watermark text
    $image_show = "assets/wtr3.png";   // watermark image
    $image_path =  $image_show ; 
    $font_path  = "GILSANUB.TTF"; // font
    $font_size  = 20;       // contoh 20 = 20px  
    $path = "uploads/"; 
    list($owidth,$oheight) = getimagesize($oldimage_name);
    $width = $height = 300;    // tentukan ukuran gambar akhir, contoh: 300 x 300
    $im = imagecreatetruecolor($width, $height);
    $img_src = imagecreatefromjpeg($oldimage_name);
    imagecopyresampled($im, $img_src, 0, 0, 0, 0, $width, $height, $owidth, $oheight);
    $watermark = imagecreatefrompng($image_path);
    list($w_width, $w_height) = getimagesize($image_path);        
    $pos_x = $width - $w_width; 
    $pos_y = $height - $w_height;
    imagecopy($im, $watermark, $pos_x, $pos_y, 0, 0, $w_width, $w_height);
    imagejpeg($im, $new_image_name, 100); 
    imagedestroy($im);
    unlink($oldimage_name);
    return true;
}

function watermark_text($oldimage_name, $new_image_name){
    global $font_path, $font_size, $text_show;
    list($owidth,$oheight) = getimagesize($oldimage_name);
    $width = $height = 300;  // tentukan ukuran gambar akhir, contoh: 300 x 300  
    $image = imagecreatetruecolor($width, $height);
    $image_src = imagecreatefromjpeg($oldimage_name);
    imagecopyresampled($image, $image_src, 0, 0, 0, 0, $width, $height, $owidth, $oheight);  
	$blue   = imagecolorallocate($image, 255, 255, 255);  // tentukan warna teks dalam RGB (255,255,255)
	$shadow = imagecolorallocate($image, 178, 178, 178); // efek teks shadow
	imagettftext($image, $font_size, 0, 70, 191, $shadow, $font_path, $text_show);  // posisikan logo watermark pada gambar
    imagettftext($image, $font_size, 0, 68, 190, $blue, $font_path, $text_show);
    imagejpeg($image, $new_image_name, 100); 
    imagedestroy($image);
    unlink($oldimage_name);
    return true;
}

$demo_image = "";

?>

