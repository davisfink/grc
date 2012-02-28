<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Junk 'n Stuff</title>
	<?php echo HTML::style('css/style.css'); ?>
</head>
<body>
	<div id="main">
		<h1 id="title">Game Release Calendar</h1>
		<form action="#" id="search_form">
			<fieldset>
				<input type="text" name="search" value="" id="search" placeholder="Search" autofocus />
			</fieldset>
		</form>
		
		<table id="game_table" class="tablesorter">
			<thead>
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
			</thead>
			<tbody>
					<?php foreach ($games as $item) {
						echo '<tr>';
						echo '<td>'.$item->title.'</td>';
						echo '<td>'.date('M d, Y',strtotime($item->release_date)).'</td>';
						echo '<td>'.$item->genre.'</td>';
						echo '</tr>';
					}?>
			</tbody>
		</table>
		
	</div>
	<?php 
	echo HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js');
	echo HTML::script('js/javascripts.js');
	echo HTML::script('js/jquery.quicksearch.js');
	echo HTML::script('js/jquery.tablesorter.js');
	?>
</body>
</html>
