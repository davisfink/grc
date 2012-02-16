<?php
date_default_timezone_set('America/New_York');
class Game
{
	public function __construct()
	{
		$this->title = '';
		$this->release_date = '';
		$this->genre = '';
	}
}

function update_game_list() {
	$data = file_get_contents('http://xbox360.gamespy.com/index/release.html?constraint.year.game.release_date=2012&constraint.return_all=is_true');
	$html = new simple_html_dom();
	$html -> load($data);
	$change_list = array();

	$element = $html->find('tr');
	array_shift($element);
	foreach($element as $game){
		//getting the information from the game. Title / Release Date / Genre
		$game_info = $game->find('td');
		$temp_game = new Game();
		$temp_game->title        = trim(strip_tags($game_info[0]));
		$temp_game->genre        = trim(strip_tags($game_info[2]));
		$temp_game->release_date = convert_date(trim(strip_tags($game_info[3])));
		
		if(!$temp_game->release_date) break;
		
		$result = mysql_query('SELECT * from games where title = "'. $temp_game->title.'"');
		$exists = (bool)mysql_fetch_array($result);
		if(!$exists)
		{
			mysql_query('INSERT into games (title, release_date, genre) 
			VALUES ("' .$temp_game->title.'","'.$temp_game->release_date.'","'.$temp_game->genre.'")');
			$change_list[] = $temp_game;
		}
		else
		{
			$result = mysql_query('SELECT * from games 
			where title = "'.$temp_game->title.'" AND 
			release_date = "'.$temp_game->release_date.'" AND 
			genre = "'.$temp_game->genre.'"');
			$exists = (bool)mysql_fetch_array($result);
				
			if(!$exists)
			{
				mysql_query('UPDATE games SET release_date = "'.$temp_game->release_date.'", genre = "'.$temp_game->genre.'"
				WHERE title ="'.$temp_game->title.'"');
				$change_list[] = $temp_game;
			}
		}
	}
	echo 'The list has been updated.<br>There were '.count($change_list).' changes.<br><br>';
	foreach ($change_list as $item)
	{
		echo 'Title: '.$item->title.'<br>';
		echo 'Release Date: '.$item->release_date.'<br>';
		echo 'Genre: '.$item->genre;
		echo '<br><br>';
	}

}

function get_game_list(){
	$result = mysql_query('SELECT * from games');
	$game_list = array();
	while($temp_game = mysql_fetch_assoc($result))
	{
		$temp_game['release_date'] = date('M d, Y',strtotime($temp_game['release_date']));
		$game_list[] = $temp_game;
	}
	return json_encode($game_list);
}

function convert_date($date) {
	if($mysql_date = strtotime($date))
	{
		return date('Y-m-d' ,$mysql_date);
	}
	switch ($date) {
		case 'Q1 2012':
		return '2012-02-15';
		break;
		
		case 'Q2 2012':
		return '2012-05-15';
		break;
		
		case 'Q3 2012':
		return '2012-08-15';
		break;
		
		case 'Q4 2012':
		return '2012-11-15';
		break;
		
		case 'TBA 2012': default:
		return false;
		break;
	}
}