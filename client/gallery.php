<?php
	session_start();
	if(!isset($_SESSION['userlogin'])){
		header('Location: login.html');
	}
?>

<html>
<body>
<script type="text/javascript" src="js/rsa.js"></script>
<script type="text/javascript" src="js/des.js"></script>
<script type="text/javascript">

		function encrypt(p) {
            var desKEY = p.key.value;

			var ccardEncrypted = javascript_des_encryption(desKEY, p.ccard.value);
            p.ccard.value = ccardEncrypted;
           
            var ProductApriceEncrypted = javascript_des_encryption(desKEY, p.ProductAprice.value);
            p.ProductAprice.value = ProductApriceEncrypted;
            var ProductBpriceEncrypted = javascript_des_encryption(desKEY, p.ProductBprice.value);
            p.ProductBprice.value = ProductBpriceEncrypted;
            var ProductCpriceEncrypted = javascript_des_encryption(desKEY, p.ProductCprice.value);
            p.ProductCprice.value = ProductCpriceEncrypted;
                       
            var ProductAtotalEncrypted = javascript_des_encryption(desKEY, p.ProductAtotal.value);
            p.ProductAtotal.value = ProductAtotalEncrypted;
            var ProductBtotalEncrypted = javascript_des_encryption(desKEY, p.ProductBtotal.value);
            p.ProductBtotal.value = ProductBtotalEncrypted;
            var ProductCtotalEncrypted = javascript_des_encryption(desKEY, p.ProductCtotal.value);
            p.ProductCtotal.value = ProductCtotalEncrypted;

            
            var totalEncrypted = javascript_des_encryption(desKEY, p.total.value);
            p.total.value = totalEncrypted;
            
            var totalPriceEncrypted = javascript_des_encryption(desKEY, p.totalPrice.value);
            p.totalPrice.value = totalPriceEncrypted;            
            
            var pubilc_key = "-----BEGIN PUBLIC KEY-----MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAzdxaei6bt/xIAhYsdFdW62CGTpRX+GXoZkzqvbf5oOxw4wKENjFX7LsqZXxdFfoRxEwH90zZHLHgsNFzXe3JqiRabIDcNZmKS2F0A7+Mwrx6K2fZ5b7E2fSLFbC7FsvL22mN0KNAp35tdADpl4lKqNFuF7NT22ZBp/X3ncod8cDvMb9tl0hiQ1hJv0H8My/31w+F+Cdat/9Ja5d1ztOOYIx1mZ2FD2m2M33/BgGY/BusUKqSk9W91Eh99+tHS5oTvE8CI8g7pvhQteqmVgBbJOa73eQhZfOQJ0aWQ5m2i0NUPcmwvGDzURXTKW+72UKDz671bE7YAch2H+U7UQeawwIDAQAB-----END PUBLIC KEY-----";
            var encrypt = new JSEncrypt();
			encrypt.setPublicKey(pubilc_key);
			var encrypted = encrypt.encrypt(desKEY);
            p.key.value = encrypted; 

        }
    </script>


	</script>
        <script type="text/javascript">
            var calcSubTotal = function(productName) {
                var quantity = parseInt(document.getElementById(productName + 'quantity').value);
                if (quantity > 0) {
                    var price = parseInt(document.getElementById(productName + 'price').value);
                    var subtotal = price * quantity;
                    document.getElementById(productName + "subtotal").innerHTML = subtotal;
                    document.getElementById(productName + "total").value = subtotal;
                    return subtotal;
                }
                document.getElementById(productName + "subtotal").innerHTML = 0;
                document.getElementById(productName + "total").value = 0;
                return 0;
            }

            function updateCart() {

                var total = calcSubTotal('ProductA') + calcSubTotal('ProductB') + calcSubTotal('ProductC');
                var quantity = parseInt(document.getElementById('ProductAquantity').value) + parseInt(document.getElementById('ProductBquantity').value) + parseInt(document.getElementById('ProductCquantity').value);

                document.getElementById("Quantity").innerHTML = quantity;
                document.getElementById("totalQuantity").value = quantity;

                document.getElementById("Price").innerHTML = total;
                document.getElementById("totalPrice").value = total;

            }
					

        </script>
        <div align="center">
        <h1>Moafaq Online Gallery</h1>

        Good day! <?php echo $_SESSION['userlogin']; ?>

        <form action="../server/logout.php" method="POST">
        <button type="submit">Logout</button>
        </form>

                <form action="../server/order.php" method="POST">
                    <table>
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                        <tr>
                            <td>
                            <a href="img/mosque1.jpg" target="_blank"><img src="img/mosque1.jpg" alt="click on inlarge" height="142" width="200"></a>
                                <input type="hidden" name="ProductA" id="ProductA" value="ProductA" />
                            </td>
                            <td>$95
                                <input type="hidden" name="ProductAprice" id="ProductAprice" value="95" /></td>
                            <td>
                                <input id="ProductAquantity" name="ProductAquantity" type="number" value="0" min="0" max="10" onchange="updateCart()"/>
                            </td>
                            <td>
                                <p id="ProductAsubtotal">0</p>
                                <input id="ProductAtotal" name="ProductAtotal" type="hidden" value="0" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <a href="img/mosque2.jpg" target="_blank"><img src="img/mosque2.jpg" alt="click on inlarge" height="142" width="200"></a>
                                <input type="hidden" name="ProductB" id="ProductB" value="ProductB" />
                            </td>
                            <td>$110
                                <input type="hidden" name="ProductBprice" id="ProductBprice" value="110" />
                            </td>
                            <td>
                                <input id="ProductBquantity" name="ProductBquantity" type="number" value="0" min="0" max="10" onchange="updateCart()"/>
                            </td>
                            <td>
                                <p id="ProductBsubtotal">0</p>
                                <input id="ProductBtotal" name="ProductBtotal" type="hidden" value="0" />    
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <a href="img/mosque3.jpg" target="_blank"><img src="img/mosque3.jpg" alt="click on inlarge" height="142" width="200"></a>

                                <input type="hidden" name="ProductC" id="ProductC" value="ProductC" />
                            </td>
                            <td>$150
                                <input type="hidden" name="ProductCprice" id="ProductCprice" value="150" />
                            </td>
                            <td>
                                <input id="ProductCquantity" name="ProductCquantity" type="number" value="0" min="0" max="10" onchange="updateCart()"/>
                            </td>
                            <td>
                                <p id="ProductCsubtotal">0</p>
                                <input id="ProductCtotal" name="ProductCtotal" type="hidden" value="0" />
                            </td>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <th></th>
                            <th>
                                <p id="Quantity">0</p>
                                <input id="totalQuantity" name="total" type="hidden" value="0" />
                            </th>
                            <th>
                                <p id="Price">0</p>
                                <input id="totalPrice" name="totalPrice" type="hidden" value="0" />
                            </th>
                        </tr>
                        
                    </table>
                    <table>
                    <tr>
                        <td>DES encryption key: <input type="text" id="key" name="key" /> 	</td>                   
                        </tr>
                        <tr>
                        <td>Credit Card Number: <input type="text" id="ccard" name="ccard" /> </td>
                        </tr>
                        <tr>
                        <td></td>
                        <td></td>
                        <td><button type="submit" onclick="encrypt(this.form); ">Submit</button>
                        </td>
                        </tr>
                    </table>
                </form>

        </div>
            </body>




</html>