<?php

function dd($data)
{
	echo '<pre>';
	print_r($data);
	die();
}

function isLoggedIn()
{
	$ci =& get_instance();
	$user_data = (object)$ci->session->userdata('logged_in');
	if (!empty($user_data)) {
		return true;
	} else {
		return false;
	}
}

function userSessData()
{
	$ci =& get_instance();
	return (object)$ci->session->userdata('logged_in');
}


