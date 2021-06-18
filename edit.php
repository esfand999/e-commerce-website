<?php
session_start();
require_once('db.php');

if (!isset($_SESSION['loggedin'])) {
  header('Location: adminLogin.php');
}

$upload_dir = 'uploads/';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "select * from products where id=" . $id;
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
  } else {
    $errorMsg = 'Could not Find Any Record';
  }
}

if (isset($_POST['Submit'])) {
  $name = $_POST['name'];
  $type = $_POST['type'];
  $category = $_POST['category'];
  $description = $_POST['description'];
  $color = ucfirst($_POST['color']);
  $price = $_POST['price'];

  $imgName = $_FILES['image']['name'];
  $imgTmp = $_FILES['image']['tmp_name'];
  $imgSize = $_FILES['image']['size'];

  if ($imgName) {

    $imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
    $allowExt  = array('jpeg', 'jpg', 'png', 'gif');
    $productPic = time() . '_' . rand(1000, 9999) . '.' . $imgExt;

    if (in_array($imgExt, $allowExt)) {
      if ($imgSize < 5000000) {
        unlink($upload_dir . $row['image']);
        move_uploaded_file($imgTmp, $upload_dir . $productPic);
      } else {
        $errorMsg = 'Image too large';
      }
    } else {
      $errorMsg = 'Please select a valid image';
    }
  } else {
    $productPic = $row['image'];
  }

  if (!isset($errorMsg)) {
    $sql = "update products
                  set name = '" . $name . "',
                    type = '" . $type . "',
										category = '" . $category . "',
                    description = '" . $description . "',
                    color = '" . $color . "',
                    price = '" . $price . "',
										image = '" . $productPic . "'
					where id=" . $id;
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $successMsg = 'New record updated successfully';
      header('Location:admin.php');
    } else {
      $errorMsg = 'Error ' . mysqli_error($conn);
    }
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
</head>

<body>



  <div class="container mt-5">
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            Edit Product
          </div>
          <div class="card-body">
            <form class="" action="" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Name" value="<?php echo $row['name']; ?>" required>
              </div>
              <div class="form-group">
                <label for="type">Type</label>
                <select class="form-control" name="type" required>
                  <option disabled required value="<?php echo $row['type']; ?>"><?php echo $row['type']; ?></option>
                  <option>Shirt</option>
                  <option>T-shirt</option>
                  <option>Jacket</option>
                  <option>Sweater</option>
                  <option>Hoodies</option>
                  <option>Jeans</option>
                  <option>Footwear</option>
                </select>
              </div>
              <div class="form-group">
                <label for="category">Category</label>
                <select name="category" class="form-control form-style" required>
                  <option selected value="<?php echo $row['category']; ?>"><?php echo $row['category']; ?></option>
                  <option>Men</option>
                  <option>Women</option>
                </select>
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" name="description" placeholder="Enter Description" value="<?php echo $row['description']; ?>" required>
              </div>
              <div class="form-group">
                <label for="color">Color</label>
                <input type="text" class="form-control" name="color" placeholder="Enter Color" value="<?php echo $row['color']; ?>" required>
              </div>
              <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" name="price" placeholder="Enter Price" value="<?php echo $row['price']; ?>" required>
              </div>
              <div class="form-group">
                <label for="image">Choose Image</label>
                <div class="col-md-4">
                  <img src="<?php echo $upload_dir . $row['image'] ?>" width="100">
                  <input type="file" class="form-control" name="image" value="" required>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" name="Submit" class="btn btn-primary waves">Submit</button>
                <a href="admin.php" class="btn btn-primary waves">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="js/bootstrap.min.js" charset="utf-8"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" charset="utf-8"></script>
</body>

</html>