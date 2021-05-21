<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

//we are going to use session variables so we need to enable sessions
session_start();

function whatIsHappening()
{
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

//defining variables and setting them to empty values
$email = $street = $streetNumber = $city = $zipcode = "";

//creating test_input function for data validation (protection against hackers)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = test_input($_POST["email"]);
    $street = test_input($_POST["street"]);
    $streetNumber = test_input($_POST["streetNumber"]);
    $city = test_input($_POST["city"]);
    $zipcode = test_input($_POST["zipcode"]);
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//checking if input email is empty and if email is valid

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    if (empty($email)) {
        echo "You didn't fill in the e-mail";
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Enter valid e-mail!";
        } else {
            echo "e-mail oke!";
        }

    }
}


//your products with their price.
$products = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];

$products = [
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];

$totalValue = 0;

require 'form-view.php';