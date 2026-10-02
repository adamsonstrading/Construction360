<?php
// SMTP authentication test — STARTTLS (port 587)
$host     = 'smtp.ionos.co.uk';
$port     = 587;
$username = 'no-reply@construction360.co';
$password = 'Tacco@1234';

echo "Testing SMTP connection to {$host}:{$port} (STARTTLS)...\n\n";

// 1. TCP connection
$socket = @fsockopen($host, $port, $errno, $errstr, 10);
if (!$socket) {
    die("❌ FAILED — Cannot connect to {$host}:{$port}\n   Error: [{$errno}] {$errstr}\n");
}
echo "✅ TCP connection established\n";

$greeting = fgets($socket, 515);
echo "   Server: " . trim($greeting) . "\n\n";

// EHLO
fwrite($socket, "EHLO testclient\r\n");
while ($line = fgets($socket, 515)) {
    if (substr($line, 3, 1) === ' ') break;
}
echo "✅ EHLO accepted\n";

// STARTTLS
fwrite($socket, "STARTTLS\r\n");
$tls = fgets($socket, 515);
echo "   STARTTLS: " . trim($tls) . "\n";

if (strpos($tls, '220') === false) {
    die("❌ STARTTLS not supported or rejected\n");
}

// Upgrade to TLS
stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
echo "✅ TLS encryption enabled\n";

// Re-EHLO after TLS
fwrite($socket, "EHLO testclient\r\n");
while ($line = fgets($socket, 515)) {
    if (substr($line, 3, 1) === ' ') break;
}

// AUTH LOGIN
fwrite($socket, "AUTH LOGIN\r\n");
$authResp = fgets($socket, 515);
echo "\n   AUTH LOGIN: " . trim($authResp) . "\n";

fwrite($socket, base64_encode($username) . "\r\n");
$userResp = fgets($socket, 515);
echo "   Username sent: " . trim($userResp) . "\n";

fwrite($socket, base64_encode($password) . "\r\n");
$passResp = fgets($socket, 515);
echo "   Password response: " . trim($passResp) . "\n\n";

if (strpos($passResp, '235') !== false) {
    echo "✅ AUTHENTICATION SUCCESSFUL — SMTP credentials are correct!\n";
} elseif (strpos($passResp, '535') !== false) {
    echo "❌ AUTHENTICATION FAILED — Password is incorrect.\n";
    echo "   Please verify credentials in your IONOS control panel.\n";
} else {
    echo "⚠️  Unexpected response: " . trim($passResp) . "\n";
}

fwrite($socket, "QUIT\r\n");
fclose($socket);
