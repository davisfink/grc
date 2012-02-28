<?php

class Repo {
	
	public static function find_all()
	{
		$request = DB::query('select * from games');
		$games_list;

		foreach ($request as $item) {
			$item->release_date = date('M d, Y',strtotime($item->release_date));
			$games_list[] = $item;
			
		}
		 return $games_list;
	}
}
