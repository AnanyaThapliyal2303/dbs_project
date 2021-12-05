<style>
#img-size{
  height:40vh;
  width: 15vw;
  }


</style>

<?php
  session_start();
  $count = 0;
  // connecto database
  
  $title = "Index";
  require_once "./header.php";
  require_once "./functions/database_functions.php";
  $conn = db_connect();
  $row = select4LatestBook($conn);
?><br>
      <h3 class="lead text-center text-muted">OUR LATEST BOOKS</h3>
      
      <div class="row">
        <?php foreach($row as $book) { ?>
      	<div class="col-md-3">
      		<a href="book.php?bookisbn=<?php echo $book['ISBN']; ?>">
           <img id="img-size" class="img-responsive img-thumbnail" src="<?php echo $book['book_img']; ?>">
          </a>
      	</div>
        <?php } ?>
      </div>

