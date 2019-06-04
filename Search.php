<?php

class Search {

  // A search function to search according to the sql statement given
  public function SearchDB($sql, $connection)
  {
    // Part of this code ist taken from the old 151 project on Marcel's side
    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) > 0)
    {
      $idNum = 0;
        while($row = mysqli_fetch_assoc($result))
        {
            { ?>
              <div class="bookCont" id="b<?php echo $idNum; ?>">
                <h1><?php echo $row["kurztitle"]?></h1><br>
                <span>Author: <?php if (isset($row["autor"]) && strlen(trim($row["autor"]))) {echo $row["autor"];}else{echo "Unknown";} ?></span>
                <br>
                 <span><a href="Details.php?ID=<?php echo $row["id"] ?>"> Details</a> </span>
                <!--<span><?php echo $row["Title"]?></span>
                <span><?php echo $row["Title"]?></span>
                <span><?php echo $row["Title"]?></span>-->
              </div>
              <?php $idNum++;
            }
        }
    }
    else
    {
        echo "Sorry, we found no books that match your criteria.";
    }
  }

  public function GetSelectSQL($where, $search, $order)
  {
    if ($search == "")
    {
      $sql = "SELECT * FROM buecher ORDER BY $order;";
      return $sql;
    }
    else
    {
      $sql = "SELECT * FROM buecher WHERE ".$where." LIKE '%".$search."%' ORDER BY $order;";
      return $sql;
    }
  }

  public function GetSelectOffsetSQL($where, $search, $order, $Offset, $ArticlesPerPage)
  {
    if ($search == "")
    {
      $sql = "SELECT * FROM buecher ORDER BY $order LIMIT $Offset, $ArticlesPerPage;";
      return $sql;
    }
    else
    {
      $sql = "SELECT * FROM buecher WHERE ".$where." LIKE '%".$search."%' ORDER BY $order LIMIT $Offset, $ArticlesPerPage;";
      return $sql;
    }
  }
}


?>
