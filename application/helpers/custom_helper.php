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

function activeCurrency()
{
    $ci =& get_instance();
    return $ci->db->get_where('lq_currencies', array('isActive' => 'y'))->row();
}

function activeRate()
{
    $ci =& get_instance();
    return $ci->db->get('lq_rates')->row()->rate_value;
}


