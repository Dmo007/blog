<?php 
  
  include "layouts/nav_sidebar.php";
  include "../dbconnect.php";

  $sql="SELECT * FROM categories";
  $stmt=$conn->prepare($sql);
  $stmt->execute();
  $categories=$stmt->fetchAll();
//   var_dump($categories);

?>
 <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Category table</h1>
                        <div>
                            <a href="category_create.php" class="btn btn-primary float-end">Create Categories</a>
                        </div>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Category</li>
                        </ol>
                       
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Category Table
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                         foreach($categories as $category){
                                        ?>
                                        <tr>
                                            <td><?= $category['name']?></td>
                                            <td><button class="btn btn-warning mx-3 w-25">Edit</button><button class="btn btn-danger w-25">Dele</button></td>
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