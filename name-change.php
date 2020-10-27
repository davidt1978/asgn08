<!DOCTYPE html>
<!--
Author:   David Truesdale
Date:     10/27/2020
File:     name-change.php
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
      <h1>Employee Name and Title Change</h1>
    </header>
    
    <main>
      <?php

      $connect=mysqli_connect(SERVER, USER, PW, DB);

      if(!$connect) 
      {
        die("ERROR: Cannot connect to database $db on server $server using user name $user (".mysqli_connect_errno().", ".mysqli_connect_error().")");
      }

      $userQuery = "UPDATE personnel SET lastName = 'Jackson', jobTitle = 'Manager' WHERE empID = 12353;";

      $result = mysqli_query($connect, $userQuery);

      if (!$result)
      {
        die("Could not successfully run query ($userQuery) from $db: ".mysqli_error($connect) );
      }
      else
      {
        print ("<h2>UPDATE</h2>");
        print ("<p>The employee update has been completed.</p>");
        print ("<a href='name-change-test.php'>Return to Name Change Test</a>");
      }

      mysqli_close($connect);   // close the connection
      ?>
    </main>
    
    <footer>
      <?= back_to_index(); ?>
    </footer>
  </body>
</html>
