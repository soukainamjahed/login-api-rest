<?php
class Database{
  // specify your own database credentials
  private $host = "localhost";
  private $db_name = "test_ei_db";
  private $username = "root";
  private $password = "root";
  private $port = 8889;
  public $conn;

  // get the database connection
  public function getConnection(){
    $mysqli = new mysqli($this->host, $this->username, $this->password, $this->db_name);

    /* Vérification de la connexion */
    if ($mysqli->connect_errno) {
        printf("Echec de la connexion: %s\n", $mysqli->connect_error);
        exit();
    }

    $this->conn = $mysqli;

    return $this->conn;
  }
}
?>