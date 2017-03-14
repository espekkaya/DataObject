<?php
namespace PikselSense\DataModel
{
    class DataObject
    {
        function __construct($model = null)
        {
            $this->setProperties($model);
        }

        /**
         * @param $property
         * @return mixed
         * @throws \Exception
         */
        public function __get($property)
        {
            $func = 'get'. $property;

            if (method_exists($this, $func))
            {
                return $this->$func();
            }
            else
            {
                throw new \Exception("not a valid property: $property");
            }
        }

        /**
         * @param $property
         * @param $value
         * @throws \Exception
         */
        public function __set($property, $value)
        {
            $func = 'set'. $property;

            if (method_exists($this, $func))
            {
                $this->$func($value);
            }
            else
            {
                if (method_exists($this, 'get'. $property))
                {
                    throw new \Exception("Property \"$property\" is read-only");
                }
                else
                {
                    throw new \Exception("not a valid property: $property");
                }
            }
        }

        /**
         * @return array
         */
        public function getObject2Array()
        {
            $dataArray = array();
            $ClassReflection = new \ReflectionClass(get_class($this));

            $props  = $ClassReflection->getProperties();

            foreach ($props as $prop)
            {
                $propName = $prop->getName();

                $secret = $ClassReflection->getProperty($prop->getName());
                $secret->setAccessible(true);

                $dataArray[$propName] = $secret->getValue($this);
            }

            return $dataArray;
        }

        /**
         * @param null $model
         */
        public function setProperties($model = null)
        {
            if(is_array($model))
            {
                foreach ($model as $key => $value)
                    $this->$key = $value;
            }
            else if(is_object($model))
            {
                if(get_class($model) == "stdClass")
                {
                    $model = get_object_vars($model);

                    foreach ($model as $key => $value)
                    {
                        $this->$key = $value;
                    }

                    return;
                }

                $ClassReflection = new \ReflectionClass(get_class($model));

                $props  = $ClassReflection->getProperties();

                foreach ($props as $prop)
                {
                    $propName = $prop->getName();

                    $secret = $ClassReflection->getProperty($prop->getName());
                    $secret->setAccessible(true);

                    $this->$propName = $secret->getValue($model);
                }
            }
        }
    }
}