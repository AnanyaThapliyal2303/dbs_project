<?php
	if (!function_exists("db_connect")){

		function db_connect(){
			$conn = mysqli_connect("localhost", "root", "root", "ethereal");
			if(!$conn){
				echo "Can't connect database " . mysqli_connect_error($conn);
				exit;
			}
			return $conn;
		}
	}
	if (!function_exists("select4LatestBook")){
	function select4LatestBook($conn){
		$row = array();
		$query = "SELECT ISBN, book_img FROM books ORDER BY ISBN DESC";
		$result = mysqli_query($conn, $query);
		if(!$result){
		    echo "Can't retrieve data " . mysqli_error($conn);
		    exit;
		}
		for($i = 0; $i < 4; $i++){
			array_push($row, mysqli_fetch_assoc($result));
		}
		return $row;
	}
}
if (!function_exists("getBookByIsbn")){
	function getBookByIsbn($conn, $isbn){
		$query = "SELECT title, name, price FROM books NATURAL JOIN author WHERE ISBN = '$isbn'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}
}
if (!function_exists("getCartId")){
	function getCartId($conn, $customerid){
		$query = "SELECT id FROM cart WHERE customerid = '$customerid'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "retrieve data failed!" . mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row['id'];
	}
}

if (!function_exists("insertIntoCart")){
	function insertIntoCart($conn, $customerid,$date){
		$query = "INSERT INTO cart(customerid,date) VALUES('$customerid','$date') ";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Insert Cart failed " . mysqli_error($conn);
			exit;
		}
	}
}
if (!function_exists("getbookprice")){
	function getbookprice($isbn){
		$conn = db_connect();
		$query = "SELECT price FROM books WHERE ISBN = '$ISBN-'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "get book price failed! " . mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row['book_price'];
	}
}
if (!function_exists("getCustomerId")){
	function getCustomerId($name, $address, $city, $zip_code, $country){
		$conn = db_connect();
		$query = "SELECT customerid from customers WHERE 
		name = '$name' AND 
		address= '$address' AND 
		city = '$city' AND 
		zip_code = '$zip_code' AND 
		country = '$country'";
		$result = mysqli_query($conn, $query);
		// if there is customer in db, take it out
		if($result){
			$row = mysqli_fetch_assoc($result);
			return $row['customerid'];
		} else {
			return null;
		}
	}
}
if (!function_exists("getCustomerIdbyEmail")){
	function getCustomerIdbyEmail($email){
		$conn = db_connect();
		$query = "SELECT * from customers WHERE 
		email = '$email'";
		$result = mysqli_query($conn, $query);
		// if there is customer in db, take it out
		if($result){
			$row = mysqli_fetch_assoc($result);
			return $row;
		} else {
			return null;
		}
	}
}

if (!function_exists("getPubName")){
	function getPubName($conn, $p_id){
		$query = "SELECT pname FROM publisher WHERE p_id = '$p_id'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		if(mysqli_num_rows($result) == 0){
			echo "Not Set";
		}

		$row = mysqli_fetch_assoc($result);
		return $row['pname'];
	}
}
if (!function_exists("getCatName")){
	function getCatName($conn, $c_id){
		$query = "SELECT cname FROM category WHERE c_id = '$c_id'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		if(mysqli_num_rows($result) == 0){
			echo "Not Set";
		}

		$row = mysqli_fetch_assoc($result);
		return $row['cname'];
	}
}
if (!function_exists("getAll")){
	function getAll($conn){
		$query = "SELECT * from books ORDER BY ISBN DESC";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}
}
if (!function_exists("getAllPublishers")){
	function getAllPublishers($conn){
		$query = "SELECT * from publisher ORDER BY pname ASC";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}
}
if (!function_exists("getAllCategories")){
	function getAllCategories($conn){
		$query = "SELECT * from category ORDER BY cname ASC";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}
}
?>