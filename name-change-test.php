<!DOCTYPE html>
<!--
Author:   David Truesdale
Date:     10/27/2020
File:     name-change-test.php
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
      <h1>Name Change Test</h1>
    </header>
    
    <main>
      <?php
  
      print ("<a href='name-change.php'>Change Name</a><br>");
      print ("<a href='name-change-undo.php'>Change Name Back</a>");

      $connect=mysqli_connect(SERVER, USER, PW, DB);

      if(!$connect) 
      {
        die("ERROR: Cannot connect to database $db on server $server using user name $user (".mysqli_connect_errno().", ".mysqli_connect_error().")");
      }

      $userQuery = "SELECT lastName, jobTitle FROM personnel WHERE empID = '12353' ";
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
        print("<h2>LIST OF EMPLOYEES</h2>");
        print("<table border = \"1\">");
        print("<tr><th>Last Name</th><th>Job Title</th></tr>");

        while ($row = mysqli_fetch_assoc($result))
        {
          print ("<tr><td>".$row['lastName']."</td><td>".$row['jobTitle']."</td></tr>");
        }
        print ("</table");
      }

      mysqli_close($connect);   // close the connection
      
      
      ?>
    </main>
    
    <footer>
      <?= back_to_index(); ?>
    </footer>
  </body>
</html>
