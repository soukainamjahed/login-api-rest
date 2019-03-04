<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../model/product.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$product = new Product($db);

// query products
$result = $product->read($db, $_GET["access_token"]);

if( $result->num_rows > 0 ) {
  // products array
  $products_arr=array();
  $products_arr["records"]=array();

  while($row = $result->fetch_array()) {
    // extract row
    extract($row);
    
    $product_item=array(
        "id" => $id,
        "name" => $name,
        "image" => $image,
        "description" => html_entity_decode($description),
        "price" => $price,
        "category_name" => $category_name,
        "created_at" => $category_name,
        "status" => $status
    );

    array_push($products_arr["records"], $product_item);
  }

  // set response code - 200 OK
  http_response_code(200);

  // show products data in json format
  echo json_encode($products_arr);

} else {
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}