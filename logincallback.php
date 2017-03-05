<?php

require(__DIR__ . '/sdk/src/Facebook/autoload.php');
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
try {
    $accessToken = $helper->getAccessToken();
    echo "<br>success<br>";
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (isset($accessToken)) {
    // Logged in!
    $_SESSION['facebook_access_token'] = (string) $accessToken;
    $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    echo "<br>access token is set<br>";
    // Now you can redirect to another page and use the
    // access token from $_SESSION['facebook_access_token']
}

try {
    $user = $fb->get('/me');
    $user = $user->getGraphNode()->asArray();
    echo "<pre>";
    print_r($user);
    echo "</pre>";
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    echo "<br><br><br>--------<br>line 45";
    session_destroy();
    // if access token is invalid or expired you can simply redirect to login page using header() function
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    echo "<br><br><br>--------<br>line 52";
    exit;
}

$keyword = "t-shirts";
$search = $fb->get('/search?q=' . $keyword . '&type=page&limit=1000');
$search = $search->getGraphEdge()->asArray();
echo "<pre>";
print_r($search);
echo "</pre>";
