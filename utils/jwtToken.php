<?php

$dotenv = parse_ini_file(__DIR__ . '/../.env');

$secretKey = $dotenv['SECRET_KEY'];
$encryptionKey = $dotenv['ENCRYPTION_KEY'];


function generateAndSetCookie($userData, $secretKey, $encryptionKey)
{
    $jwt = jwt_encode($userData, $secretKey);
    setcookie(
        'jwt_cookie',
        encryptCookie(
            $jwt,
            $encryptionKey
        ),
        0,
        '/',
        '',
        true,
        true
    );
}

//generateAndSetCookie($userData, $secretKey, $encryptionKey);

function encryptCookie($data, $key)
{
    $iv = openssl_random_pseudo_bytes(16);
    $encryptedData = openssl_encrypt(
        $data,
        'aes-256-cbc',
        $key,
        0,
        $iv
    );
    $encryptedCookie = base64_encode(
        $iv .
            $encryptedData
    );
    return $encryptedCookie;
}

function jwt_decode($token, $key)
{
    $tokenParts = explode('.', $token);

    if (count($tokenParts) === 3) {
        $header = json_decode(base64_decode($tokenParts[0]), true);
        $payload = json_decode(base64_decode($tokenParts[1]), true);
        $signature = base64_decode($tokenParts[2]);

        if ($header !== null && $payload !== null) {
            $rawSignature = hash_hmac(
                'sha256',
                $tokenParts[0] . '.' . $tokenParts[1],
                $key,
                true
            );

            if (hash_equals($signature, $rawSignature)) {
                return $payload;
            }
        }
    }

    return false;
}

function decryptCookie($data, $encryptionKey)
{
    $key = $encryptionKey;
    $data = base64_decode($data);

    $iv = substr($data, 0, 16);
    $encryptedData = substr($data, 16);

    $decryptedData = openssl_decrypt(
        $encryptedData,
        'aes-256-cbc',
        $key,
        0,
        $iv
    );

    return $decryptedData;
}

function getCookie($secretKey, $encryptionKey)
{
    if (isset($_COOKIE['jwt_cookie'])) {
        $encryptedToken = $_COOKIE['jwt_cookie'];
        $decryptedToken = decryptCookie($encryptedToken, $encryptionKey);

        echo "Decrypted Token: " . $decryptedToken . "<br>";

        $decodedToken = jwt_decode($decryptedToken, $secretKey);

        echo "Decoded Token: ";
        print_r($decodedToken);

        if ($decodedToken !== false) {
            echo "ID: " . $decodedToken['id'] . "<br>";
            echo "Username: " . $decodedToken['username'] . "<br>";
            echo "Role: " . $decodedToken['role'] . "<br>";
        } else {
            echo "Error decoding token.";
        }
    } else {
        echo "Cookie not found.";
    }
}

function jwt_encode($data, $key)
{
    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
    $payload = json_encode($data);
    $base64UrlHeader = str_replace(
        ['+', '/', '='],
        ['-', '_', ''],
        base64_encode($header)
    );
    $base64UrlPayload = str_replace(
        ['+', '/', '='],
        ['-', '_', ''],
        base64_encode($payload)
    );
    $signature = hash_hmac(
        'sha256',
        $base64UrlHeader . '.' . $base64UrlPayload,
        $key,
        true
    );
    $base64UrlSignature = str_replace(
        ['+', '/', '='],
        ['-', '_', ''],
        base64_encode($signature)
    );
    return $base64UrlHeader . '.' . $base64UrlPayload . '.' . $base64UrlSignature;
}

function clean_cookie()
{
    setcookie(
        'jwt_cookie',
        '',
        time() - 3600,
        '/',
        '',
        true,
        true
    );
}

getCookie($secretKey, $encryptionKey);

?>