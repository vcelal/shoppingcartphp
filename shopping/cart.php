<?php 
session_start();
$mycart = false;

if(empty($_SESSION['cart'])){
	$_SESSION['cart'] = array();
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "remove")
	{
		foreach($_SESSION["cart"] as $keys => $values)
		{
			if($values["name"] == $_GET["name"])
			{
				unset($_SESSION["cart"][$keys]);
			}
		}
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
    <h1>My Cart</a></h1>
    <button type="button" onclick="location='index.php'" class="btn btn-primary">Product List</button>

    <div class="text-center">

        <h3>Cart Summary</h3>
        <div>
            <table class="table">
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th></th>
                </tr>
                <?php
					if(!empty($_SESSION["cart"]))
					{
						$total = 0;
						foreach($_SESSION["cart"] as $keys => $values)
						{
					?>
                <tr>
                    <td><?php echo $values["name"]; ?></td>
                    <td><?php echo $values["quantity"]; ?></td>
                    <td>$ <?php echo $values["quantity"] * $values["price"] ?></td>
                    <td><a href="cart.php?action=remove&name=<?php echo $values["name"]; ?>">Remove</a></td>
                </tr>
                <?php
							$total = $total + ($values["quantity"] * $values["price"]);
						}
					?>
                <tr>
                    <td><b>Total</b></td>
                    <td><b><?php echo number_format($total, 2); ?> NZD</b></td>
                    <td></td>
                </tr>
                <?php
					}
					?>
            </table>
        </div>
    </div>
    </div>
</body>

</html>