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
    <br><br><br><br><br><br>
    <?php
  include "Menu.php";?>

    <div class="books">
      <!-- This is the Webcam we chose. We chose this one, because it shows us, both good and
           bad examples of a webcam. On this link you can switch between a webcam in Basel
           and one in Weil am Rhein. The one in Basel is clearly distanced from people and it's
           pretty much impossible to recognise people, even tho many people a captured. It also
           focuses on a Hotel and the scenery, so it is useful for tourists.
           The one in Weil am Rhein however, is very close to people and focuses on an open
           area, where people like to hang around at. The moment the camera switched, I was
           able to see a woman and a man and their faces were very visible to me. For this
           reason I believe that webcam is bad, since it clearly can be used to recognise others
           and technically invades privacy. Also it focuses on a café/restaurant and a building
           with a guard outside. While the building being guarded would have an advantage if
           someone is watching that camera in the right moment, the fact that people are being
           recorded, while chilling outside, eating or drinking something, really makes this camera
           bad. The café/restaurant may be further away and it's harder to recognise people there,
           but you could still easily recignise someone by their style...
           Both cameras seem to have a rotating angle of around 90°. And that works perfectly
           for the one in Basel, as it only glares over a bridge quite far away from the camera
           and the rest is just the Rhine and some scenery from Basel. The one in Weil am Rhein
           however rotates between the café/restaurant and the guarded building. The fact that it
           looks at the café/restaurant from time to time, is the worst part about it. But even if
           it were only focused on the guarded building, it's too close to a public road and still
           invades people's privacy.
           The spectator has no control over the camera however, so that is a plus for both cameras.

           WARNING: We just realised, that these webcams have wroking hours, so depending on what time
           you’re trying to access them, they might be out of order. We already tested it on a Tuesday
           at around 10:00 and it also worked on a Saturday at 9:00. We realised it’s out of order on
           a Saturday at 23:14, so if you’re having issues viewing it, you may need to try later.-->
      <a href="https://www.webcams.travel/webcam/stream/1437749515">Good and Bad example of a Webcam</a>
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

      <?php

      // This is for the GD Library and we're doing pretty much the same here as in
      // the images page, except we're pasting 2 pics on top of one pic, to make an
      // image containing The school logo and our names.
      $img = imagecreatefromjpeg("GDPic/Blank.jpg");
      $imgToPaste1 = GetImageSize("GDPic/Names.jpg");

      $img2;
      if($imgToPaste1[2] == 1)
      {
        $img2 = imagecreatefromgif("GDPic/Names.jpg");
      }
      if($imgToPaste1[2] == 2)
      {
        $img2 = imagecreatefromjpeg("GDPic/Names.jpg");
      }
      if($imgToPaste1[2] == 3)
      {
        $img2 = imagecreatefrompng("GDPic/Names.jpg");
      }

      $img3;
      if($imgToPaste1[2] == 1)
      {
        $img3 = imagecreatefromgif("GDPic/WMS.jpg");
      }
      if($imgToPaste1[2] == 2)
      {
        $img3 = imagecreatefromjpeg("GDPic/WMS.jpg");
      }
      if($imgToPaste1[2] == 3)
      {
        $img3 = imagecreatefrompng("GDPic/WMS.jpg");
      }

      imagecopy($img, $img3, (imagesx($img)/2)-(imagesx($img3)/2), (imagesy($img)/2)-(imagesy($img3)/2), 0, 0, imagesx($img3), imagesy($img3));
      imagecopy($img, $img2, 0/*(imagesx($img)/2)-(imagesx($img2)/2)*/, (imagesy($img)/4*3)/*-(imagesy($img2)/4*3)*/, 0, 0, imagesx($img2), imagesy($img2));

      imagejpeg($img,"GDPic/FinalProduct.jpg",90);
      imagedestroy($img);
      imagedestroy($img2);
      imagedestroy($img3);
      ?>

        <img src="GDPic/FinalProduct.jpg" alt="FinalProduct">

    </div>



    <br> <?php include "Footer.php"; ?>
  </body>
</html>
