<?php
// headers
header('Access-control-Allow-origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/category.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate category object
$category = new Category($db);

// Category read query
$result = $category->read();
// Get row count
$num = $result->rowCount();

// Check if any categories
If($num > 0) {
    // Cat array
    $cat_arr = array();
    $cat_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $cat_item = array(
        'id' => $id,
        'name' => $name
    );

    // Push to "data"
    array_push($cat_arr['data'], $cat_item);
}

// Turn to JSON & output
echo json_encode($cat_arr);

} else {
    // No categories
    echo json_encode(
        array('message' => 'No categories Found')
    );
}
