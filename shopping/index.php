<?php 
session_start();
$mycart = false;

if(empty($_SESSION['cart'])){
	$_SESSION['cart'] = array();
}

if(isset($_POST["add_product"]))
{
	$product_count = count($_SESSION["cart"]);

	$cart_product = array(
		'name'     => $_POST["name"],
		'price'    => $_POST["price"],
		'quantity' => $_POST['quantity']
	);
	$item_exists = in_array($_POST["name"], array_column($_SESSION["cart"], "name"));
	if($item_exists == false){
		$_SESSION["cart"][$product_count] = $cart_product;
		echo "You have added a new item in your cart<br>";
	}
	else{
		$product_index = array_search($_POST["name"], array_column($_SESSION["cart"], "name"));
		$new_quantity = $_SESSION["cart"][$product_index]["quantity"] + $_POST['quantity'];
	    $_SESSION["cart"][$product_index]["quantity"] = $new_quantity;
		
		echo "Quantity has been increased for the selected product.<br>";
	}
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <button type="button" onclick="location='cart.php'" class="btn btn-primary">My Cart</button>

    <div class="text-center">
        <?php

			// Do not alter -------------
			$products = [
					[ "name" => "Sledgehammer", "price" => 125.75 ],
					[ "name" => "Axe", "price" => 190.50 ],
					[ "name" => "Bandsaw", "price" => 562.131 ],
					[ "name" => "Chisel", "price" => 12.9 ],
					[ "name" => "Hacksaw", "price" => 18.45 ],
				   ];

			// Do not alter end ----------				

			foreach($products as $pr){
		?>
        <form method="post" action="index.php?action=add&name=<?php echo $pr["name"]; ?>">
            <div style="padding:10px;">

                <p><b>Product Name</b></p>
                <p><?php echo $pr['name']  ?></p>
                <p><b>Price</b></p>
                <p><?php echo number_format($pr['price'], 2)  ?></p>

                <input type="hidden" name="name" value="<?php echo $pr["name"]; ?>" />
                <input type="hidden" name="price" value="<?php echo number_format($pr['price'], 2) ?>" />
                <input type="number" min="1" name="quantity" value="1" />

                <input type="submit" name="add_product" value="Add to Cart" />

            </div>
        </form>
        <?php
		}
		?>
    </div>
    </div>
</body>

</html>