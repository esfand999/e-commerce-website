<?php
include('db2.php');
$search=$_POST['search'];
$upload_dir = 'uploads/';

$sql="select id,name,type,category,description,color,price from products "; 
if($search!=''){
	$sql.="where id like '%$search%' or name like '%$search%' or type like '%$search%' or category like '%$search%'";

}
$stmt=$con->prepare($sql);
$stmt->execute();
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);
if(isset($data['0'])){
	$html='<table class="table table-bordered"><thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Type</th>
			<th>Category</th>
			<th>Description</th>
			<th>Color</th>
			<th>Price</th>
		</tr>
		</thead>';
	foreach($data as $row){
		$html.='<tr>
			<td>'.$row['id'].'</td>
			<td>'.$row['name'].'</td>
			<td>'.$row['type'].'</td>
			<td>'.$row['category'].'</td>
			<td>'.$row['description'].'</td>
			<td>'.$row['color'].'</td>
			<td>'.$row['price'].'</td>
			<td class="text-center">
				<a href="edit.php?id=<?php echo '.$row["id"].' ?>" class="btn btn-primary">Edit</i></a>
				<a href="admin.php?delete=<?php echo '.$row["id"].' ?>" class="btn btn-danger" onclick="return confirm("Are you sure you want to delete this record?")">Remove</i></a>
			</td>
		  </tr>';
	}	
	$html.='</table>';
	echo $html;	
}else{
	echo "Data not found";
}
?>