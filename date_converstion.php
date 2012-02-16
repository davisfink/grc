<?php include 'config.php';?>
<!doctype html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title></title>
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="css/style.css">
	<!-- <link rel="stylesheet" href="css/blue_style.css"> -->
	<script type="text/javascript" charset="utf-8">
		var gameList = <?php echo get_game_list() ?>;
	</script>
</head>

<body>
	<div id="container">
	<?php 
		echo convert_date('TBA 2012');
	?>	
	</div> 
	
</body>
</html>
