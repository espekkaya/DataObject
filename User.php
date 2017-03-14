<?php
namespace PikselSense\DataModel
{

    class User extends DataObject
    {
        private $Id;
        private $FirstName;
        private $LastName;

        // Custom Fields

        private $Name;

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

        // Custom setter / getter

        public function getName()
        {
            if(empty($this->Name))
                return $this->getFirstName() ." ". $this->getLastName();
            else
                return $this->Name;
        }
    }
}