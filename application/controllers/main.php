<?php

class Main_Controller extends Base_Controller {

	public function action_index()
	{
		$view_data = Game::all();
		return View::make('main.index', array('games' => $view_data));
	}
}