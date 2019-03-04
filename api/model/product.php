<?php
class Product{
    // include_once 'user.php';

    // database connection and table name
    private $conn;
    private $table_name = "products";
 
    // object properties
    public $id;
    public $name;
    public $image;
    public $description;
    public $price;
    public $category_name;
    public $created_at;
    public $status;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function read($db, $access_token){
        include_once 'user.php';

        $user = new User($db);

        $is_valid_token = $user->valid_token($access_token);

        if($is_valid_token) {
            // select all query
            $query = "SELECT
                        c.name as category_name, p.id, p.name, p.image, p.description, p.price, p.category_id, p.created_at, up.status
                    FROM
                        " . $this->table_name . " p
                        LEFT JOIN
                            categories c
                                ON p.category_id = c.id
                        LEFT JOIN
                            user_products up
                                ON up.user_id = " . $user->id . " and up.product_id = p.id
                    ORDER BY
                        p.price ASC";

            $result = $this->conn->query($query);
         
            if (!$result) {
                printf("Message d'erreur : %s\n", $this->conn->error);
                exit();
            }

            return $result;
        }
    }
}