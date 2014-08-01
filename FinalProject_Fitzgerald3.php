<pre>
<?php

     //FILE : FinalProject_Fitzgerald3.php
     //PROG : Luke Fitzgerald
     //PURP : Displays selected items - has user confirm selections
     
     extract($_POST);
     $control = 0;
     if(!isset($options))
     {
         printf("Im sorry you did not find anything to your liking! Please hit the back button if you want to choose something");
         exit;
     }
     else
     {
         //connect to db
         $link  =  mysqli_connect ("localhost", "root", "1Rodgers2", "cpt283db");
         if(!$link) die("Could not make database connection");

         print<<<HTML
<!doctype html><html><head><link rel="stylesheet" type="text/css" href="FinalProject_Fitzgerald.css"><title>Bobazon</title></head><body><div id="header"><div id="headerText">BOBAZON</div></div><form action = "FinalProject_Fitzgerald4.php" method = "POST">
HTML;

         //printf("Here are the products you have chosen to learn more about!\n\n");
         //printf("%-15s%-35s%-25s%-10s%-20s%-15s\n", "ID Number", "Entertainer", "Title", "Price", "Units in Stock", "Summary");

         foreach($options as $value)
         {
             $products_query = "SELECT ID, department, entertainerauthor, title, summary FROM products WHERE ID = '$value' ORDER BY entertainerauthor";
             //execute
             $results = mysqli_query($link, $products_query);

             if($results)
             {
                 //place results into variable
                 $products_row = mysqli_fetch_assoc($results);

                 //place ID num  and deparment into variable
                 $productID = $products_row['ID'];
                 $department = $products_row['department'];

                 if($control == 0)
                 {
                     ?><strong><?php
                     printf("Here are the products you have chosen to learn more about from the " . $department . " department!\n\n");?><u><?php
                     printf("%-15s%-35s%-25s%-10s%-20s%-15s\n", "ID Number", "Entertainer", "Title", "Price", "Units in Stock", "Summary");?></u></strong><?php
                     $control = 1;
                 }

                 //second query for the prodinv table
                 $prodinv_query = "SELECT UnitsInStock, UnitPrice FROM prodinv WHERE ID = '$productID'";
                 //execute
                 $prodinv_result = mysqli_query($link, $prodinv_query);
                 //results
                 $inventory_row = mysqli_fetch_assoc($prodinv_result);
?>
<p /><input type="checkbox" name="options[]"
                 value="<?php print $products_row['ID']; ?>"><?php printf("%-13d%-35s%-25s%-10.2f%-20d%-15s\n",
                         $products_row['ID'],
                         $products_row['entertainerauthor'],
                         $products_row['title'],
                         $inventory_row['UnitPrice'],
                         $inventory_row['UnitsInStock'],
                         $products_row['summary']);
             }
         }
         //close the db
         mysqli_close ($link);
     }

?>
<br><br><strong>Please Confirm the products you wish to purchase</strong><br>
<p /><input type="submit" value="Confirm Purchase"><input type="reset" value="Clear">
</form><br><div id="footer2"></div></body></html>
</pre>
