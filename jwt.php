<?php
require 'vendor/autoload.php';
use \Firebase\JWT\JWT;

function generate_jwt($user) {
    $key = "your_secret_key";
    $payload = array(
        "iss" => "http://localhost",
        "aud" => "http://localhost",
        "iat" => time(),
        "nbf" => time(),
        "data" => [
            "id" => $user['id'],
            "username" => $user['username']
        ]
    );

    $jwt = JWT::encode($payload, $key, 'HS256');
    return $jwt;
}
?>
