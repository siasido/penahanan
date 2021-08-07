<?php

function isLogin(){
    $ci =& get_instance();
    $user_session = $ci->session->userdata('userid');
    $role = $ci->session->userdata('role');
    if($user_session && ($role == 1)){
        redirect('dashboard/dashboardadmin');
    } 
    if($user_session && ($role == 2)){
        redirect('dashboard');
    } 
}

function isLogout(){
    $ci =& get_instance();
    $user_session = $ci->session->userdata('userid');
    if(!$user_session){
        redirect('auth');
    }
}