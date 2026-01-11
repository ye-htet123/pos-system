 

  <?php include('includes/header.php');
  
  if(isset($_SESSION['loggedIn'])){

   ?>
   <script>window.location.href='index.php';</script>

   <?php
  }
  ?>



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --dark: #2b2d42;
            --light: #f8f9fa;
            --danger: #e63946;
            --warning: #ffaa00;
            --gray: #8d99ae;
        }

        body {
            background: linear-gradient(135deg, #f0f4f8 0%, #e6e9ff 100%);
            min-height: 100vh;
            color: var(--dark);
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
        }

        

        .btn {
            padding: 0.6rem 1.2rem;
            border-radius: 4px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: white;
            color: var(--primary);
        }

        .btn-primary:hover {
            background: #f0f0f0;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Auth Container */
        .auth-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 1;
            padding: 2rem;
        }

        .auth-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 450px;
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .card-header {
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .card-header h2 {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .card-header p {
            opacity: 0.9;
        }

        .card-body {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--dark);
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
        }

        .form-control {
            width: 100%;
            padding: 0.8rem 1rem 0.8rem 40px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
            outline: none;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .remember input {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .forgot-password {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .btn-block {
            display: block;
            width: 100%;
            padding: 1rem;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: var(--gray);
            margin: 1.5rem 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #ddd;
        }

        .divider::before {
            margin-right: 1rem;
        }

        .divider::after {
            margin-left: 1rem;
        }

        .social-login {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .social-btn {
            flex: 1;
            padding: 0.8rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .social-btn.google {
            background: #fff;
            border: 1px solid #ddd;
            color: #444;
        }

        .social-btn.google:hover {
            background: #f8f9fa;
        }

        .social-btn.facebook {
            background: #3b5998;
            color: white;
            border: none;
        }

        .social-btn.facebook:hover {
            background: #344e86;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 2rem;
            color: var(--gray);
            border-top: 1px solid #eee;
            background: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 1rem;
            }

            .nav-links {
                margin: 1rem 0;
                flex-wrap: wrap;
                justify-content: center;
            }

            .auth-container {
                padding: 1rem;
            }

            .card-header {
                padding: 1.5rem;
            }

            .card-body {
                padding: 1.5rem;
            }

            .social-login {
                flex-direction: column;
            }
        }

        /* Login-specific enhancements */
      
        
        .password-container {
            position: relative;
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--gray);
        }
    </style>
</head>

<body>
   

    <!-- Auth Container -->
      <?php alertMessage();?>
    <div class="auth-container">
        <div class="auth-card">
            <div class="card-header">
                <h2>Welcome to RetailPro POS</h2>
                <p>Sign in to access your business dashboard</p>
            </div>

            <div class="card-body">
              
                <!-- Login Form -->
                <form class="auth-form" action="login-code.php" method="POST" >
                    <div class="form-group">
                        <label for="login-email">Email Address</label>
                        <div class="input-group">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="email" id="login-email" class="form-control" placeholder="Enter your email"
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="login-password">Password</label>
                        <div class="input-group password-container">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password"  id="login-password" class="form-control"
                                placeholder="Enter your password" required>
                            <span class="password-toggle" id="password-toggle">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <div class="remember-forgot">
                        <div class="remember">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Remember me</label>
                        </div>
                        <a href="password_reset_phpmailer/reset_form.html" class="forgot-password">Forgot Password?</a>
                    </div>

                    <button type="submit" name="loginBtn" class="btn btn-primary btn-block">
                        <i class="fas fa-sign-in-alt"></i> Login to Dashboard
                    </button>

                    <div class="divider">Or continue with</div>

                    <div class="social-login">
                        <div class="social-btn google" id="google-login">
                            <i class="fab fa-google"></i> Google
                        </div>
                        <div class="social-btn facebook" id="facebook-login">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>RetailPro POS System &copy; 2023 | Secure Point of Sale Solution</p>
        <p>Need help? Contact support@retailpro.com or call (800) 123-4567</p>
    </div>
<?php
    echo "Hello, world!";
?>

<script>
        document.addEventListener('DOMContentLoaded', function () {
            // Password visibility toggle
            const passwordToggle = document.getElementById('password-toggle');
            const passwordInput = document.getElementById('login-password');
            
            passwordToggle.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    passwordToggle.innerHTML = '<i class="fas fa-eye-slash"></i>';
                } else {
                    passwordInput.type = 'password';
                    passwordToggle.innerHTML = '<i class="fas fa-eye"></i>';
                }
            });
            
            // Form submission
            const loginForm = document.getElementById('login-form');
            
            loginForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const email = document.getElementById('login-email').value;
                const password = document.getElementById('login-password').value;
                const remember = document.getElementById('remember').checked;

                // Simple validation
                if (!email || !password) {
                    showAlert('Please fill in all fields', 'error');
                    return;
                }
                
                // Email validation
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(email)) {
                    showAlert('Please enter a valid email address', 'error');
                    return;
                }
                
                // Password length validation
                if (password.length < 6) {
                    showAlert('Password must be at least 6 characters', 'error');
                    return;
                }
                
                // Simulate login process
                showAlert('Authenticating...', 'info');
                
                // Simulate API call
                setTimeout(() => {
                    showAlert('Login successful! Redirecting to dashboard...', 'success');
                    
                    // Redirect to dashboard after a delay
                    setTimeout(() => {
                        window.location.href = 'dashboard.html';
                    }, 1500);
                }, 1500);
            });
            
            // Social login handlers
            document.getElementById('google-login').addEventListener('click', function() {
                showAlert('Redirecting to Google authentication...', 'info');
            });
            
            document.getElementById('facebook-login').addEventListener('click', function() {
                showAlert('Redirecting to Facebook authentication...', 'info');
            });
            
            // Alert function
            function showAlert(message, type) {
                // Remove any existing alerts
                const existingAlert = document.querySelector('.custom-alert');
                if (existingAlert) {
                    existingAlert.remove();
                }
                
                // Create alert element
                const alert = document.createElement('div');
                alert.className = `custom-alert ${type}`;
                alert.textContent = message;
                
                // Add to DOM
                document.body.appendChild(alert);
                
                // Auto remove after 3 seconds
                setTimeout(() => {
                    alert.style.opacity = '0';
                    setTimeout(() => {
                        if (alert.parentNode) {
                            alert.parentNode.removeChild(alert);
                        }
                    }, 300);
                }, 3000);
            }
        });
    </script>



    <?php include('includes/footer.php');?>

   