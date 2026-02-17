<?php
require_once __DIR__ . '/vendor/autoload.php';

$client = new Google_Client();
$client->setClientId("client id");
$client->setClientSecret("client secret");
$client->setRedirectUri("http://localhost/WT-XAMPP/OAUTH/callback.php");
$client->addScope("email");
$client->addScope("profile");

$authUrl = $client->createAuthUrl();
header("Location: " . $authUrl);
exit();