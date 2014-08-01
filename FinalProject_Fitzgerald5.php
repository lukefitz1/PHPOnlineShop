<pre>
<?php

     extract($_POST);
     
     //FILE : FinalProject_Fitzgerald5.php
     //PROG : Luke Fitzgerald
     //PURP : Displays receipt
     
     if(empty($firstName))
     {
         printf("Please hit the back button and enter a first name.\n");
         exit;
     }
     if(empty($lastName))
     {
         printf("Please hit the back button and enter a last name.\n");
         exit;
     }
     if(empty($address))
     {
         printf("Please hit the back button and enter your address.\n");
         exit;
     }
     if (empty($cardNumber))
     {
         printf("Please hit the back button and enter your card number\n");
         exit;
     }
     else if (strlen($cardNumber) != 16)
     {
             printf("Card number must be 16 digits. Hit the back button and try again\n");
             exit;
     }
     $lastFour = substr($cardNumber, 12);
     
     switch ($cardType)
     {
         case "discover":
              $cardType = "Discover";
              break;
         case "visa":
              $cardType = "Visa";
              break;
         case "mastercard":
              $cardType = "Mastercard";
              break;
         case "americanExpress":
              $cardType = "American Express";
              break;
     }
         
              print<<<HTML
<!doctype html><html><head><link rel="stylesheet" type="text/css" href="FinalProject_Fitzgerald.css"><title>Bobazon</title></head><body><div id="header"><div id="headerText">BOBAZON</div></div>
HTML;
              print<<<receipt
Thank You for your purchase! Feel free to print out this page for your records.

Name: $firstName $lastName
Address: $address
Card: $cardType
Card Number: **** **** **** $lastFour

Your shipment is on the way!
receipt;
?>
<form>
	<a href="FinalProject_Fitzgerald1.php" method="POST">Back to Home Page</a>
</form>
</body>
</html>

</pre>
