<pre>
<?php

     //FILE : FinalProject_Fitzgerald4.php
     //PROG : Luke Fitzgerald
     //PURP : Displays final choices and total cost, and allows user to enter payment info
     
     extract($_POST);
     $total = 0;
     if(!isset($options))
     {
         printf("Im sorry you did not find anything to your liking! ");
         printf("Please hit the back button if you want to choose something");
         exit;
     }
     else
     {
         //connect to db
         $link  =  mysqli_connect ("localhost", "root", "pw", "cpt283db");
         if(!$link) die("Could not make database connection");
         
              print<<<HTML
<!doctype html><html><head><link rel="stylesheet" type="text/css" href="FinalProject_Fitzgerald.css"><title>Bobazon</title></head><body><div id="header"><div id="headerText">BOBAZON</div></div><form action = "FinalProject_Fitzgerald5.php" method = "POST">
HTML;

         foreach($options as $value)
         {
             $query = "SELECT ID, department, entertainerauthor, title, summary FROM products WHERE ID = '$value' ORDER BY entertainerauthor";
             //execute
             $results = mysqli_query($link, $query);
             
             if ($results)
             {
                 //results variable
                 $finalResults_row = mysqli_fetch_assoc($results);
                 
                 //place ID num  and deparment into variable
                 $productID = $finalResults_row['ID'];
                 $department = $finalResults_row['department'];
                 
                 //second query for the prodinv table
                 $prodinv_query = "SELECT UnitsInStock, UnitPrice FROM prodinv WHERE ID = '$productID'";
                 //execute
                 $prodinv_result = mysqli_query($link, $prodinv_query);
                 //results
                 $inventory_row = mysqli_fetch_assoc($prodinv_result);
                 
                 printf("%-15d%-35s%-25s%-10.2f%-20d%-15s\n",
                         $finalResults_row['ID'],
                         $finalResults_row['entertainerauthor'],
                         $finalResults_row['title'],
                         $inventory_row['UnitPrice'],
                         $inventory_row['UnitsInStock'],
                         $finalResults_row['summary']);
                         
                         $total += $inventory_row['UnitPrice'];
             }
         }
         //close db
         mysqli_close($link);
     }

?>
  <p />Total Cost: <?php print $total; ?><br><br>
  <br><br><strong>Please enter your payment information:</strong>
  First Name: <input type="text" name="firstName"><br>
  Last Name:  <input type="text" name="lastName"><br>
  Address:    <input type="text" name="address"<br><br>
  Card Type:  <select name="cardType">
       <option value="discover">Discover</option>
       <option value="visa">Visa</option>
       <option value="mastercard">MasterCard</option>
       <option value="americanExpress">American Express</option>
       </select><br>
  Card Number: <input type="text" name="cardNumber"><br>
  
<p /><input type="submit" value="Buy"><input type="reset" value="Clear">
</form><br><div id="footer2"></div></body></html>
</pre>
