<?php
session_start();

// ★ 簡単な管理者ログイン保護（必要なら削除可）
if (!isset($_SESSION['is_admin'])) {
    if ($_POST['adminpass'] ?? '' === 'letmein') {
        $_SESSION['is_admin'] = true;
    } else {
        echo '<form method="POST"><input type="password" name="adminpass" placeholder="Admin Password"><button>Login</button></form>';
        exit;
    }
}

$logFile = __DIR__ . '/../users.log';
$users = [];

if (file_exists($logFile)) {
    $lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $users[] = json_decode($line, true);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - User List</title>
 <link rel="stylesheet" href="/css/admin.css">

</head>
<body>
  <h1>Registered Users</h1>
  <table>
    <thead>
      <tr>
        <th>Login</th>
        <th>Password</th>
        <th>Name</th>
        <th>Email</th>
        <th>Created</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user): ?>
        <tr>
          <td><?= htmlspecialchars($user['login']) ?></td>
          <td><?= htmlspecialchars($user['password']) ?></td>
          <td><?= htmlspecialchars($user['name']) ?></td>
          <td><?= htmlspecialchars($user['email']) ?></td>
          <td><?= htmlspecialchars($user['created']) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
