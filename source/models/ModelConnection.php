<?php
    namespace Models;

    abstract class ModelConnection{

        protected function conectaDB(){

            try{

                $con=new \PDO("mysql:host=".HOST.";dbname=".DATABASE."; charset=utf8","".USER."","".PASSWORD."");
                
                return $con;

            }catch (\PDOException $erro){

                return $erro->getMessage();

            }
        }
    }