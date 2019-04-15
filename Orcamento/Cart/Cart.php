<?php
    class Cart {

        private $user = 'guest';
        private $itens = array();
        private $total = 0;

        function __construct($u){
            $this -> user = $u;
        }
        
        public function addItem($item){
            array_push($this -> itens, $item);
        }

        public function getItens(){
            return $this -> itens;
        }

        public function getUser(){
            return $this -> user;
        }

        public function total(){
            $this -> total = 0;
            foreach($this -> itens as $item){
                $this -> total += $item -> getPrice()*$item ->getQuantity();
            }
            return number_format($this -> total, 2, "," , ".");;
        }

        public function toString(){
            $string = "Usuario:".$this ->user."tabValor Total: R$".$this -> total()."tabitens comprados: ";
            foreach($this -> itens as $item){
                $string .= $item -> getName()."(".$item -> getQuantity().")(".number_format($item -> getPrice(), 2, ",", ".")."), ";
            }
            return $string;
            
        }
    }
?>