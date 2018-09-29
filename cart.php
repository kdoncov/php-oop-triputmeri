<?php 
session_start();

$conn = mysqli_connect("localhost","root","") or die("cannot connect to database");
$db = mysqli_select_db($conn, "triput_meri") or die("cannot connect to database");


$numbOfPr = '';		
if(isset($_POST["hidden_item_id"]))
{
	$itemId = $_POST["hidden_item_id"];
	
	if(isset($_COOKIE["shopping_cart"]))
	{
		$cookie_data = stripslashes($_COOKIE['shopping_cart']); //uzima vrednost iz cookie-a

		$cart_data = json_decode($cookie_data, true); // prebacuje podatke u niz
	}
	else
	{
		$cart_data = array();
	}

	$item_id_list = array_column($cart_data, 'item_id');

	
	

	if(in_array($_POST["hidden_item_id"], $item_id_list))
	{
		foreach($cart_data as $keys => $values)
		{
			if($cart_data[$keys]["item_id"] == $_POST["hidden_item_id"])
			{
				$cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["quantity"];
			}
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_POST["hidden_item_id"],
			'image_path'		=>	$_POST["hidden_image_path"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$cart_data[] = $item_array;
		
	}

	$numbOfPr = count($cart_data);
	$item_data = json_encode($cart_data);
	setcookie('shopping_cart', $item_data, time() + (86400 * 10));
	//setcookie('shopping_cart', "", time() - 3600);

	
	//header("location:addToCart.php?id=$itemId&alert=success");
	
	
}

if(isset($_POST['refresh'])){

	$change_quantity = $_POST['item_name'];
	$cookie_data = stripslashes($_COOKIE['shopping_cart']); //uzima vrednost iz cookie-a
	$cart_data = json_decode($cookie_data, true); // prebacuje podatke u niz
	
	foreach($cart_data as $keys => $values)
	{
		if($cart_data[$keys]['item_quantity'] != $change_quantity[$keys] && $change_quantity[$keys]>0) 
		{
			$cart_data[$keys]['item_quantity'] = $change_quantity[$keys];
		}

	}
	
	$item_data = json_encode($cart_data);
	setcookie('shopping_cart', $item_data, time() + (86400 * 10));
	
	header("location:cart.php?refreshed_all");
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		$cookie_data = stripslashes($_COOKIE['shopping_cart']); //uzima vrednost iz cookie-a
		$cart_data = json_decode($cookie_data, true); // prebacuje podatke u niz
		foreach($cart_data as $keys => $values)
		{
			if($cart_data[$keys]['item_id'] == $_GET['id'])
			{
				unset($cart_data[$keys]);
				$item_data = json_encode($cart_data);
				if(empty($cart_data))
				{
					setcookie("shopping_cart", "", time() - 3600);
					header("location:cart.php?empty=1");
				} else {
					setcookie("shopping_cart", $item_data, time() + (86400 * 10));
					header("location:cart.php?remove=1");}
			} 
		}
	} 
	   if($_GET["action"] == "clear")
	{
		setcookie("shopping_cart", "", time() - 3600);
		header("location:cart.php?clearall=1");
	} 
}

/* if(isset($_GET["success"]))
{
	$message = '
	<div class="alert alert-success alert-dismissible">
	  	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  	Item Added into Cart
	</div>
	';
} */

/* if(isset($_GET["remove"]))
{
	$message = '
	<div class="alert alert-success alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Item removed from Cart
	</div>
	';
} */
/* if(isset($_GET["clearall"]))
{
	$message = '
	<div class="alert alert-success alert-dismissible">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		Your Shopping Cart has been clear...
	</div>
	';
} */


?>
<!DOCTYPE html>
<html>
<head>
<?php
        include("includes/head.inc.php");  
    ?>
</head>
<body>
<header>
    <?php
        include("includes/header.inc.php");
    ?>
</header>
<section>
<?php
if(isset($_COOKIE["shopping_cart"]))
			{?>
			<div class="row padd-60">
                <h2 class="padd-20"><p>Detalji kupovine</p></h2>
				<form action="cart.php" method="POST">
				<table id="products" class="col-12" style="margin-bottom:30px" >
					<tr>
						<th>Ukloni</th>
						<th colspan = "2">Naziv proizvoda</th>
						<th>Cena</th>
						<th>Količina</th>
						<th>Ukupno</th>
						
					</tr>
					
			<?php
				$total = 0;
				$cookie_data = stripslashes($_COOKIE['shopping_cart']);
				$cart_data = json_decode($cookie_data, true);
				foreach($cart_data as $keys => $values)
				{
			?>
				<tr>
					<td><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><i class="fa fa-trash-o" style="font-size:18px"></i></a></td>
					<td><img src="<?php echo $values["image_path"]; ?>" alt="slika" style="width:80px; height:80px"></td>
					<td style="text-align:left"><a href="addToCart.php?id=<?php echo $values["item_id"]; ?>"><u><?php echo $values["item_name"]; ?></u></a></td>
					<td><?php echo $values["item_price"]; ?> din.</td>
					<td><input type="text" name="item_name[]" value="<?php echo $values["item_quantity"]; ?>" style="width:40%; text-align:center";></td>
					<td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?> din.</td>
					
				</tr>
			<?php	
					$total = $total + ($values["item_quantity"] * $values["item_price"]);
				}
			?>
					<tr>
						<td colspan="5" >Total</td>
						<td ><?php echo number_format($total, 2); ?> din.</td>
					</tr>
					<tr><td><input type="submit" name="refresh" value="osveži"></td>
					<td><a href="cart.php?action=clear">obriši sve</a></td>
					</tr>
					<?php
					} else { ?>
						<div class="wrap-100 padd-60">
							<div class="padd-60">
							<i class="fa fa-shopping-cart" style="font-size:100px;color:lightgray"></i>
							<h2>Vaša korpa je prazna</h2><br>
							<a href="index.php"><u>povratak na početnu stranu</u></a>
							</div>
						
						</div>

					<?php } ?>
						
				</table>
				</form>
			</div>
			<div id="showAlert"><h3>Proizvod <?php echo $_POST["hidden_name"] ?> je dodat u korpu</h3></div>
			<div id="numbOfProducts"><?php echo $numbOfPr; ?></div>
		</section>
			
<footer>
    <?php   
        include("includes/footer.inc.php");
    ?>
</footer>

</body>
</html>