<?php
  session_start();
  require_once('db.php');
  $upload_dir = 'uploads/';

  if(!isset($_SESSION['loggedin'])){
	header ('Location: adminLogin.php');
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

    if(empty($name)){
			$errorMsg = 'Please input name';
		}elseif(empty($category)){
			$errorMsg = 'Please choose category';
		}elseif(empty($description)){
			$errorMsg = 'Please input description';
		}elseif(empty($price)){
			$errorMsg = 'Please input price';
		}else{

			$imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
			$allowExt  = array('jpeg', 'jpg', 'png', 'gif');
			$productPic = time().'_'.rand(1000,9999).'.'.$imgExt;

			if(in_array($imgExt, $allowExt)){
				if($imgSize < 5000000){
					move_uploaded_file($imgTmp ,$upload_dir.$productPic);
				}else{
					$errorMsg = 'Image file too large';
				}
			}else{
				$errorMsg = 'Please select a valid image';
			}
		}


		if(!isset($errorMsg)){
			$sql = "insert into products(name, type,category, description, color, price, image)
					values('".$name."', '".$type."','".$category."', '".$description."', '".$color."','".$price."', '".$productPic."')";
			$result = mysqli_query($conn, $sql);
			if($result){
				$successMsg = 'New record added successfully';
				header('Location: admin.php');
			}else{
				$errorMsg = 'Error '.mysqli_error($conn);
			}
		}
  	}
?>
