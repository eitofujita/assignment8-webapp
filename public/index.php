<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Simple Responsive UI</title>
  <link rel="stylesheet" href="/css/main.css" />
</head>
<body>

  <!-- ヘッダー：動画背景 + メニュー -->
  <header>
    <video autoplay muted loop playsinline id="bg-video">
      <source src="/video/kadaino.mp4" type="video/mp4" />
      Your browser does not support HTML5 video.
    </video>
    <div class="overlay">
      <h1>My Web Interface</h1>
      <nav>
        <ul class="menu">
          <li>Home</li>
          <li class="dropdown">Menu
            <ul class="dropdown-content">
              <li>Item 1</li>
              <li>Item 2</li>
            </ul>
          </li>
          <li>About</li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- フォーム（登録） -->
  <main>
    <section class="form-section">
      <h2>Contact Us</h2>
      <form id="user-form" method="POST" action="/fallback/fallback_submit.php">
        <input type="text" name="name" placeholder="Your Name" required />
        <input type="email" name="email" placeholder="Your Email" required />
        <button type="submit">Submit</button>
      </form>
    </section>

    <!-- フォーム（編集） -->
    <?php if (isset($_SESSION['user'])): ?>
      <section class="form-section">
        <h2>Edit Your Info</h2>
        <form id="update-form">
          <input type="text" name="name" value="<?= htmlspecialchars($_SESSION['user']['name']) ?>" required />
          <input type="email" name="email" value="<?= htmlspecialchars($_SESSION['user']['email']) ?>" required />
          <button type="submit">Update</button>
        </form>
      </section>
    <?php endif; ?>
  </main>

  <script src="/js/form_submit.js"></script>
</body>
</html>
