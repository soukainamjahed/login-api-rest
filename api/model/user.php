<?php
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "users";
 
    // object properties
    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $active;
    public $access_token;
    public $last_sign_in;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // check if given email exist in the database
    function email_exists(){
     
        // query to check if email exists
        $query = "SELECT id, first_name, last_name, password
                FROM " . $this->table_name . "
                WHERE email = '" . $this->email . "'";

        $result = $this->conn->query($query);
     
        if (!$result) {
            printf("Message d'erreur : %s\n", $this->conn->error);
            exit();
        }

        if( $result->num_rows > 0 ) {
          $row = $result->fetch_array();
          extract($row);

          // assign values to object properties
          $this->id = $id;
          $this->first_name = $first_name;
          $this->last_name = $last_name;
          $this->password = $password;
          $this->active = $active;
          $this->access_token = $access_token;
          $this->last_sign_in = $last_sign_in;

          // return true because email exists in the database
          return true; 
        }

        // return false if email does not exist in the database
        return false;
    }

    // update a user record
    public function update_access_token($new_access_token){

        $query = "UPDATE " . $this->table_name . "
                SET
                    access_token = '" . $new_access_token . "'
                WHERE id = " . $this->id;

        $result = $this->conn->query($query);
     
        if (!$result) {
            printf("Message d'erreur : %s\n", $this->conn->error);
            exit();
        }

        return $result;
    }

    // check if given email exist in the database
    public function valid_token($access_token){
      // query to check if access_token exists
      $query = "SELECT id, first_name, last_name, password
              FROM " . $this->table_name . "
              WHERE access_token = '" . $access_token . "'";

      $result = $this->conn->query($query);

      if (!$result) {
          printf("Message d'erreur : %s\n", $this->conn->error);
          exit();
      }

      if( $result->num_rows > 0 ) {
        $row = $result->fetch_array();
        extract($row);

        // assign values to object properties
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->password = $password;
        $this->active = $active;
        $this->access_token = $access_token;
        $this->last_sign_in = $last_sign_in;

        // return true because token in the database
        return true; 
      }

      // return false if token does not exist in the database
      return false;
    }

    public function like_dislike_product($access_token, $product_id, $status) {
      $is_valid_token = valid_token($access_token);
      
      if($is_valid_token) {
          // select the status of like/dislike on a product
          $query = "SELECT
                      *
                    FROM
                      user_products up
                    WHERE
                      user_id = " . $this->id . " and product_id = " . $product_id;

          $result = $this->conn->query($query);
       
          if (!$result) {
              printf("Message d'erreur : %s\n", $this->conn->error);
              exit();
          }

          // TODO : update this row : like or Dislike. 

          return $result;
      }
    }

}