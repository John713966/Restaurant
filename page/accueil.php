<?php
session_start();
require("../BD/connexion.php");

if (!isset($_SESSION['username'])) {
	header("location:../page/index.html");
}
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Restaurant</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="../assets/css/main.css" />
</head>

<body class="is-preload">
	<div id="page-wrapper">

		<?php
		require("../include/header.html");
		?>
		<?php
		require("../include/body.html");
		?>
		<?php
		require("../include/footer.html");
		?>
	</div>

	<!-- Scripts -->
	<script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/js/jquery.dropotron.min.js"></script>
	<script src="../assets/js/browser.min.js"></script>
	<script src="../assets/js/breakpoints.min.js"></script>
	<script src="../assets/js/util.js"></script>
	<script src="../assets/js/main.js"></script>

</body>

</html>