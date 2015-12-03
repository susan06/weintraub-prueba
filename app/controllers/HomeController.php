<?php

class HomeController extends BaseController { 
	/**
	 *
	 * @return View
	 */
	public function getIndex()
	{
		return View::make('login');
	}

	public function getHome() 
	{
		if (Auth::check()) { 

			return View::make('dashboard/home');
			
		}else{
			
			list($user,$redirect) = $this->user->checkAuthAndRedirect('user');
			if($redirect){return $redirect;}
			
		}
		
	}
}
