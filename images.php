<?php

class ImageManagement
{
  public function compressImages($directory, $destination, $quality)
  {
    $list = scandir($directory);

    chmod("CompressedImages", 777);
    chmod("Images", 777);

    for ($i = 0; $i < count($list); $i++)
    {
      if ($i != 0 && $i != 1)
      {
        echo "Images/".$list[$i];
        //chmod("Images/".$list[$i], 777);

        $size = getimagesize("Images/".$list[$i]);

        $image;
        if ($size['mime'] == 'image/jpeg')
        {
          $image = imagecreatefromjpeg("Images/".$list[$i]);
        }
        else if ($size['mime'] == 'image/gif')
        {
          $image = imagecreatefromgif("Images/".$list[$i]);
        }
        else if ($size['mime'] == 'image/png')
        {
          $image = imagecreatefrompng("Images/".$list[$i]);
        }
        //echo $image;
        imagejpeg($image, $destination."/".$list[$i], $quality);
      }
    }

    return "Success!";
  }
}
?>

<!DOCTYPE html>
<html dir="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Notifications</title>
    <link rel="stylesheet" href="CSS/CSS.css">
  </head>
  <body>
    <?php
    $bob = new ImageManagement();
    echo $bob->compressImages("Images", "CompressedImages", 70);
    ?>
  </body>
</html>
