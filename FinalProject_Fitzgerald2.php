<?php

     //FILE : FinalProject_Fitzgerald2.php
     //PROG : Luke Fitzgerald
     //PURP : Displays data from selected department

     extract($_POST);

     //connect to database
     $link  =  mysqli_connect ("localhost", "root", "pw", "cpt283db");
     if(!$link) die("Could not make database connection");
     
     //check to see if an option is selected
     if (!(isset($department)))
     {
         printf("Please hit the back button and choose a category.\n");
         exit;
     }
     //set up query
     $query = "SELECT ID, entertainerauthor, title, media, feature FROM products WHERE department='$department' ORDER BY entertainerauthor";

     //execute
     $resultSet = mysqli_query($link, $query);
?>
<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="FinalProject_Fitzgerald.css">
<title>Bobazon</title>
</head>
<body>
      <div id="header">
      <div id="headerText">BOBAZON</div>
      </div>
      <form action = "FinalProject_Fitzgerald3.php" method = "POST">

     <strong><pre><?php
     printf("Here are the products we have in the " . $department . " department!\n\n");?><u><?php
     printf("%-17s%-35s%-25s%-15s%-20s\n", " ID Number", "Entertainer", "Title", "Media", "Feature");
     ?></u></strong><?php
     while($row = mysqli_fetch_assoc($resultSet))
     {
         $ID = $row['ID'];
         $act = $row['entertainerauthor'];
         $title = $row['title'];
         $media = $row['media'];
         $feature = $row['feature'];
?>
<input type="checkbox" name="options[]"
               value="<?PHP print $ID; ?>"/><?PHP printf("%-15d%-35s%-25s%-15s%-20s\n", $ID, $act, $title, $media, $feature);

     } //end while
?>
<p /><input type="submit" value="Purchase"><input type="reset" value="Clear">
     </form>
     <br>
     <div id="footer2"></div>
</body>
</html>

<?php
     //close the db
     mysqli_close ($link);
?>
</pre>
