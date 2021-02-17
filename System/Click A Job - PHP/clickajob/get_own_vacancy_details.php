
<?php

/*
 * Following code will list all the products
 */

// array for JSON response
$response = array();

// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DbConnect();

// check for post data
if (isset($_GET["cid"])) {
    $vid = $_GET['cid'];

    // get a product from products table
    $result = mysql_query("SELECT * FROM vacancy WHERE cid = $cid"); //

    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {

            $result = mysql_fetch_array($result);

            $product = array();

            $product["cid"] = $result["cid"];
            $product["cname"] = $result["cname"];
            $product["cphone"] = $result["cphone"];
            $product["cemail"] = $result["cemail"];
            $product["jlocation"] = $result["jlocation"];
            $product["jobtitle"] = $result["jobtitle"];
            $product["jreq"] = $result["jreq"];
            $product["jdesc"] = $result["jdesc"];
            $product["jdate"] = $result["jdate"];
            $product["jsalary"] = $result["jsalary"];
            

            // success
            $response["success"] = 1;

            // user node
            $response["product"] = array();

            array_push($response["product"], $product);

            // echoing JSON response
            echo json_encode($response);
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No product found";

            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No product found";

        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>