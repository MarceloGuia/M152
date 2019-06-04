<?php
// This part was taken from Marcelo's previous project. It was adapted to fit the requirements
// of the new exam and we did NOT just copy and paste this code,
// we copied it, completely analysed it made some changes and we fully understand the code. we
// left the old comments in there, so when we say "I" that's Marcelo exlaining it.
// Source: https://www.myprogrammingtutorials.com/create-pagination-with-php-and-mysql.html


include "connection.php";
        // First we check if the Page Number is known to us, which in the beginning it will obviously not be, so in case we don't know it, we'll just give it
        // the value 1.
        if (isset($_GET['ID']))
        {
            $PageNr = $_GET['ID'];
        }
        else
        {
            $PageNr = 1;
        }


        // Here we finally put the use of offset into practice. The mysqli query is used to fetch the results.
        $sql = "SELECT buecher.*, kategorien.kategorie
        as genre
        FROM buecher, kategorien
        WHERE buecher.id = $PageNr
        AND buecher.kategorie = kategorien.id";

        $result = mysqli_query($conn,$sql);
        $idNum = 0;
        if ($row = mysqli_fetch_array($result)) {
          echo '  <div class="Details">
              <h1 id="titel">'.$row["kurztitle"].'</h1>
              <img id="BigBook" src="rsc/cover.jpg" alt="this be a book">
              <div class="details">
                <br>
                <span>'.$row["autor"].'</span><br>
                <span>'.$row["genre"].'</span><br>

                <span> ID: '.$row["id"].'</span>

              </div>
              <p id= description> '.$row["title"].'</p>

            </div>';
        }

        // Nice and tidy like they are in the Home Page, the same way.?>
