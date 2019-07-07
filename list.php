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
      return nl2br("Check your eyes ma man, cuz that file alredy exists...\n");
    }
    $myfile = fopen($path.$fileName, "w");
    fwrite($myfile, $content);
    return nl2br("Great success: ".$fileName." created at ".$path."\n");
  }

  public function updateFile($fileName, $path, $content)
  {
    if (file_exists ($path.$fileName))
    {
      $myfile = fopen($path.$fileName, "w");
      fwrite($myfile, $content);
      return nl2br("Successfully updated ".$fileName." at ".$path."\n");
    }
    return nl2br("Failed hard: ".$fileName." does not exist at ".$path."\n");
  }

  public function deleteFile($fileName, $path)
  {
    if (file_exists ($path.$fileName))
    {
      $check = unlink($path.$fileName);
      if ($check)
      {
        return nl2br("Successfully deleted ".$fileName." at ".$path."\n");
      }
      return nl2br("An error occured while deleting the file!\n");
    }
    return nl2br("Failed hard: ".$fileName." does not exist at ".$path."\n");
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

  public function showText($directory)
  {
    $list = scandir($directory);
    for ($i = 0; $i < count($list); $i++)
    {
      if ($i != 0 && $i != 1)
      {
        echo nl2br($list[$i].":\n");
        $file = fopen($directory.$list[$i], "r");
        if (filesize($directory.$list[$i]) > 0)
        {
          echo fread($file, filesize($directory.$list[$i]));
        }
        else
        {
          echo "This file is empty!";
        }
        fclose($file);
        echo nl2br("\n \n");
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
          echo $bob->createFile($_POST["fileName"], "TextNotes/", $_POST["content"]);
        }
        else if (isset($_POST["Submit"]))
        {
          echo nl2br("Dude, your inputs are invalid.\n");
        }

        // Updating of File
        if (isset($_POST["Submit2"]) && isset($_POST["fileName"]) && isset($_POST["content"]))
        {
          echo $bob->updateFile($_POST["fileName"], "TextNotes/", $_POST["content"]);
        }
        else if (isset($_POST["Submit2"]))
        {
          echo nl2br("Dude, your inputs are invalid.\n");
        }

        if (isset($_POST["Submit3"]) && isset($_POST["fileName"]))
        {
          echo $bob->deleteFile($_POST["fileName"], "TextNotes/");
        }
        else if (isset($_POST["Submit3"]))
        {
          echo nl2br("Dude, your inputs are invalid.\n");
        }

        $bob->listFiles("TextNotes/") ?>

        <h2>Create a file:</h2>
        <form action="list.php" method="post">
          <input type="text" name="fileName" placeholder="Filename" required> <br>
          <textarea name="content" rows="8" cols="80" required>Content</textarea>
          <input type="submit" name="Submit" value="Create">
        </form>

        <h2>Update a file: (Note: this will overwrite the old content!)</h2>
        <form action="list.php" method="post">
          <input type="text" name="fileName" placeholder="Filename" required> <br>
          <textarea name="content" rows="8" cols="80" required>Content</textarea>
          <input type="submit" name="Submit2" value="Update">
        </form>

        <h2>Delete a file:</h2>
        <form action="list.php" method="post">
          <input type="text" name="fileName" placeholder="Filename" required>
          <input type="submit" name="Submit3" value="Delete">
        </form>

        <br><br>
        <h2>Here are the existing notes:</h2>
        <br>
        <?php $bob->showText("TextNotes/"); ?>
  </body>
</html>
