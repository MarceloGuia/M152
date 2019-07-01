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

  public function updateFile($fileName, $path, $content)
  {
    if (file_exists ($path.$fileName))
    {
      $myfile = fopen($path.$fileName, "w");
      fwrite($myfile, $content);
      return "Successfully updated ".$fileName." at ".$path;
    }
    return nl2br("Failed hard: ".$fileName." does not exist at ".$path."\n");
  }

  public function deleteFile()
  {

  }

  public function listFiles($directory)
  {
    $list = scandir($directory);
    echo nl2br("The following files are in $directory: \n");
    for ($i = 0; $i < count($list); $i++)
    {
      if ($i != 0 && $i != 1)
      {
        echo $list[$i];
        if ($i + 1 < count($list))
        {
          echo ", ";
        }
      }
    }
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

        <h2>Available Files:</h2>
        <?php $bob = new FileManagement();

        // Creation of File
        if (isset($_POST["Submit"]) && isset($_POST["fileName"]) && isset($_POST["content"]))
        {
          echo nl2br($bob->createFile($_POST["fileName"], "TextNotes/", $_POST["content"])."\n");
        }
        else if (isset($_POST["Submit"]))
        {
          echo "Dude, your inputs are invalid.";
        }

        // Updating of File
        if (isset($_POST["Submit2"]) && isset($_POST["fileName"]) && isset($_POST["content"]))
        {
          echo $bob->updateFile($_POST["fileName"], "TextNotes/", $_POST["content"]);
        }
        else if (isset($_POST["Submit2"]))
        {
          echo "Dude, your inputs are invalid.";
        }

        $bob->listFiles("TextNotes/") ?>

        <h2>Create a file:</h2>
        <form action="list.php" method="post">
          <input type="text" name="fileName" placeholder="Filename" required> <br>
          <textarea name="content" rows="8" cols="80" required>Content</textarea>
          <input type="submit" name="Submit" value="Submit">
        </form>

        <h2>Update a file: (Note: this will overwrite the old content!)</h2>
        <form action="list.php" method="post">
          <input type="text" name="fileName" placeholder="Filename" required> <br>
          <textarea name="content" rows="8" cols="80" required>Content</textarea>
          <input type="submit" name="Submit2" value="Submit">
        </form>
        <?php ?>
  </body>
</html>
