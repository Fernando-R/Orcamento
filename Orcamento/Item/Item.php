<?php
    class Item {
        private $id = 0;
        private $name = '';
        private $price = 0.00;
        private $quantity = 0;
        
        function __construct($i, $n, $p){
            $this -> id = $i;
            $this -> name = $n;
            $this -> price = $p;
            $this -> quantity = 0;
        }
        function getQuantity(){
            return $this -> quantity;
        }

        function setQuantity($v){
            if ($v >= 0){
                $this -> quantity = $v;
            }
        }

        function getName(){
            return $this -> name;
        }

        function getPrice(){
            return $this -> price;
        }
    }
?>