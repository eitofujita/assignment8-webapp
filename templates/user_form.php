<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Assignment 8 Form</title>
  <link rel="stylesheet" href="/css/main.css">
</head>
<body>
  <h1>User Registration Form</h1>
  
  <form id="user-form" method="POST" action="/fallback/fallback_submit.php">
    <label>Name: <input type="text" name="name" required></label><br>
    <label>Email: <input type="email" name="email" required></label><br>
    <button type="submit">Submit</button>
  </form>

  <?php if (isset($_SESSION['user'])): ?>
    <hr>
    <h2>Update Your Information</h2>
    <form id="update-form">
      <label>New Name: <input type="text" name="name" value="<?php echo htmlspecialchars($_SESSION['user']['name']); ?>" required></label><br>
      <label>New Email: <input type="email" name="email" value="<?php echo htmlspecialchars($_SESSION['user']['email']); ?>" required></label><br>
      <button type="submit">Update</button>
    </form>
  <?php endif; ?>

  <script src="/js/form_submit.js"></script>
</body>
</html>
