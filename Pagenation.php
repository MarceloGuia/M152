<?php
error_reporting(0);
// This part was taken from Marcelo's previous project. It was adapted to fit the requirements
// of the new exam and we did NOT just copy and paste this code,
// we copied it, completely analysed it made some changes and we fully understand the code. we
// left the old comments in there, so when we say "I" that's Marcelo exlaining it.
// Source: https://www.myprogrammingtutorials.com/create-pagination-with-php-and-mysql.html
// Update: Code is getting a full rework to be object oriented

// Necessary startup code to prevent empty index error
if (isset($_GET["PageNr"]))
{
  $PageNr = $_GET["PageNr"];
}
else
{
  $PageNr = 1;
}

class Pagination {

  public function GetOffset($PageNr, $ArticlesPerPage)
  {
    $Offset = ($PageNr-1) * $ArticlesPerPage;
    return $Offset;
  }

  public function DoLazyMaths($PageNr, $conn, $ArticlesPerPage, $where, $search)
  {
    if ($search == "")
    {
      $sql = "SELECT COUNT(*) FROM buecher";
    }
    else
    {
      $sql = "SELECT COUNT(*) FROM buecher WHERE $where LIKE '%$search%'";
    }

    $result = mysqli_query($conn, $sql);
    $TotalRows = mysqli_fetch_array($result)[0];
    $TotalPages = ceil($TotalRows / $ArticlesPerPage);
    return $TotalPages;
  }

  public function GetRelics($Offset, $ArticlesPerPage, $conn, $where, $search, $order)
  {
    include "Search.php";
    $Hunter = new Search();
    $sql = $Hunter->GetSelectOffsetSQL($where, $search, $order, $Offset, $ArticlesPerPage);
    echo $sql;
    $Hunter->SearchDB($sql, $conn);
  }

  public function EnlightPages($PageNr, $TotalPages)
  {
    ?>
    <div id="PageNavDiv">
        <Nav>
            <ul class="pagination">
                <li <?php if($PageNr <= 1){ echo 'class="Disabled"'; } ?>>
                    <a class='NotActive' href="?PageNr=1">First</a>
                </li>
                <li <?php if($PageNr <= 1){ echo 'class="Disabled"'; } ?>>
                    <a class='NotActive' href="<?php if($PageNr <= 1){ echo '#'; } else { echo "?PageNr=".($PageNr - 1); } ?>">Prev</a>
                </li>

                <?php for($Page = 1; $Page <= $TotalPages; $Page++)
                {
                    if ($Page == $PageNr - 2 || $Page == $PageNr - 1 || $Page == $PageNr || $Page == $PageNr + 1 || $Page == $PageNr + 2)
                        {?>
                            <li>
                            <?php echo "<a "; if ($Page == $PageNr){ echo 'id="Active"';} else { echo "class='NotActive'";} echo " href='?PageNr=".$Page."'>".$Page."</a>";
                            ?> </li> <?php
                        }
                }?>

                <li <?php if($PageNr >= $TotalPages){ echo 'class="Disabled"'; } ?>>
                    <a class='NotActive' href="<?php if($PageNr >= $TotalPages){ echo '#'; } else { echo "?PageNr=".($PageNr + 1); } ?>">Next</a>
                </li>
                <li <?php if($PageNr >= $TotalPages){ echo 'class="Disabled"'; } ?>>
                    <a class='NotActive' href="?PageNr=<?php echo $TotalPages; ?>">Last</a>
                </li>
            </ul>
        </nav>
      </div>
      <?php
  }
}

        // Here we use the lists and links to create the pagination code. The links function similarly to the chapter links, but instead we're using our
        // own variable, which defines which page we're on. I also added in a little extra from myself to display the actual pages around the one the user
        // is currently on. These are also clickable and function the same way.
        /*?>
        <div id="PageNavDiv">
            <Nav>
                <ul class="pagination">
                    <li <?php if($PageNr <= 1){ echo 'class="Disabled"'; } ?>>
                        <a class='NotActive' href="?PageNr=1">First</a>
                    </li>
                    <li <?php if($PageNr <= 1){ echo 'class="Disabled"'; } ?>>
                        <a class='NotActive' href="<?php if($PageNr <= 1){ echo '#'; } else { echo "?PageNr=".($PageNr - 1); } ?>">Prev</a>
                    </li>

                    <?php for($Page = 1; $Page <= $TotalPages; $Page++)
                    {
                        if ($Page == $PageNr - 2 || $Page == $PageNr - 1 || $Page == $PageNr || $Page == $PageNr + 1 || $Page == $PageNr + 2)
                            {?>
                                <li>
                                <?php echo "<a "; if ($Page == $PageNr){ echo 'id="Active"';} else { echo "class='NotActive'";} echo " href='?PageNr=".$Page."'>".$Page."</a>";
                                ?> </li> <?php
                            }
                    }?>

                    <li <?php if($PageNr >= $TotalPages){ echo 'class="Disabled"'; } ?>>
                        <a class='NotActive' href="<?php if($PageNr >= $TotalPages){ echo '#'; } else { echo "?PageNr=".($PageNr + 1); } ?>">Next</a>
                    </li>
                    <li <?php if($PageNr >= $TotalPages){ echo 'class="Disabled"'; } ?>>
                        <a class='NotActive' href="?PageNr=<?php echo $TotalPages; ?>">Last</a>
                    </li>
                </ul>
            </nav>
          </div>*/
