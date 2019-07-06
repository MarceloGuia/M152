<?php
if (session_status() == PHP_SESSION_NONE)
{
   session_start();
}

$_SESSION["CurPage"] = "index.php";
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php include "Header.php"; ?>
    <meta charset="utf-8">
    <title>Title</title>
    <link rel="stylesheet" href="CSS/CSS.css">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
  </head>
  <body>
    <br><br><br>
    <?php
  include "Menu.php";?>

    <div class="books">

    </div>
    <div class=pic>
      <img src="rsc/Test.gif" alt="" class="pic">
      <iframe
      width="560"
      height="315"
      src="https://www.youtube.com/embed/eYbUTvpyuQ8"
       frameborder="0"
       allow="accelerometer;
       autoplay;
       encrypted-media;
       gyroscope;
       picture-in-picture"
       allowfullscreen>
     </iframe>
     <audio controls>
    <source src="Audio/curb.ogg" type="audio/ogg">
    <source src="Audio/Audio.aac" type="audio/aac">
    Your browser does not support the audio element.
    </audio>

      <?php $gif = imagecreatefromjpeg('rsc/Marc.jpeg');
      $size = min(imagesx($gif), imagesy($gif));
      $gif = imagecrop($gif, ['x' => $size*0.4, 'y' => 0, 'width' => $size, 'height' => $size]);
      $gif = imagescale($gif, 300);
      ?>


    </div>



    <br> <?php include "Footer.php"; ?>
  </body>
</html>
