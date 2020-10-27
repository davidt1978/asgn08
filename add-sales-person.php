<!DOCTYPE html>
<!--
Author:   David Truesdale
Date:     10/27/2020
File:     add-sale-person.php
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
      <h1>Add Sales Person</h1>
    </header>
    
    <main>
      <?php
  
      print("<a href='employees.php'>Check Employee Records</a>");

      $connect=mysqli_connect(SERVER, USER, PW, DB);

      if(!$connect)
      {
        die("ERROR: Cannot connect to database $db on server $server using user name $user (".mysqli_connect_errno().", ".mysqli_connect_error().")");
      }
      $empID = $_POST['empID'];
      $firstName = $_POST['firstName'];
      $lastName = $_POST['lastName'];

      $userQuery = "INSERT INTO personnel (empID, firstName, lastName, jobTitle, hourlyWage)
                    VALUES ($empID, '$firstName', '$lastName', 'Sales', 8.25)";

      $result = mysqli_query($connect, $userQuery);
    
      if (!$result) 
      {
        die("Could not successfully run query ($userQuery) from $db: " .mysqli_error($connect) );
      }
      else
      {
        print("	<h2>ADD A NEW PERSONNEL RECORD</h2>");
        print ("<p>The following record was added to the personnel table:</p>");
        print("<table border='0'>
              <tr><td>EMPLOYEE ID</td><td>$empID</td></tr>
              <tr><td>FIRST NAME</td><td>$firstName</td></tr>
              <tr><td>LAST NAME</td><td>$lastName</td></tr>		
              <tr><td>JOB TITLE</td><td>sales</td></tr>
              <tr><td>HOURLY WAGE</td><td>8.25</td></tr>
              </table>");
      }

      mysqli_close($connect); // close the connection

      ?>
    </main>
    
    <footer>
      <?= back_to_index(); ?>
    </footer>
  </body>
</html>
