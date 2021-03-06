<?php
// http headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

include_once '../layouts/product_inc.php';

// get keywords from request
$id = $data['cat_id'] ?? '';

// request products
$stmt = $product->readByCat($id);
$first = oci_fetch_assoc($stmt);
$num = oci_num_rows($stmt);

if ($num > 0) {

	// Products array
	$products_arr = array();
	$products_arr['records'] = [$first];

	// Get content from our table
	while ($row = oci_fetch_assoc($stmt)) {
		$product_item = array();
		foreach ($row as $k => $v) {
			$product_item[$k] = $v;
		}

		$products_arr['records'][] = $product_item;
	}

	// Status code - 200 Ok
	http_response_code(200);

	// sent to user
	echo json_encode($products_arr, JSON_THROW_ON_ERROR, 512);
} else {
	// Status code - 404 Not Found
	http_response_code(404);

	// Send to user
	echo json_encode(['message' => 'Products is not found'], JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE, 512);
}
