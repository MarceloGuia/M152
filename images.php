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

    // Since this function is supposed to be used in the next function, we'll return the
    // array with all the image names, to avoid scanning the same directory twice.
    return $list;
  }

// This function will generate links to all images in a directory and display them as
// thumbnails to click on.
  public function showLinks($directory, $compressedDirectory, $quality)
  {
    // We first generate all thumbnails and retrieve the array with all the image names.
    $list = $this->compressImages($directory, $compressedDirectory, $quality);

    // The same as above, except now we loop through to create the links for the images.
    // the thumbnails we create in the beginning serve as links and the href is the image
    // itself. This way we show the thumbnail as a link but get the full image as a result
    // of clicking on it. Bootstrap was used to display the images in a carousel.
    echo '<div id="multi-item-example" class="carousel slide carousel-multi-item carousel-multi-item-2" data-ride="carousel">
    <div class="pic">
      <div class="controls-top">
        <a class="black-text" href="#multi-item-example" data-slide="prev"><i class="fas fa-angle-left fa-3x pr-3">Previous</i></a>
        <a class="black-text" href="#multi-item-example" data-slide="next"><i class="fas fa-angle-right fa-3x pl-3">Next</i></a>
      </div>
      <div class="carousel-inner" role="listbox">';
    $count = 0;
    for ($i = 0; $i < count($list); $i++)
    {
      if ($i != 0 && $i != 1)
      {
        if ($i == 3)
        {
          echo '<div class="carousel-item active">';
        }
        else if ($count == 4)
        {
          $count == 0;
          echo '<div class="carousel-item">';
        }
        echo '<div class="col-md-3 mb-3">
          <div class="card">
          <a class="img-fluid" href="'.$directory.'/'.$list[$i].'"><img src="'.$compressedDirectory.'/'.$list[$i].'" alt="'.$list[$i].'"></a>
        </div>
        </div>';
        $count++;
        if ($count == 4)
        {
          echo '</div>';
        }
      }
    }
    echo '</div>
    </div>
    </div>';
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
    include "Header.php";
    include "Menu.php";
    include "Footer.php";;

    $bob = new ImageManagement();
    $bob->showLinks("Images", "CompressedImages", 70);
    ?>
  </body>
</html>
