<?php
require_once __DIR__ . '/vendor/autoload.php';

$client = new Google_Client();
$client->setClientId("278127621826-11urhseoaku0ruv5smd23phpv327mg9p.apps.googleusercontent.com");
$client->setClientSecret("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");
$client->setRedirectUri("http://localhost/WT-XAMPP/OAUTH/callback.php");
$client->addScope("email");
$client->addScope("profile");

$authUrl = $client->createAuthUrl();
header("Location: " . $authUrl);
exit();
