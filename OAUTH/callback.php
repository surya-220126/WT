
<?php
require_once __DIR__ . '/vendor/autoload.php';

$client = new Google_Client();
$client->setClientId("your client here");
$client->setClientSecret("your client secret");
$client->setRedirectUri("http://localhost/WT-XAMPP/OAUTH/callback.php");

if (!isset($_GET['code'])) {
    die("Authentication failed");
}

$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

if (isset($token['error'])) {
    die("Error: " . $token['error']);
}

$client->setAccessToken($token['access_token']);

$service = new Google_Service_Oauth2($client);
$user = $service->userinfo->get();

$name = $user->name;
$email = $user->email;
$picture = $user->picture;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Callback Page</title>
    <style>
        body {
            font-family: Arial;
            background: #e8f0fe;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .box {
            background: white;
            padding: 25px;
            text-align: center;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Callback Page</h2>
    <img src="<?= $picture ?>" width="100"><br><br>
    <b>Name:</b> <?= $name ?><br>
    <b>Email:</b> <?= $email ?><br><br>
    <p>Your callback request has been received.<br>
    Our support team will contact you soon.</p>
</div>

</body>
</html>

