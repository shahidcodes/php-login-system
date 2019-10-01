<?php

class Captcha {
	private static $_capError = false;

	public static function get($name)
	{
		return Session::get($name);
	}

	public static function check($value)
	{
		if (Session::exists('secure')) {
			if ($value == Session::get('secure')) {
				return true;
			}else{
				self::$_capError = true;
			}
		}
		//return false;
	}

	public static function error()
	{
		return self::$_capError;
	}
}