<?php

//Objects
    class Tamagotchi
    {
        private $name;
        private $food;
        private $attention;
        private $rest;

//Constructor
        function __construct($name, $startFood=30, $startAttention=15, $startRest=50)
        {
            $this->name = $name;
            $this->food = $startFood;
            $this->attention = $startAttention ;
            $this->rest = $startRest;
        }
//Getters and stream_context_get_params
        function setName ($new_name)
        {
            $this->name = $new_name;
        }

        function getName ()
        {
            return $this->name;
        }

        function setFood ($new_food)
        {
            $this->food = $new_food;
        }

        function getFood ()
        {
            return $this->food;
        }

        function setAttention ($new_attention)
        {
            $this->attention = $new_attention;
        }

        function getAttention ()
        {
            return $this->attention;
        }

        function setRest ($new_rest)
        {
            $this->rest = $new_rest;
        }

        function getRest ()
        {
            return $this->rest;
        }

//Methods
        function save()
        {
            array_push($_SESSION['needs'], $this);
        }

        function feed()
        {
            $this->food +=5;
        }

        function play()
        {
            $this->attention +=5;
        }

        function rest()
        {
            $this->rest +=5;
        }

        function time()
        {
            $this->food -=3;
            $this->attention -=3;
            $this->rest -=3;
        }

//Static Methods
        static function getAll()
        {
            return $_SESSION['needs'];
        }
        static function deleteAll()
        {
            $_SESSION['needs'] = array();
        }
    }
?>
