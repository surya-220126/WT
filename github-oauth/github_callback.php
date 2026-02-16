<?php
session_start();

$client_id = "client id";
$client_secret = "client secret";

// Check if code is present
if (!isset($_GET['code'])) {
    die("Error: No authorization code received from GitHub.");
}

$code = $_GET['code'];

// Exchange code for access token using cURL
$token_url = "https://github.com/login/oauth/access_token";
$data = [
    "client_id" => $client_id,
    "client_secret" => $client_secret,
    "code" => $code
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $token_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Accept: application/json",
    "User-Agent: PHP-GitHub-OAuth"
]);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curl_error = curl_error($ch);
curl_close($ch);

if (!$response || $curl_error) {
    die("Error: Could not communicate with GitHub. " . $curl_error);
}

$result = json_decode($response, true);

if (!isset($result['access_token'])) {
    die("Error: Could not obtain access token. " . ($result['error_description'] ?? "Unknown error") . " Response: " . json_encode($result));
}

$access_token = $result['access_token'];

// Fetch user data using cURL
$user_url = "https://api.github.com/user";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $user_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "User-Agent: PHP-GitHub-OAuth",
    "Authorization: token $access_token",
    "Accept: application/vnd.github.v3+json"
]);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$user_response = curl_exec($ch);
$curl_error = curl_error($ch);
curl_close($ch);

if (!$user_response || $curl_error) {
    die("Error: Could not fetch user data from GitHub. " . $curl_error);
}

$user_data = json_decode($user_response, true);

if (!isset($user_data['login'])) {
    die("Error: Invalid user data received from GitHub. Response: " . json_encode($user_data));
}

// Store user info in session
$_SESSION['github_user'] = $user_data['login'];
$_SESSION['github_avatar'] = $user_data['avatar_url'] ?? null;
$_SESSION['github_id'] = $user_data['id'];
$_SESSION['github_name'] = $user_data['name'] ?? null;

header("Location: dashboard.php");
exit();
