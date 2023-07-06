<?php 
 include "layouts/nav_sidebar.php";
 include "../dbconnect.php";
 $sql="SELECT posts.*,categories.name as c_name,users.name as u_name FROM posts INNER JOIN categories ON posts.category=categories.id INNER JOIN users ON posts.user_id=users.id";
 $stmt=$conn->prepare($sql);
 $stmt->execute();
 $posts=$stmt->fetchAll();
?>
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Posts</h1>
                        <div>
                            <a href="post_create.php" class="btn btn-primary float-end">Create Post</a>
                        </div>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Posts</li>
                        </ol>
                       
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Post Table
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <!-- <th>#</th> -->
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Created By</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                         foreach($posts as $post){
                                        ?>
                                        <tr>
                                            <td><?= $post['title']?></td>
                                            <td><?= $post['c_name']?></td>
                                            <td><?= $post['u_name']?></td>
                                            <td><a href="edit_post.php?id=<?=$post['id']?>" class="btn btn-warning mx-3 w-25">Edit</a><a class="btn btn-danger w-25">Delete</a ></td>
                                        </tr>
                                    <?php 
                                         }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
<?php 
 include "layouts/footer.php";

?>