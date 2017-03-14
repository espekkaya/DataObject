# DataObject
Manage your database table via model in php

Features
--------
Easy to use
Working on object not array
Convert object to Array
If not valid Property in object, throw exception

Usage
--------
Create your own model extends DataObject class

Example
--------

```
User.php
```

```php
namespace PikselSense\DataModel
{
    class User extends DataObject
    {
        private $Id;
        private $FirstName;
        private $LastName;

        public function getId()
        {
            return $this->Id;
        }

        public function setId($value)
        {
            $this->Id = $value;
        }

        public function getFirstName()
        {
            return $this->FirstName;
        }

        public function setFirstName($value)
        {
            $this->FirstName = $value;
        }
        
        public function getLastName()
        {
            return $this->LastName;
        }

        public function setLastName($value)
        {
            $this->LastName = $value;
        }
        
        public function getName()
        {
            if(empty($this->Name))
                return $this->getFirstName() ." ". $this->getLastName();
            else
                return $this->Name;
        }
    }
}
```

```
index.php
```

```php
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
```
