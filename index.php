
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> 
	<title>Document</title>
</head>
<body>
<?php
if(isset($_GET['action'])) {
	$products = simplexml_load_file('data/product.xml');
	$id = $_GET['id'];
	$index = 0;
	$i = 0;
	foreach($products->product as $product){
		if($product['id']==$id){
			$index = $i;
			break;
		}
		$i++;
	}
	unset($products->product[$index]);
	file_put_contents('data/product.xml', $products->asXML());
}
$products = simplexml_load_file('data/product.xml');
echo 'Number of products: '.count($products);
echo '<br>List Product Information';
?>
<br>
<a href="add.php">Add new product</a>
<br>
<table class="table table-striped table-inverse table-responsive table-hover">
	<thead >
	<tr>
		<th>Id</th>
		<th>Name</th>
		<th>Price</th>
		<th>Actions</th>
	</tr>
		</thead>
		<tbody>
	
	

	
	<?php foreach($products->product as $product) { ?>
	<tr>
		<td><?php echo $product['id']; ?></td>
		<td><?php echo $product->name; ?></td>
		<td><?php echo $product->price; ?></td>
		<td><a href="edit.php?id=<?php echo $product['id']; ?>">Edit</a> |
			<a href="index.php?action=delete&id=<?php echo $product['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a></td>
	</tr>
	<?php } ?>
		</tbody>
</table>
</body>
</html>
