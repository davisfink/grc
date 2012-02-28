$(function() {
	$('#game_table').tablesorter({
		sortList: [[1,0]],
		headers: {
			1: { sorter: 'isoDate' }
		}
	});
	
	$('input#search').quicksearch('#game_table tbody tr');
});

