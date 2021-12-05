<?php
	session_start();
	require_once "./functions/database_functions.php";
	// get pubid
	if(isset($_GET['catid'])){
		$catid = $_GET['catid'];
	} else {
		echo "Wrong query! Check again!";
		exit;
	}

	// connect database
	$conn = db_connect();
	$catName = getCatName($conn, $catid);

	$query = "SELECT ISBN, title, book_img FROM books WHERE c_id = '$c_id'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}
	if(mysqli_num_rows($result) == 0){
		echo "Empty books ! Please wait until new books coming!";
		exit;
	}

	$title = "Books Per Category";
	require "./template/header.php";
?>
	<p class="lead"><a href="category_list.php">Categories</a> > <?php echo $catName; ?></p>
	<?php while($row = mysqli_fetch_assoc($result)){
?>
	<div class="row">
		<div class="col-md-3">
			<img class="img-responsive img-thumbnail" src="<?php echo $row['book_img'];?>">
		</div>
		<div class="col-md-7">
			<h4><?php echo $row['title'];?></h4>
			<a href="book.php?bookisbn=<?php echo $row['ISBN'];?>" class="btn btn-primary">Get Details</a>
		</div>
	</div>
	<br>
<?php
	}
	if(isset($conn)) { mysqli_close($conn);}
	require "./template/footer.php";
?>