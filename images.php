<?php

class ImageManagement
{
  public function compressImages($directory, $destination, $quality)
  {
    $list = scandir($directory);

    for ($i = 0; $i < count($list); $i++)
    {
      if ($i != 0 && $i != 1)
      {
        $size = getimagesize($list[$i]);

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
    echo $bob->compressImages("");
    ?>
  </body>
</html>
