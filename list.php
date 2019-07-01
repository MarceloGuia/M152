<?php
if (session_status() == PHP_SESSION_NONE)
{
   session_start();
}

$_SESSION["CurPage"] = "list.php";


class FileManagement
{
  public function createFile($fileName, $path, $content)
  {
    if (file_exists ($path.$fileName))
    {
      return "Check your eyes ma man, cuz that file alredy exists...";
    }
    $myfile = fopen($path.$fileName, "w");
    fwrite($myfile, $content);
    return "Great success: ".$fileName." created at ".$path;
  }

  public function updateFile()
  {

  }

  public function deleteFile()
  {

  }
}
?>
<!DOCTYPE html>
<html dir="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html;
charset=iso-8859-1">
    <title>Notifications</title>
    <link rel="stylesheet" href="CSS/CSS.css">
  </head>
  <body>
    <?php
    include "Header.php";
    include "Menu.php";
    include "Footer.php";
     ?>



        <br><br><br><br><br><br><br>

        <form action="list.php" method="post">
          <input type="text" name="fileName" placeholder="Filename"> <br>
          <textarea name="content" rows="8" cols="80">Content</textarea>
          <input type="submit" name="Submit" value="Submit">
        </form>
        <?php
        $bob = new FileManagement();
        if (isset($_POST["Submit"]) && isset($_POST["fileName"]) && isset($_POST["content"]))
        {
          echo $bob->createFile($_POST["fileName"], "TextNotes/", $_POST["content"]);
        }
        else if (isset($_POST["Submit"]))
        {
          echo "Dude, your inputs are invalid.";
        } ?>
  </body>
</html>
