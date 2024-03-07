<?php
session_start();
date_default_timezone_set("Asia/Makassar");

Class Connection {
    protected $conn;
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "perpustakaan";

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
    }

    public function index(){
        return $this->conn;
    }
}
