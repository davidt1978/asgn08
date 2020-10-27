<!DOCTYPE html>
<!--
Author:   David Truesdale 
Date:     10/27/2020
File:     delete-employee.php
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
      <h1>Delete Employee</h1>
    </header>
    
    <main>
      <?php
  
      $connect=mysqli_connect(SERVER, USER, PW, DB);
    
      if(!$connect)
      {
        die("ERROR: Cannot connect to database $db on server $server using user name $user (".mysqli_connect_errno().", ".mysqli_connect_error().")");
      }
    
      $empID = $_POST['empID'];
    
      $userQuery = "DELETE FROM personnel WHERE empID='$empID'";

      $result = mysqli_query($connect, $userQuery);

      if (!$result) 
      {
	     die("Could not successfully run query ($userQuery) from $db: " .mysqli_error($connect) );
      }
      else
      {
	     print("<h2>DELETE A RECORD</h2>");
	     print ("<p>The record with ID $empID was deleted.</p>");
      }
      mysqli_close($connect);   // close the connection
      ?>
      
      <p><a href="employees.php">Check Employee List</a></p>
    </main>
    
    <footer>
      <?= back_to_index(); ?>    
    </footer>
  </body>
</html>
