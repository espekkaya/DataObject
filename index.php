<?php
require_once("DataObject.php");
require_once("User.php");

$row = array('Id' => 1, 'FirstName' => 'John');

$User = new PikselSense\DataModel\User($row); // pass array or object to set properties
echo $User->getId(); // return 1
echo $User->Id; // return 1

$User->setLastName('Doe'); // set last name

echo $User->getName(); // return John Doe

print_r($User->getObject2Array()); // convert Object to Array - return  array('Id' => 1, 'FirstName' => 'John', 'LastName' => 'Doe', 'Name' => 'John Doe');

// echo $User->Address; // throw exception is not a valid property
// $User->Name = 'Doe Sample'; // throw exception Property 'Name' is read only