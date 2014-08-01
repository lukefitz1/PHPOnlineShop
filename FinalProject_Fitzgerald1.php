<!DOCTYPE html>
<html>
<head>
      <link rel="stylesheet" type="text/css" href="FinalProject_Fitzgerald.css">
      <title>Bobazon</title>
</head>
<body>
      <div id="header">
      <div id="headerText">BOBAZON</div>
      </div>
      <div id="wrapper">
      <div id="largeText">Pick a department to browse our selection!</div>
      <div id="separator">
      <div id="form2"><form action = "FinalProject_Fitzgerald2.php" method = "POST"><br><br>
<?php

     //FILE : FinalProject_Fitzgerald1.php
     //PROG : Luke Fitzgerald
     //PURP : Handles loading site info once customer enters

     extract($_POST);

     //connect to database
     $link  =  mysqli_connect ("localhost", "root", "1Rodgers2", "cpt283db");
     if(!$link) die("Could not make database connection");

     //query
     $query = "SELECT DISTINCT department FROM products";
     //execute query
     $query_results = mysqli_query($link, $query);
?>
<?php
     while($department_row = mysqli_fetch_assoc($query_results))
     {
         $department = $department_row['department'];
?>

<input type="radio" name="department" value="<?php print $department; ?>"><?php print $department;

     } //end while
?>

<br><br><input type="submit"><br><input type="reset" value="Clear"><br>

      </form>
      </div>
      </div>
      </div>
      <div id="footer"></div>
</body>
</html>
<?php
     //close db
     mysqli_close($link);
?>
     




