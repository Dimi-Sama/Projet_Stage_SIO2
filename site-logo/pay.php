<?php require "lib/dbConnect.php"; $bd = new DbConnect(); $conn = $bd->connect(); ?>
<?php

require '../vendor/autoload.php';
// This is your test secret API key.
\Stripe\Stripe::setApiKey(''); //Mettre la clé d'API de Stipe 

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost/backoffice_login_php/site-logo';


$prix = $_COOKIE['CooIdStripe']; //Voir verifForm3.php

$checkout_session = \Stripe\Checkout\Session::create([
  'line_items' => [[
    # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
    'price' => $prix,
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/validate.php',
  'cancel_url' => $YOUR_DOMAIN . '/cancel.php',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
?>