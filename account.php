<?php
    require_once("db/db.php");
    require_once("classes/CLogin.php");
    require_once("classes/CRegistration.php");
    require_once("classes/CUpdate.php");

    $login = new CLogin();
    $registration = new CRegistration();
    $update = new CUpdate();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="b2u online store">
    <meta name="author" content="aungkominn">

    <title>B2U - Customer Account Infomation</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/b2u-style.css" rel="stylesheet">
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <!-- Nav menu top -->
    <?php include("views/navbar.php"); ?>
		<!-- Content body -->
    <div class="container content">
			<?php
            if ($login->isCustomerLoggedIn() == true) {
                include("views/account.php");
            } else {
                include("views/customerEntry.php");
            }
      ?>
		</div>
    <!-- Footer -->
		<?php include("views/footer.php"); ?>

		<!-- 		JAVASCRIPT		 -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/account.js"></script>
</body>

</html>
