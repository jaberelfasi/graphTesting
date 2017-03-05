<html><h1>hello graph!</h1></html>
<?php
require(__DIR__.'/sdk/src/Facebook/autoload.php');
session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$fb = new Facebook\Facebook([
    'app_id' => '1894973377401643',
    'app_secret' => '5b72386b596bbc3a38fb5132fa85d75e',
    'default_graph_version' => 'v2.8'
        ]);

$helper = $fb->getRedirectLoginHelper();
$permissions = [];//e.g: $permissions = ['email', 'user_likes'];
$loginUrl = $helper->getLoginUrl('http://sandbox.dev:8080/graphTesting/logincallback.php', $permissions);
//echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
header('Location: '.$loginUrl);
//get user from facebook object

