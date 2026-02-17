<?php
$client_id = "client id";
$redirect_uri = "http://localhost/WT-XAMPP/github-oauth/github_callback.php";

$url = "https://github.com/login/oauth/authorize?" . http_build_query([
    "client_id" => $client_id,
    "redirect_uri" => $redirect_uri,
    "scope" => "user",
    "state" => bin2hex(random_bytes(16))
]);

header("Location: $url");
exit();
