<?php

function isLogin(){
    $ci =& get_instance();
    $user_session = $ci->session->userdata('id');
    if ($user_session){
        redirect('dashboard');
    }
}

function isLogout(){
    $ci =& get_instance();
    $user_session = $ci->session->userdata('id');
    if(!$user_session){
        redirect('auth');
    }
}