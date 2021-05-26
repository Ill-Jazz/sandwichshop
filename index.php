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
$email = $street = $streetNum = $city = $zipcode = "";
$emailErr = $streetErr = $streetNumErr = $cityErr = $zipcodeErr = "";

//creating test_input function for data validation (protection against hackers)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["street"])){
        $streetErr = "Street is required";
    }else {
        $street =test_input($_POST["street"]);
        $streetErr = "";
    }
    if (empty($_POST["streetnumber"]) || (!is_numeric($_POST["streetnumber"]))){ //checking for empty field and numeric value
        $streetNumErr = "Valid street number is required";
    } else {
        $streetNum = test_input($_POST["streetnumber"]);
        $streetNumErr = "";
    }
    if (empty($_POST["email"])){
        $emailErr = "Email is required";
    }else {
        $email = test_input($_POST["email"]);
        $emailErr = "";
    }
    if (empty($_POST["city"])){
        $cityErr = "City is required";
    }else {
        $city = test_input($_POST["city"]);
        $cityErr = "";
    }
    if (empty($_POST["zipcode"]) || (!is_numeric($_POST["zipcode"]))){ //checking for empty field and numeric value
        $zipcodeErr = "Valid zipcode is required";
    }else {
        $zipcode = test_input($_POST["zipcode"]);
        $zipcodeErr = "";
    }

}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
// check if e-mail is valid and not empty
    if (isset($_POST["email"])) {
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

//succes alert order sent if all fields are filled in and the streetnumber and zipcode are numeric
if (!empty($_POST["email"]) && !empty($_POST["street"]) && !empty($_POST["streetnumber"]) && !empty($_POST["city"]) && !empty($_POST["zipcode"])) {
 if (is_numeric($_POST["zipcode"]) && is_numeric($_POST["streetnumber"])){
    echo "Order sent!";
}
 }

// create session

if(!empty($_POST)) {
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["street"] = $_POST["street"];
    $_SESSION["streetnumber"] = $_POST["streetnumber"];
    $_SESSION["city"] = $_POST["city"];
    $_SESSION["zipcode"] = $_POST["zipcode"];
}

if(!empty($_SESSION["email"])){
    $email = $_SESSION["email"];
}
if(!empty($_SESSION["street"])){
    $street = $_SESSION["street"];
}
if(!empty($_SESSION["streetnumber"])){
    $streetNum = $_SESSION["streetnumber"];
}
if(!empty($_SESSION["city"])){
    $city = $_SESSION["city"];
}
if(!empty($_SESSION["zipcode"])){
    $zipcode = $_SESSION["zipcode"];
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
whatIsHappening();