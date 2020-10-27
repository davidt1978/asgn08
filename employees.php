<!DOCTYPE html>
<!--
Author:   David Truesdale
Date:     10/27/2020
File:     employees.php
Purpose:  MySQL Code Exercise
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
      <h1>Employees List Check</h1>
    </header>
    
    <?php

    $connect=mysqli_connect(SERVER, USER, PW, DB);

    if(!$connect)
    {
      die("ERROR: Cannot connect to database $db on server $server using user name $user (".mysqli_connect_errno().", ".mysqli_connect_error().")");
    }
    
    $userQuery = "SELECT * FROM personnel";
    $result = mysqli_query($connect, $userQuery);

    if (!$result) 
    {
      die("Could not successfully run query ($userQuery) from $db: ".mysqli_error($connect));
    }

    if (mysqli_num_rows($result) == 0) 
    {
      print("No records found with query $userQuery");
    }
    else 
    {
      print("<h2>LIST OF EMPLOYEES</h2>");
      print("<table border = \"1\">");
      print("<tr><th>EMP ID</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Job Title</th>
              <th>Hourly Wage</th></tr>");
      while ($row = mysqli_fetch_assoc($result))
      {
        print ("<tr><td>".$row['empID']."</td>
                <td>".$row['firstName']."</td>
                <td>".$row['lastName']."</td>
                <td>".$row['jobTitle']."</td>
                <td>".number_format($row['hourlyWage'], 2)."</td></tr>");
      }
      print("</table");
    }

    mysqli_close($connect);   // close the connection

    ?>
    <p>Enter Employee ID to Delete.</p>
    <form action = "delete-employee.php" method = "post">
      <label for="empID">ID</label><input type = "text" size = "20" name = "empID" id="empID"><br>
      <input type = "submit" value = "Submit">
    </form>
    

    <footer>
      <?= back_to_index(); ?>
    </footer>
  </body>
</html>
