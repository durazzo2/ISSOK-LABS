<?php

const JWT_SECRET = '694e25ed320b30df7b5c9571baab0a52d2f0878ae064ea376e3fd77ec70a237f';

function base64UrlEncode(string $data): string {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64UrlDecode(string $data): string {
    return base64_decode(strtr($data, '-_', '+/'));
}

function generateJWT(int $userId, int $ttlSeconds = 3600): string {
    $header = ['alg' => 'HS256', 'typ' => 'JWT'];
    $payload = [
        'sub' => $userId,
        'iat' => time(),
        'exp' => time() + $ttlSeconds
    ];

    $headerEnc  = base64UrlEncode(json_encode($header));
    $payloadEnc = base64UrlEncode(json_encode($payload));
    $signature  = hash_hmac('sha256', $headerEnc . '.' . $payloadEnc, JWT_SECRET, true);
    $sigEnc     = base64UrlEncode($signature);

    return $headerEnc . '.' . $payloadEnc . '.' . $sigEnc;
}

function decodeJWT(string $token) {
    $parts = explode('.', $token);
    if (count($parts) !== 3) {
        return false;
    }

    [$h, $p, $s] = $parts;

    $expectedSig = base64UrlEncode(
        hash_hmac('sha256', $h . '.' . $p, JWT_SECRET, true)
    );

    if (!hash_equals($expectedSig, $s)) {
        return false;
    }

    $payload = json_decode(base64UrlDecode($p), true);
    if (!is_array($payload)) {
        return false;
    }

    if (isset($payload['exp']) && time() > $payload['exp']) {
        return false;
    }

    return $payload;
}

function require_login(): int {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['jwt'])) {
        $_SESSION['error'] = "Немате пристап.";
        header("Location: pages/auth/login.php");
        exit;
    }

    $payload = decodeJWT($_SESSION['jwt']);
    if ($payload === false) {
        $_SESSION['error'] = "Немате пристап.";
        header("Location: pages/auth/login.php");
        exit;
    }

    return (int)($payload['sub'] ?? 0);
}
