<?php
session_start();
?>
<?php include('header.php'); ?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">


        <title>Checkout</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/checkout/">

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/form-validation.css" rel="stylesheet">
    </head>

    <body class="bg-light">

        <div class="container007">


            <div class="row">
                <div class="col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Your cart</span>
                        <span class="badge badge-secondary badge-pill"><?php echo $_SESSION['quantity'] ?></span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Subamount</h6>

                            </div>
                            <span class="text-muted">&#x20b9; <?php echo $_SESSION['total_ini'] ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Tax (5%)</h6>

                            </div>
                            <span class="text-muted">&#x20b9; <?php echo 0.05 * $_SESSION['total_ini'] ?></span>
                        </li>
                        <?php if ($_SESSION['total'] != $_SESSION['grand_total']) { ?>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Discount</h6>

                                </div>
                                <span class="text-muted">&#x20b9; <?php echo $_SESSION['total'] - $_SESSION['grand_total'] ?></span>
                            </li>
                        <?php } ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <h6 class="my-0">Amount (Rupee)</h6>
                            <strong>&#x20b9; <?php echo $_SESSION['grand_total'] ?></strong>
                        </li>
                    </ul>

                    
                </div>
                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">Billing address</h4>
                    <form  action="order.php" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">Full name</label>
                                <input style="width:100% ;border:solid;border-width:1px;border-color: gray" type="text" class="form-control" id="firstName" name="name" placeholder="" value="<?php echo $_SESSION['name'] ?>" required>
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>

                        </div>
                        <div class="mb-3">
                            <label for="mobile">Contact Number</label>
                            <input style="width:100%;border:solid;border-width:1px;border-color: gray" type="text" class="form-control" id="number" name="mob" value="<?php echo $_SESSION['mobile'] ?>" required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>


                        <div class="mb-3">
                            <label for="email">Email <span class="text-muted">(Optional)</span></label>
                            <input style="border:solid;border-width:1px;border-color: gray" type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email'] ?>">
                            <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address">Address</label>
                            <input style="width:100%;border:solid;border-width:1px;border-color: gray" type="text" class="form-control" name="address" id="address" value="<?php echo $_SESSION['add'] ?>" required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>



                        <h4 class="mb-3">Payment</h4>

                        <div class="d-block my-3">
                            <div class="custom-control custom-radio">
                                <input style="border:solid;border-width:1px;border-color: gray" id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                                <label class="custom-control-label" for="credit">Credit card</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input style="border:solid;border-width:1px;border-color: gray" id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                                <label class="custom-control-label" for="debit">Debit card</label>
                            </div>
                            <div class="custom-control custom-radio" onclick="hide()">
                                <input style="border:solid;border-width:1px;border-color: gray" id="paypal"  name="paymentMethod" type="radio" class="custom-control-input" required>
                                <label class="custom-control-label" for="cod">COD</label>
                            </div>
                        </div>
                        
                        <div id="crdr">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="cc-name">Name on card</label>
                                    <input style="border:solid;border-width:1px;border-color: gray" type="text" class="form-control" id="cc-name" placeholder="" required>
                                    <small class="text-muted">Full name as displayed on card</small>
                                    <div class="invalid-feedback">
                                        Name on card is required
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cc-number">Credit card number</label>
                                    <input style="border:solid;border-width:1px;border-color: gray" type="text" class="form-control" id="cc-number" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Credit card number is required
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="cc-expiration">Expiration</label>
                                    <input style="border:solid;border-width:1px;border-color: gray" type="text" class="form-control" id="cc-expiration" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Expiration date required
                                    </div>
                                </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <div class="col-md-3 mb-3">
                                    <label for="cc-expiration">CVV</label>
                                    <input style="border:solid;border-width:1px;border-color: gray" type="password" maxlength="3" class="form-control" id="cc-cvv" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Security code required
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <input  class="btn btn-primary btn-lg btn-block" type="submit" value="Continue to checkout">
                    </form>
                </div>
            </div>

        </div>

        
        <script>
                            
                            function hide() {
                                document.getElementById("crdr").style.display = "none";
                            }
                        
        </script>
    </body>
</html>
