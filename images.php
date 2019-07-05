<?php
// A class to manage the images for the Photogallary
class ImageManagement
{

  // This function takes all images from one directory and compresses them into a jpeg file with
  // the amount of quality specified by the user.
  public function compressImages($directory, $destination, $quality)
  {
    // Scans the directory for any files.
    $list = scandir($directory);

    // Permissions are handled here, so that any issues when calling the imagejpeg() function
    // are avoided. By changing permissions to 777 we are allowing full access to both directories.
    chmod("CompressedImages", 777);
    chmod("Images", 777);

    // Here we loop through the found files in the directory. However the first two will always
    // be . and .. (Researched why, but didn't find a conclusive answer, my guess is that these
    // would be for navigation, . being going one level back and .. being going back to the root).
    // Because we don't want those two, we'll skip the first 2 spots in the array, so that only
    // only the images are processed.
    for ($i = 0; $i < count($list); $i++)
    {
      if ($i != 0 && $i != 1)
      {
        // Part of this code was taken from online, but adapted for our needs. The images
        // are first saved into a variable, then we determine what type of image it is, create a
        // resource out of it and using imagejpeg() we create a jpeg out of it with the desired
        // quality. Note that, since jpeg's don't support transparent backgrounds,
        // using this with transparent backgrounds will cause GIF's
        // backgrounds to turn lime green and PNG's backgrounds to turn black.
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
        imagejpeg($image, $destination."/".$list[$i], $quality);
      }
    }
  }

// This function will generate links to all images in a directory and display them as
// thumbnails to click on.
  public function showLinks($directory)
  {
    $list = scandir($directory);
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
    $bob->compressImages("Images", "CompressedImages", 70);
    ?>

    <a href="Images/HowYouWillLookAfterAnthem.jpg">test</a>
  </body>
</html>
