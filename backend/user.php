<?php 
 
 include "layouts/nav_sidebar.php";
 include "../dbconnect.php";
 
 $sql="SELECT * FROM users";
 $stmt=$conn->prepare($sql);
 $stmt->execute();
 $users=$stmt->fetchAll();

//  var_dump($users);

?>
                 <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">User table</h1>
                        <div>
                            <a href="user_create.php" class="btn btn-primary float-end">Create User</a>
                        </div>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                       
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                User Table
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Profile</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                         foreach($users as $user){
                                        ?>
                                        <tr>
                                            <!-- <td></td> -->
                                            <td><?= $user['name']?></td>
                                            <td><?= $user['email']?></td>
                                            <td><?= $user['password']?></td>
                                            <td><?= $user['profile']?></td>
                                            <td><a href="edit_user.php?id=<?=$user['id']?>" class="btn btn-warning mx-3">Edit</a><a class="btn btn-danger">Dele</a></td>
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