<?php 
  include "../dbconnect.php";

$sql="SELECT * FROM categories";
$stmt=$conn->prepare($sql);
$stmt->execute();
$categories=$stmt->fetchAll();

$id=$_GET['id'];
// echo "$id";

$sql="SELECT posts.*,categories.name as c_name,users.name as u_name FROM posts INNER JOIN categories ON posts.category=categories.id INNER JOIN users ON posts.user_id=users.id WHERE posts.id=:id";
 $stmt=$conn->prepare($sql);
 $stmt->bindParam(':id',$id);
 $stmt->execute();
 $post=$stmt->fetch(PDO::FETCH_ASSOC);

//  var_dump($post);

if ($_SERVER['REQUEST_METHOD']=='POST'){
$id=$_POST['id'];
$title=$_POST['title'];
$category_id=$_POST['category_id'];
$user_id=2;
$description=$_POST['description'];
$photo_arr=$_FILES['newphoto'];
$old_photo=$_POST['photo'];

//echo "$title and $category_id and $user_id and $description";
//print_r($photo);

if(isset($photo_arr) && $photo_arr['size'] > 0){
  
    $dir='images/';
    $photo=$dir.$photo_arr['name'];
    $tmp_name=$photo_arr['tmp_name'];
    move_uploaded_file($tmp_name,$photo);
}else{
    $photo=$old_photo;
}

// $sql="INSERT INTO posts (title,category,user_id,photo,description) VALUES('$title',$category_id,$user_id,'$photo','$description')";
// $stmt=$conn->prepare($sql);
// $stmt->execute();  ------>insert ထည့် <---------
$sql="UPDATE posts SET title=:title,category=:category_id,user_id=:user,photo=:photo,description=:description WHERE id=:id";
$stmt=$conn->prepare($sql);
$stmt->bindParam(':id',$id);
$stmt->bindParam(':title',$title);
$stmt->bindParam(':category_id',$category_id);
$stmt->bindParam(':user',$user_id);
$stmt->bindParam(':photo',$photo);
$stmt->bindParam(':description',$description);
$stmt->execute();

header("location:posts.php");
exit;
}else{
    include "layouts/nav_sidebar.php";

}

?>
<div class="container px-3">
    <div class="card my-5">
        <div class="card-header">
            <h5 class="d-inline">Post create</h5>
            <a href="posts.php" class="btn btn-danger float-end">Cancel</a>
        </div>
        <div class="card-body">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?=$post['id']?>">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?=$post['title']?>">
                </div>
                 <div class="mb-3">
                 <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="photo-tab" data-bs-toggle="tab" data-bs-target="#photo-tab-pane" type="button" role="tab" aria-controls="photo-tab-pane" aria-selected="true">Photo</button>
                     </li>
                    <li class="nav-item" role="presentation">
                         <button class="nav-link" id="newphoto-tab" data-bs-toggle="tab" data-bs-target="#newphoto-tab-pane" type="button" role="tab" aria-controls="newphoto-tab-pane" aria-selected="false">New Photo</button>
                    </li>
                </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="photo-tab-pane" role="tabpanel" aria-labelledby="photo-tab" tabindex="0">
                    <img src="<?= $post['photo']?>" alt="" class="img-fluid w-50 h-50 my-3">
                    <input type="hidden" name="photo" value="<?=$post['photo']?>">
                </div>
                <div class="tab-pane fade" id="newphoto-tab-pane" role="tabpanel" aria-labelledby="newphoto-tab" tabindex="0">
                <input class="form-control my-3" type="file" id="photo" name="newphoto">
                </div>
            </div>
                 </div>
                <div class="mb-3">
                     <label for="category_id" class="form-label">Categories</label>
                    <select class="form-select" name="category_id" id="category_id">
                         <option selected>Select category</option>
                    <?php 
                        foreach ($categories as $category) {
                 
                    ?>
                        <option value="<?= $category['id']?>" <?php if ($category['id']==$post['category']){
                            echo "selected";
                        }?> ><?= $category['name']?></option>
                    <?php 
                     }
                    ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" rows="3" name="description"><?=$post['description']?></textarea>
                </div>
                 <button class="btn btn-primary w-100 mt-3 " type="submit">Update</button>
            </form>
        </div>
    </div>
  
</div>

<?php
    include "layouts/footer.php";
?>
