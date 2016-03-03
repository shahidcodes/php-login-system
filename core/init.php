<?php
session_start();
header('X-Frame-Options : DENY') ;
$GLOBALS['config'] = array(
	'mysql' => array(
		'host' => '127.0.0.1',
		'username' => 'db_user',
		'password' => 'db_pass',
		'db' => 'db_name'
		),
	'remember' => array(
		'cookie_name' => 'hash',
		'cookie_expiry' => 604800
		),
	'session' => array(
		'session_name' => 'user',
		'token_name'	=> 'token'
		)
	);
function my_auto_loader($class){
	require_once 'classes/'. $class .'.php';
}
spl_autoload_register('my_auto_loader');
require_once 'functions/sanitize.php';
$cookie_name = Config::get('remember/cookie_name');
if (Cookie::exists($cookie_name) && !Session::exists(Config::get('session/session_name'))) {
	//check cookie hash == to that stored in db
	$hash = Cookie::get($cookie_name);
	$checkHash = DB::getinstance()->get('users_session', array('hash', '=', $hash));
	if ($checkHash->count()) {
		$user = new User($checkHash->first()->user_id);
		$user->login();
	}
}
