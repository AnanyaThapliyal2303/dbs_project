<style>
#img-size{
  height:40vh;
  width: 15vw;
  margin-bottom:3vh;
  }
</style>

<?php

  $text = trim($_POST['text']);
  require_once "./functions/database_functions.php";
  $conn = db_connect();
  $query = "SELECT * FROM author natural join books natural join publisher where ISBN like'%$text%' or author.name like '%$text%' or title like '%$text%' or pname like  '%$text%' ";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result)==0){
    echo '
    <div class="alert alert-warning" role="alert">
    Nothing Found... 
    </div>' . ' <div class="search_top" >
       
 </div>';
  }else{
    $number=mysqli_num_rows($result);
   echo  '<div class="alert alert-success" role="success"> ';
   echo $number;
   echo ' Book/s Found</div>' . ' <div class="search_top" >       
</div>';

  }

  require_once "./header.php";
?>
     
  <p class="lead text-center text-muted">Search Result</p>
    <?php 
    for($i = 0; $i < mysqli_num_rows($result); $i++){ 
    ?>
      <div class="row">
        <?php 
        while($query_row = mysqli_fetch_assoc($result)){ ?>
          <div class="col-md-3">
            <a href="book.php?bookisbn=<?php echo $query_row['ISBN']; ?>">
              <img class="img-responsive img-thumbnail" id="img-size" src="<?php echo $query_row['book_img']; ?>">
            </a>
          </div>
          <?php
        } ?> 
      </div>
<?php
    }
  if(isset($conn)) { mysqli_close($conn); }
  require_once "./footer.php";
?>