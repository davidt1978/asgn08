<!DOCTYPE html>
<!--
Author:   David Truesdale
Date:     10/27/2020
File:     job-titles2.php
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
      <h1>People with Job Title</h1>
    </header>
    
    <?php
    
    $connect=mysqli_connect(SERVER, USER, PW, DB);

    if(!$connect)
    {
      die("ERROR: Cannot connect to database $db on server $server using user name $user (".mysqli_connect_errno().", ".mysqli_connect_error().")");
    }

    $jobTitle = $_POST['jobTitle'];

    $userQuery = "SELECT firstName, lastName
                  FROM personnel 
                  WHERE jobTitle = '$jobTitle';";
    
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
      print("<table border = \"1\">");
      print("<tr><th>FIRST NAME</th><th>LAST NAME</th></tr>");
      while ($row = mysqli_fetch_assoc($result))
        {
          print("<tr><td>".$row['firstName']."</td><td>".$row['lastName']."</td></tr></p>");
        }
      
      print ("</table>");
    }
    
    mysqli_close($connect);   // close the connection
    ?>
    
    <footer>
      <?= back_to_index(); ?>
    </footer>
  </body>
</html>
