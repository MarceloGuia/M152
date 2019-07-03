<?php

class ImageManagement
{
  public function compressImages($directory, $destination)
  {
    $list = scandir($directory);

    $size = getimagesize($source);

    if ($size['mime'] == 'image/jpeg')
    {
      $image = imagecreatefromjpeg($source);
    }
    else if ($size['mime'] == 'image/gif')
    {
      $image = imagecreatefromgif($source);
    }
    else if ($size['mime'] == 'image/png')
    {
      $image = imagecreatefrompng($source);
    }

    imagejpeg($image, $destination, $quality);

    return $destination;
  }
}

?>
