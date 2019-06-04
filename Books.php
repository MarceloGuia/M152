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
      <?php include "Pagenation.php";
      $Pagey = new Pagination();

      if (isset($_POST["filter"]))
      {
        $where = $_POST["filter"];
      }
      else
      {
        $where = "autor";
      }

      if (isset($_POST["searchfield"]))
      {
        $search = $_POST["searchfield"];
      }
      else
      {
        $search = "";
      }

      if (isset($_POST["order"]))
      {
        $order = $_POST["order"];
      }
      else
      {
        $order = "title";
      }

      $ArticlesPerPage = 21;
      $Offset = $Pagey->GetOffset($PageNr, $ArticlesPerPage);
      $TotalPages = $Pagey->DoLazyMaths($PageNr, $conn, $ArticlesPerPage, $where, $search);
      $Pagey->GetRelics($Offset, $ArticlesPerPage, $conn, $where, $search, $order);
      ?> </div> <?php
      $Pagey->EnlightPages($PageNr, $TotalPages);

      echo $PageNr;

            // Connection is no longer needed so we obviously close it.
            $conn->close();
            ?>

            <!-- This is the same as with the menu covering up the title, but here it's the pagination covering the news article, so a little space is needed. -->
        <br><br><br>

  </body>
</html>
