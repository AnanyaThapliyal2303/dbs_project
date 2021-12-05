<style>

</style>

<?php
	session_start();
	require_once "./functions/database_functions.php";
	$conn = db_connect();

	$query = "SELECT * FROM category ORDER BY cname";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}
	if(mysqli_num_rows($result) == 0){
		echo "Empty category ! Something wrong! check again";
		exit;
	}

	$title = "List Of Categories";
	require "./header.php";
?>
	<p class="lead">List of Category</p>
	<ul>
	<?php 
		while($row = mysqli_fetch_assoc($result)){
			$count = 0; 
			$query = "SELECT c_id FROM books";
			$result2 = mysqli_query($conn, $query);
			if(!$result2){
				echo "Can't retrieve data " . mysqli_error($conn);
				exit;
			}
			while ($pubInBook = mysqli_fetch_assoc($result2)){
				if($pubInBook['c_id'] == $row['c_id']){
					$count++;
				}
			}
	?>
		<li>
			<span id="number-badge" class="badge"><?php echo $count; ?></span>
		    <a id="category-name" href="bookPerCat.php?c_id=<?php echo $row['c_id']; ?>"><?php echo $row['cname']; ?></a>
		</li>
	<?php } ?>
		<li>
			<a href="books.php">List full of books</a>
		</li>
	</ul>
<?php
	mysqli_close($conn);
?>