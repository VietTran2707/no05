<?php
class Database {
    private $dns = "mysql:host=localhost:8889;dbname=no05";
    private $user = "root";
    private $pass = "root";
    function get_dns() {
        return $this->dns;
      }
    function get_user() {
        return $this->user;
    }
    function get_pass() {
        return $this->pass;
    }
    
}
?>