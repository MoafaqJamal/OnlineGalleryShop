<?php
	session_start();
	include('rsa.php');
	include('des.php');
	
	$desKEY = $_POST['key'];
	$publicKey = get_rsa_publickey('public.key');
	$privateKey = get_rsa_privatekey('private.key');

    $recovered_desKEY = rsa_decryption($desKEY, $privateKey);;

	$ccardEncrypted = $_POST['ccard'];
	$recovered_ccard = php_des_decryption($recovered_desKEY , $ccardEncrypted);
	
	$totalEncrypted = $_POST['total'];
	$recovered_total = php_des_decryption($recovered_desKEY , $totalEncrypted);

	$totalPriceEncrypted = $_POST['totalPrice'];
	$recovered_totalPrice = php_des_decryption($recovered_desKEY , $totalPriceEncrypted);

	$ProductApriceEncrypted = $_POST['ProductAprice'];
	$recovered_ProductAprice = php_des_decryption($recovered_desKEY , $ProductApriceEncrypted);
	$ProductBpriceEncrypted = $_POST['ProductBprice'];
	$recovered_ProductBprice = php_des_decryption($recovered_desKEY , $ProductBpriceEncrypted);
	$ProductCpriceEncrypted = $_POST['ProductCprice'];
	$recovered_ProductCprice = php_des_decryption($recovered_desKEY , $ProductCpriceEncrypted);

	$ProductAtotalEncrypted = $_POST['ProductAtotal'];
	$recovered_ProductAtotal = php_des_decryption($recovered_desKEY , $ProductAtotalEncrypted);
	$ProductBtotalEncrypted = $_POST['ProductBtotal'];
	$recovered_ProductBtotal = php_des_decryption($recovered_desKEY , $ProductBtotalEncrypted);
	$ProductCtotalEncrypted = $_POST['ProductCtotal'];
	$recovered_ProductCtotal = php_des_decryption($recovered_desKEY , $ProductCtotalEncrypted);

?>
<html>
<body>
<div align="center">


<h1>Moafaq Online Gallery: Your Order</h1>


<table>
  <tr>
    <th>Products</th>
    <th>Price</th>
	<th>Quantity</th>
	<th>Subtotal</th>
  </tr>
  <tr>
    <td><img src="../client/img/mosque1.jpg" height="142" width="200"></td>
    <td><?php echo $recovered_ProductAprice; ?></td>
	<td><?php echo $_POST["ProductAquantity"]; ?></td>
	<td><?php echo $recovered_ProductAtotal; ?></td>
  </tr>
  <tr>
    <td><img src="../client/img/mosque2.jpg" height="142" width="200"></td>
    <td><?php echo $recovered_ProductBprice; ?></td>
	<td><?php echo $_POST["ProductBquantity"]; ?></td>
	<td><?php echo $recovered_ProductBtotal; ?></td>
  </tr>
  <tr>
    <td><img src="../client/img/mosque3.jpg" height="142" width="200"></td>
    <td><?php echo $recovered_ProductCprice; ?></td>
	<td><?php echo $_POST["ProductCquantity"]; ?></td>
	<td><?php echo $recovered_ProductCtotal; ?></td>
  </tr>
  <tr>
    <th></th>
    <th>Total</th>
	<th><?php echo $recovered_total; ?></th>
	<th><?php echo $recovered_totalPrice; ?></th>
  </tr>

</table>


<?php
	
	$userOrder = "Order for: " . $_SESSION['userlogin'] . "\nProducts Quantity: " . $recovered_total. "\nProductA: " . $_POST['ProductAquantity'] . " (A$95)\nProductB:". $_POST['ProductBquantity'] . " (A$110)\nProductC:". $_POST['ProductCquantity'] . " (A$150)\nTotal price: " . $recovered_totalPrice . "\nCredit card number: ". $recovered_ccard;
	$file = fopen("../database/orders.txt","a");
	fwrite($file,$userOrder."\n \n ======================== \n \n");
	fclose($file);
	
	echo "Received encrypted DES key: " . $desKEY . "<br/><br/>";
	echo "Recovered DES key: " . $recovered_desKEY . "<br/><br/>";
	echo "Received encrypted credit card number: " . $ccardEncrypted . "<br/><br/>";
	echo "Recovered credit card number: " . $recovered_ccard . "<br/><br/>";


	echo "<br/><a href='../database/orders.txt'>Orders History</a>";

?>


</body>
</html>