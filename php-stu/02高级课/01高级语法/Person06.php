<?php
    class Person06{
        public $name;
        public $age;
        public $height;

        public function __construct($name,$age,$height){
            $this->name=$name;
            $this->age=$age;
            $this->height=$height;
        }
        public function wang(){
            echo '旺旺';
        }
    }
?>