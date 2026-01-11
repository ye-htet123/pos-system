<?php
$token = $_GET['token'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reset Password</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background: #f0f2f5;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .card {
      background: #fff;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      width: 100%;
      text-align: center;
    }

    .card h2 {
      margin-bottom: 1rem;
      color: #333;
    }

    input[type="password"] {
      width: 92%;
      padding: 12px;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 1rem;
    }

    button[type="submit"] {
      width: 100%;
      padding: 12px;
      background: #28a745;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
      transition: background 0.3s;
    }

    button[type="submit"]:hover {
      background: #218838;
    }

    .error {
      color: red;
      font-size: 1.1rem;
    }
  </style>
</head>
<body>

<div class="card">
  <?php if ($token): ?>
    <h2>Set New Password</h2>
    <form method="POST" action="reset_password_submit.php">
      <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
      <input type="password" name="new_password" placeholder="New Password" required>
      <button type="submit">Reset Password</button>
    </form>
  <?php else: ?>
    <p class="error">Token missing.</p>
  <?php endif; ?>
</div>

</body>
</html>
