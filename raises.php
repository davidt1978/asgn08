<!DOCTYPE html>
<!--	
Author:   David Truesdale
Date:     10/27/2020
File:     raises.php
Purpose:  MySQL Exercise
-->
<?php
  include("php/db-connect.php");
  include("php/my-functions.php");
?>

<html>
  <head>
    <?= head_info() ?>
    <title>MySQL Query</title>
  </head>
  
  <body>
    <header>
      <h1>Employees Needing Raises</h1>
    </header>
    
    <main>
      <?php

      $connect=mysqli_connect(SERVER, USER, PW, DB);

      if(!$connect)
      {
        die("ERROR: Cannot connect to database $db on server $server using user name $user (".mysqli_connect_errno().", ".mysqli_connect_error().")");
      }

      $userQuery = "SELECT empID 
                    FROM personnel 
                    WHERE hourlyWage < 10;";

      $result = mysqli_query($connect, $userQuery);

      if (!$result)
      {
        die("Could not successfully run query ($userQuery) from $db: " .mysqli_error($connect) );
      }

      if (mysqli_num_rows($result) == 0)
      {
        print("No records found with query $userQuery");
      }
      else
      {
        print("<h2>LIST OF EMPLOYEES WHO NEED A RAISE</h2>");
        while ($row = mysqli_fetch_assoc($result))
        {
          print("<p>".$row['empID']."</p>");
        }
      }

      mysqli_close($connect);   // close the connection
      ?>
    </main>
    
    <footer>
      <?= back_to_index(); ?>
    </footer>
  </body>
</html>
