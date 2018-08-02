<?php

class IndexController{

    private $conn;
    private $db;

    public function __construct(Connection $conn=null, Crud $db=null){
        $this->conn     = $conn;
        $this->db       = $db;
    }


    # Your control methods here...

}

?>