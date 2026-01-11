<?php
require 'config/function.php';

if (isset($_POST['loginBtn'])) {
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $remember = isset($_POST['remember']); // true/false

    if ($email != '' && $password != '') {
        $query = "SELECT * FROM admins WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['password'];

            // ✅ 1. Check password
            if (!password_verify($password, $hashedPassword)) {
                redirect('login.php', 'Invalid Password');
            }

            // ✅ 2. Check ban
            if ($row['is_ban'] == 1) {
                redirect('login.php', 'Your account has been banned. Contact your admin!');
            }

            // ✅ 3. If Remember Me checked
            if ($remember) {
                $token = bin2hex(random_bytes(32));

                $update = $conn->prepare("UPDATE admins SET remember_token=? WHERE email=?");
                $update->bind_param("ss", $token, $email);
                $update->execute();

                setcookie("remember_token", $token, time() + (86400 * 30), "/", "", false, true);
            }

            // ✅ 4. Create session AFTER validation
            $_SESSION['loggedIn'] = true;
            $_SESSION['loggedInUser'] = [
                'user_id' => $row['id'],
                'name'    => $row['name'],
                'email'   => $row['email'],
                'phone'   => $row['phone']
            ];

            redirect('admin/index.php', 'Logged In Successfully 🎉');

        } else {
            redirect('login.php', 'Invalid Email Address!');
        }
    } else {
        redirect('login.php', 'All fields are mandatory');
    }
}
?>
