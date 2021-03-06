<?php
// http headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
date_default_timezone_set('Asia/Aqtobe');

include_once '../layouts/category_inc.php';

// set product id
$category->id = $data['id'];

// set product data
$category->title = $data['title'];
$category->keywords = $data['keywords'];
$category->description = $data['description'];
$category->created_at = $data['created_at'];
$category->updated_at = date('m/d/Y H:i:s');

if ($category->update()) {
	// Status code - 200 OK
	http_response_code(200);

	// Send to user
	echo json_encode(['message' => 'Category is updated'], JSON_THROW_ON_ERROR, 512);
} else {
	// if can't update product
	// Status code - 503 Service is not available
	http_response_code(503);

	// Send to user
	echo json_encode(['message' => 'Can not update category'], JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE, 512);
}
