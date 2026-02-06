<?php
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(400); exit('{"ok":false}'); }

$name    = trim($_POST['name']    ?? '');
$email   = trim($_POST['email']   ?? '');
$message = trim($_POST['message'] ?? '');

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $name === '' || $message === '') {
    http_response_code(422); exit('{"ok":false}');
}

$to      = "tejas.k.gade@gmail.com";   // ← your mailbox
$subject = "New Contact Form – Propellence";
$body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";
$headers = "From: $name <$email>";

$ok = mail($to, $subject, $body, $headers);
echo $ok ? '{"ok":true}' : '{"ok":false}';
?>