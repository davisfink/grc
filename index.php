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
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script>

	<script type="text/javascript" charset="utf-8">
	var gameList = <?php echo get_game_list() ?>;
	
	$(function() {
		$table = $('table:first > tbody');

		for (i in gameList) {
			$row = $('<tr />');
			$row.append('<td>'+gameList[i].title+'</td>');
			$row.append('<td>'+gameList[i].release_date+'</td>');
			$row.append('<td>'+gameList[i].genre+'</td>');
			$table.append($row);
		}
	})
	</script>
</head>

<body>
  <div id="container">
    <header>
			<h1>Game Release Calendar</h1>
			<p>Welcome to grc v1. The following is a list of game and their proposed release dates.</p>
    </header>
    <div id="main" role="main">

			<table>
				<tr>
					<th>
						Title:
					</th>
					<th>
						Release Date:
					</th>
					<th>
						Genre:
					</th>
				</tr>
			</table>
		
		</div>
		<footer>

    </footer>
  </div> 
</body>
</html>
