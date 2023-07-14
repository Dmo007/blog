<?php
 include "layouts/navbar.php";
 include "dbconnect.php";

 $id=$_GET['id'];
//   echo "$id";
$sql="SELECT posts.*,categories.name as c_name,users.name as u_name FROM posts INNER JOIN categories ON posts.category=categories.id INNER JOIN users ON posts.user_id=users.id WHERE posts.id=:id";
$stmt=$conn->prepare($sql);
$stmt->bindParam(":id",$id);
$stmt->execute();
$post=$stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($post);

?>
        <!-- Page content-->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1">Welcome to Blog Post!</h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2"><?=$post['created_at']?> By <?=$post['u_name']?> </div>
                            <!-- Post categories-->
                            <a class="badge bg-secondary text-decoration-none link-light" href="index.php?cid=<?=$post['category']?>"><?=$post['c_name']?></a>
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded" src="backend/<?=$post['photo']?>" alt="..." /></figure>
                        <!-- Post content-->
                        <section class="mb-5">
                           <?=$post['description']?>
                        </section>
                    </article>
                    <!-- Comments section-->
                   
                </div>
               
                   <?php
                     include "layouts/footer.php";                   
                   ?>