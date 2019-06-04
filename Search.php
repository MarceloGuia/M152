<?php

class Search {

  // A search function to search according to the sql statement given
  public function SearchDB($sql, $connection, $objects)
  {
    // Part of this code is taken from the old 151 project on Marcel's side
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            { // Conetnt goes here per item ?>

              Here goes what we want to display

            <?php }
        }
    }
    else
    {
        echo "Sorry, we found no $objects that match your criteria.";
    }
  }

  public function GetSelectSQL($where, $objects)
  {
    if ($where == "")
    {
      $sql = "SELECT * FROM $objects;";
      return $sql;
    }
    else
    {
      $sql = "SELECT * FROM $objects where $objects = '$where';";
    }
  }

  /* Note to self adapt books to images etc... */

  public function GetSelectOffsetSQL($where, $Offset, $ArticlesPerPage)
  {
    $sql = "SELECT * FROM buecher LIMIT $Offset, $ArticlesPerPage";
    return $sql;
  }
}


?>
