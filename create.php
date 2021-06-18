<?php
include('add.php');
if (!isset($_SESSION['loggedin'])) {
  header('Location: adminLogin.php');
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
          <div class="card-header">ADD PRODUCT</div>
          <div class="card-body">
            <form class="" action="add.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Product Name" required>
              </div>
              <div class="form-group">
                <label for="type">Type</label>
                <select class="form-control" name="type" required>
                  <option disabled selected hidden>Type</option>
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
                <select class="form-control" name="category" required>
                  <option disabled selected hidden>Category</option>
                  <option>Men</option>
                  <option>Women</option>
                </select>
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" name="description" placeholder="Enter description" required>
              </div>
              <div class="form-group">
                <label for="color">Color</label>
                <input type="text" class="form-control" name="color" placeholder="Enter color" required>
              </div>
              <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" name="price" placeholder="Enter price" required>
              </div>
              <div class="form-group">
                <label for="image">Choose Image</label>
                <div class="col-md-4">
                  <img>
                  <input type="file" class="form-control" name="image" required>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" name="Submit" class="btn btn-primary waves">Submit</button>
                <a href="admin.php" name="Submit" class="btn btn-primary waves">Cancel</a>
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