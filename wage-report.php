<!DOCTYPE html>
<!--
Author:   David Truesdale
Date:     10/27/2020
File:     wage-report.php
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
      <h1>Wage Report</h1>
    </header>
    
    <main>
      <?php

      $connect=mysqli_connect(SERVER, USER, PW, DB);

      if(!$connect)
      {
        die("ERROR: Cannot connect to database $db on server $server using user name $user (".mysqli_connect_errno().", ".mysqli_connect_error().")");
      }

      $hourlyWage = $_POST['hourlyWage'];
      $jobTitle = $_POST['jobTitle'];

      $userQuery = "SELECT empID 
                    FROM personnel 
                    WHERE jobTitle = '$jobTitle' AND hourlyWage > '$hourlyWage';";

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
        print("<h2>RESULTS</h2>");
        print("<p>The following employees have the $jobTitle job title, and an hourly wage of $".
              number_format($hourlyWage, 2)." or higher:</p>");
        print("<table border = \"1\">");
        print("<tr><th>EMP ID</th></tr>");

        while ($row = mysqli_fetch_assoc($result))
        {
          print("<tr><td>".$row['empID']."</td></tr></p>");
        }

        print ("</table>");
      }

      mysqli_close($connect);   // close the connection
      ?>
    </main>
    
    <footer>
      <?= back_to_index(); ?>
    </footer>
  </body>
</html>
