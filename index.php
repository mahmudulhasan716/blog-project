<?php
require_once'vendor/autoload.php';
$cat = New \App\classes\Category();
$catagory= $cat->allActiveCatagory();
$post= $cat->allActivePost();
 ?>


<?php require_once'header.php' ?>
        <!-- Page header with logo and tagline-->
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Welcome to Blog Home!</h1>
                    <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p>
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->

                <?php

                if(isset($_GET['search'])){

                    $search= $_GET['search'];
                    $search = $cat->searchpost($search);

                    if(mysqli_num_rows($search) > 0){
                        while($row3= mysqli_fetch_assoc($search)){
                            ?>
    
                    <?php
                    while($row1= mysqli_fetch_assoc($post)){
                        ?>
                     
                    <div class="col-lg-8">
                        <!-- Featured blog post-->
                        <div class="card mb-4">
                            <a href="#!"><img class="card-img-top" src="./uploads/<?= $row3['photo'] ?>" alt="..." /></a>
                            <div class="card-body">
                                <div class="small text-muted"><?= date('d m y', strtotime($row3['createtime'])) ?> </div>
                                <h2 class="card-title"><?= $row3['title'] ?></h2>
                                <p class="card-text"><?= substr($row3['content'],0,200) ?>...</p>
                                <a class="btn btn-primary" href="post.php?id= <?= $row3['ID'] ?>">Read more →</a>
                            </div>
                        </div>
                    </div>
                    <?php  
                    }
                    ?>
    
    
                            <?php
                        }
    
                        ?>
    
    
                        <?php

                    }else{
                        echo '<h3> Not found!</h3>';
                    }

                 

                }else{
                    ?>
                   




                <?php
                while($row1= mysqli_fetch_assoc($post)){
                    ?>
                 
                <div class="col-lg-8">
                    <!-- Featured blog post-->
                    <div class="card mb-4">
                        <a href="#!"><img class="card-img-top" src="./uploads/<?= $row1['photo'] ?>" alt="..." /></a>
                        <div class="card-body">
                            <div class="small text-muted"><?= date('d m y', strtotime($row1['createtime'])) ?> </div>
                            <h2 class="card-title"><?= $row1['title'] ?></h2>
                            <p class="card-text"><?= substr($row1['content'],0,200) ?>...</p>
                            <a class="btn btn-primary" href="post.php?id= <?= $row1['ID'] ?>">Read more →</a>
                        </div>
                    </div>
                </div>
                <?php  
                }
                ?>

<?php
                 }
                
                ?>


                <?php require_once'widget.php' ?>

               
            </div>
        </div>
    

    <?php require_once'footer.php' ?>