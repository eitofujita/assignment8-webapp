<?php
session_start(); // セッション開始
header('Content-Type: application/json');

// 入力をJSONで受け取る
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data || !isset($data['name']) || !isset($data['email'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid input']);
    exit;
}

// 仮のランダムログイン情報生成（DB保存はまだ）
$login = 'user' . rand(1000, 9999);
$password = bin2hex(random_bytes(4)); // 8桁のパスワード
$profileUrl = '/profile/' . $login;

// ✅ セッションに保存
$_SESSION['user'] = [
    'login' => $login,
    'password' => $password,
    'name' => $data['name'],
    'email' => $data['email'],
];

// レスポンスとしてログイン情報とURLを返す
echo json_encode([
    'login' => $login,
    'password' => $password,
    'profile_url' => $profileUrl
]);

file_put_contents(
  __DIR__ . '/../../users.log',
  json_encode([
    'login' => $login,
    'password' => $password,
    'name' => $data['name'],
    'email' => $data['email'],
    'created' => date('c')
  ]) . PHP_EOL,
  FILE_APPEND
);
