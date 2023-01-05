<?php

class Controller {
   public $modal = null;
   public $db = null;
   public $dBase = null;

    function __construc(Database $dBase, DB $db){
$this->db = $db;
$this->dBase = $dBase;
    }


    function setModel ($modal){
        $this->modal = $modal;
    }




    
}