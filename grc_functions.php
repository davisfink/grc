<?php
class Game
{
	public function __construct()
	{
		$title = '';
		$release_date = '';
		$genre = '';
	}
}


function update_game_list() {
	
	$data = file_get_contents('dummy.html');
	$html = new simple_html_dom();
	$html -> load($data);
	$change_count = 0;

	$element = $html->find('tr');
	array_shift($element);
	foreach($element as $game){
		//getting the information from the game. Title / Release Date / Genre
		$game_info = $game->find('td');
		$temp_game = new Game();
		$temp_game->$title        = trim(strip_tags($game_info[0]));
		$temp_game->$release_date = trim(strip_tags($game_info[3]));
		$temp_game->$genre        = trim(strip_tags($game_info[2]));

		
		$result = mysql_query('SELECT * from games where title = "'. $temp_game->$title.'"');
		$exists = (bool)mysql_fetch_array($result);
		if(!$exists)
		{
			mysql_query('INSERT into games (title, release_date, genre) 
			VALUES ("' .$temp_game->$title.'","'.$temp_game->$release_date.'","'.$temp_game->$genre.'")');
			$change_count++;
		}
		else
		{
			$result = mysql_query('SELECT * from games 
			where title = "'.$temp_game->$title.'" AND 
			release_date = "'.$temp_game->$release_date.'" AND 
			genre = "'.$temp_game->$genre.'"');
			$exists = (bool)mysql_fetch_array($result);
				
			if(!$exists)
			{
				mysql_query('UPDATE games SET release_date = "'.$temp_game->$release_date.'", genre = "'.$temp_game->$genre.'"
				WHERE title ="'.$temp_game->$title.'"');
				$change_count++;
			}
		}
	}
	return 'The list has been updated.<br>There were '.$change_count.' changes';
}

function get_game_list(){
	$result = mysql_query('SELECT * from games');
	$game_list = array();
	while($temp_game = mysql_fetch_object($result,'Game'))
	{
		$game_list[] = $temp_game;
	}
	return json_encode($game_list);
	// return $game_list;
}