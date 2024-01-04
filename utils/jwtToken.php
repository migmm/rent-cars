<?php

$dotenv = parse_ini_file(__DIR__ . '/../.env');

$secretKey = $dotenv['SECRET_KEY'];
$encryptionKey = $dotenv['ENCRYPTION_KEY'];


/*
 *
 * Usage
 * generateAndSetCookie($userData, $secretKey, $encryptionKey);
 *
*/

function generateAndSetCookie($userData, $secretKey, $encryptionKey)
{
    echo $secretKey;
    echo $encryptionKey;
    
    $jwt = jwt_encode($userData, $secretKey);
    setcookie(
        'jwt_cookie',
        encryptCookie(
            $jwt,
            $encryptionKey
        ),
        time() + 86400,  // 24h in seconds
        '/',
        '',
        false,
        true
    );
}

function encryptCookie($data, $encryptionKey)
{
    $key = substr(hash('sha256', $encryptionKey, true), 0, 32);

    $iv = openssl_random_pseudo_bytes(16);
    $encryptedData = openssl_encrypt(
        $data,
        'aes-256-cbc',
        $key,
        0,
        $iv
    );
    $encryptedCookie = base64_encode($iv . $encryptedData);
    return $encryptedCookie;
}

function jwt_encode($data, $key)
{
    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
    $payload = json_encode($data);
    
    $base64UrlHeader = base64_encode($header);
    $base64UrlPayload = base64_encode($payload);

    $signature = hash_hmac('sha256', $base64UrlHeader . '.' . $base64UrlPayload, $key, true);
    $base64UrlSignature = base64_encode($signature);

    return $base64UrlHeader . '.' . $base64UrlPayload . '.' . $base64UrlSignature;
}

function jwt_decode($token, $key)
{
    $tokenParts = explode('.', $token);

    if (count($tokenParts) === 3) {
        $header = json_decode(base64_decode($tokenParts[0]), true);
        $payload = json_decode(base64_decode($tokenParts[1]), true);
        $signature = base64_decode($tokenParts[2]);

        if ($header !== null && $payload !== null && isset($header['alg']) && $header['alg'] === 'HS256') {
            $rawSignature = hash_hmac('sha256', $tokenParts[0] . '.' . $tokenParts[1], $key, true);

            if (hash_equals($signature, $rawSignature)) {
                return $payload;
            } else {
                echo "Error: Invalid signature.<br>";
            }
        } else {
            echo "Error: Can't decode payload or signature is invalid<br>";
        }
    } else {
        echo "Error: Unexpected token format.<br>";
    }

    return false;
}

function decryptCookie($data, $encryptionKey)
{
    $key = substr(hash('sha256', $encryptionKey, true), 0, 32);
    echo "Decode key: " . base64_encode($key) . "<br>";

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

    if ($decryptedData === false) {
        echo "Error decoding cookie: " . openssl_error_string() . "<br>";
        return false;
    }

    return $decryptedData;
}

function getCookie($secretKey, $encryptionKey)
{
    if (isset($_COOKIE['jwt_cookie'])) {
        $encryptedToken = $_COOKIE['jwt_cookie'];
        
        echo "Encrypted Token: " . $encryptedToken . "<br>";

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

function clean_cookie()
{
    setcookie(
        'jwt_cookie',
        '',
        time() - 3600,
        '/',
        '',
        false,
        true
    );
}


getCookie($secretKey, $encryptionKey);

?>