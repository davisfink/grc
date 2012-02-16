$(function() {
	$table = $('table:first > tbody');
	
	for (i in gameList) {
		$row = $('<tr />');
		$row.append('<td>'+gameList[i].title+'</td>');
		$row.append('<td>'+gameList[i].release_date+'</td>');
		$row.append('<td>'+gameList[i].genre+'</td>');
		$table.append($row);
	}
	
	$('#game_table').tablesorter({
		headers: {
			1: { sorter: 'isoDate' }
		}
	});

});