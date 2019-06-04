<?php
if (session_status() == PHP_SESSION_NONE)
{
   session_start();
}

$_SESSION["CurPage"] = "Books.php";
?>

<!DOCTYPE html>
<html dir="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html;
charset=iso-8859-1">
    <title>Antiquities</title>
    <link rel="stylesheet" href="CSS/CSS.css">
  </head>
  <body>
    <?php
    include "Header.php";
    include "connection.php";
    include "Menu.php";
    include "Footer.php"; ?>
    <div class="books">
      <?php include "GetUsers.php";
    

            // Connection is no longer needed so we obviously close it.
            $conn->close();
            ?>

            <!-- This is the same as with the menu covering up the title, but here it's the pagination covering the news article, so a little space is needed. -->
        <br><br><br>

  </body>
</html>
