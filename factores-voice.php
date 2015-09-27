<?php
session_start();
include 'Services/Twilio.php';
include 'config.php';
include 'functions.php';
$username = cleanVar('username');
$password = cleanVar('password');
$phoneNum = cleanVar('phone_number');
if( isset($_POST['action']) ){
if( isset($_POST['username']) &&
isset($_POST['phone_number'])
){
$message = user_generate_token($username,
$phoneNum,'calls');
}else if( isset($_POST['username']) &&
isset($_POST['password']) ){
$message = user_login($username, $password);
}
header("Location: two-factor-voice.php?message=" .
urlencode($message));
