<?php
if(!empty($_POST)){
    $connection=mysqli_connect("localhost","root","","snazzle");
    $tablename ="paymentinformation";

    if(mysqli_connect_errno()){
        die ("Database connection failed: ".mysqli_connect_error()."(".mysqli_connect_errno().")");
    }
    else {
    }

    if (isset($_POST['firstName'])){
        $firstName = $_POST['firstName'];
    }
    if (isset($_POST['lastName'])){
        $lastName = $_POST['lastName'];
    }
    if (isset($_POST['email'])){
        $email = $_POST['email'];
    }
    if (isset($_POST['address'])){
        $address = $_POST['address'];
    }
    if (isset($_POST['country'])){
        $country = $_POST['country'];
    }
    if (isset($_POST['province'])){
        $province = $_POST['province'];
    }
    if (isset($_POST['postalCode'])){
        $postalCode = $_POST['postalCode'];
    }
    if (isset($_POST['paymentMethod'])){
        $paymentMethod = $_POST['paymentMethod'];
    }
    if (isset($_POST['nameOnCard'])){
        $nameOnCard = $_POST['nameOnCard'];
    }
    if (isset($_POST['creditCardNumber'])){
        $creditCardNumber = $_POST['creditCardNumber'];
    }
    if (isset($_POST['expiration'])){
        $expiration = $_POST['expiration'];
    }
    if (isset($_POST['cvv'])){
        $cvv = $_POST['cvv'];
    }
    $totalCost = $_POST['hiddenBox'];
    $finalCost = $totalCost + 20;
    $numberOfItems= $_POST['secondSecretBox'];
    $coupon = $_POST['thirdHiddenBox'];
    $FINALcost = $finalCost-$coupon;
    $couponCode = $_POST['couponCode'];

    if(isset($_POST['firstName'])){
        $sql1="INSERT INTO $tablename (firstName, lastName, email, address, country, province,
        postalCode, paymentMethod, nameOnCard, creditCardNumber, expiration, cvv) VALUES (
            '{$connection-> real_escape_string($firstName)}',
            '{$connection-> real_escape_string($lastName)}',
            '{$connection-> real_escape_string($email)}',
            '{$connection-> real_escape_string($address)}',
            '{$connection-> real_escape_string($country)}',
            '{$connection-> real_escape_string($province)}',
            '{$connection-> real_escape_string($postalCode)}',
            '{$connection-> real_escape_string($paymentMethod)}',
            '{$connection-> real_escape_string($nameOnCard)}',
            '{$connection-> real_escape_string($creditCardNumber)}',
            '{$connection-> real_escape_string($expiration)}',
            '{$connection-> real_escape_string($cvv)}')";

        $insert1=$connection->query($sql1);
        if($insert1 == TRUE){
            echo "<h3>Your order has been successfully placed. Thank you!</h3>";
            header("Location: thanksForPurchase.html");
        } else{
            die("Error: {$connection->errno} : {$connection->error}");
        }
    }
}
?>

<!doctype html>
<html lang="en" class="wholepage">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Checkout example · Bootstrap v5.1 </title>
    <link rel="stylesheet" href="../bootstrap/form-validation.css">
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/checkout/">
    <link href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="snazzles.css">
    <!-- Bootstrap core CSS -->

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

    <!-- Custom styles for this template -->
    <link href="../bootstrap/form-validation.css" rel="stylesheet">
</head>

<body class="bg-light" class="wholepage">

<div class="container">
    <main>
        <div class="py-5 text-center">
            <h2>Checkout form</h2>
            <img class="d-block mx-auto mb-4" src="https://media.discordapp.net/attachments/938796133105414214/963492331720409198/unknown.png" alt="" width="190" height="150"><hr>
        </div>

        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-dark">Your cart</span>
                    <span class="badge bg-dark rounded-pill itemCount">
              <?php
              if(isset($numberOfItems)){
                  echo "$numberOfItems";
              };
              ?>

              </span>
                </h4>
                <ul class="list-group mb-3">

                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">Cart Total</h6>

                        </div>
                        <span class="text-muted">$ <?php
                            if(isset($totalCost)){
                                echo "$totalCost";
                            };
                            ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">Flat Shipping Fee</h6>
                            <small class="text-muted">FedEx Expedited Shipping</small>
                        </div>
                        <span class="text-muted">$ 20.00</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">Promo code</h6>
                            <small>
                            </small>
                        </div>
                        <span class="text-success"></span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong id="showTotal" class="showTotal">
                            <?php
                            if(isset ($finalCost)){
                                echo "$ ";
                                echo "$FINALcost";
                            };
                            ?>
                        </strong>
                    </li>
                </ul>

            </div>
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Billing address</h4>
                <form id="form2" name="form2" action="" method="POST" class="needs-validation" novalidate>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">First name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Last name</label>
                            <input type="text" name="lastName" class="form-control" id="lastName" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email <span class="text-muted">(Required)</span></label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="youremail@example.com">
                            <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" id="address" placeholder="1234 Main St" required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>

                        <div class="col-md-5">
                            <label for="country" class="form-label">Country</label>
                            <select name="country" class="form-select" id="country" required>
                                <option value="">Choose...</option>
                                <option value="Canada">Canada</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="province" class="form-label">Province or Territory</label>
                            <select name="province" class="form-select" id="province" required>
                                <option value="">Choose...</option>
                                <option value="Alberta">Alberta</option>
                                <option value="British Columbia">British Columbia</option>
                                <option value="Manitoba">Manitoba</option>
                                <option value="New Brunswick">New Brunswick</option>
                                <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
                                <option value="Northwest Territories">Northwest Territories</option>
                                <option value="Nova Scotia">Nova Scotia</option>
                                <option value="Nunavut">Nunavut</option>
                                <option value="Ontario">Ontario</option>
                                <option value="Prince Edward Island">Prince Edward Island</option>
                                <option value="Quebec">Quebec</option>
                                <option value="Saskatchewan">Saskatchewan</option>
                                <option value="Yukon">Yukon</option>
                            </select>
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="postalCode" class="form-label">Postal Code</label>
                            <input type="text" name="postalCode" class="form-control" id="postalCode" placeholder="" required>
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h4 class="mb-3">Payment</h4>

                    <div class="my-3">
                        <div class="form-check">
                            <input id="credit" value="Credit" name="paymentMethod" type="radio" class="form-check-input btn-dark active" checked required>
                            <label class="form-check-label" for="credit">Credit card</label>
                        </div>
                        <div class="form-check">
                            <input value="Debit" id="debit" name="paymentMethod" type="radio" class="form-check-input btn-dark active" required>
                            <label class="form-check-label" for="debit">Debit card</label>
                        </div>

                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label for="cc-name" class="form-label">Name on card</label>
                                <input type="text" name="nameOnCard" class="form-control" id="cc-name" placeholder="" required>
                                <small class="text-muted">Full name as displayed on card</small>
                                <div class="invalid-feedback">
                                    Name on card is required
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="cc-number" class="form-label">Credit card number</label>
                                <input type="text" name="creditCardNumber" class="form-control" id="cc-number" placeholder="" required>
                                <div class="invalid-feedback">
                                    Credit card number is required
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-expiration" class="form-label">Expiration</label>
                                <input type="text" name="expiration" class="form-control" id="cc-expiration" placeholder="" required>
                                <div class="invalid-feedback">
                                    Expiration date required
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-cvv" class="form-label">CVV</label>
                                <input type="text" name="cvv" class="form-control" id="cc-cvv" placeholder="" required>
                                <div class="invalid-feedback">
                                    Security code required
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <input class="w-100 btn btn-primary btn-dark btn-lg" value="Confirm Payment" type="submit" onclick="contactSubmit1();">
                </form>
            </div>
        </div>
    </main>

    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2021 Snazzles</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="http://localhost/Web_FinalProject/html/About.html">About</a></li>
            <li class="list-inline-item"><a href="http://localhost/Web_FinalProject/html/Contact.php">Contact</a></li>
        </ul>
    </footer>
</div>

<script src="../bootstrap/bootstrap.bundle.min.js.map"></script>
<script src="../bootstrap/form-validation.js"></script>
<script src="shoppingCart.js"></script>

</body>
</html>

<script>
    function contactSubmit1(){
        var form1 = document.getElementById("form2");
        form1.submit();
    }
</script>