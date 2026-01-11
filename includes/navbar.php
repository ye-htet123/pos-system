
 <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="logo">
            <i class="fas fa-cash-register"></i>
            <h1>POS</h1>
        </div>

        <div class="nav-links">
            <a href="#"><i class="fas fa-home"></i> Home</a>
            <a href="#"><i class="fas fa-chart-line"></i> login</a>
            <a href="#"><i class="fas fa-shopping-cart"></i> login</a>


            <?php if(isset($_SESSION['loggedIn'])): ?>
       
        
          <a class="btn btn-danger" href="logout.php">logout<?=$_SESSION['loggedInUser']['name'] ; ?></a>
        
        <?php else: ?>
                   <a href="#"><i class="fas fa-users"></i> login</a>

        
          <?php endif; ?>
        </div>

        <div class="nav-actions">
            <button class="btn btn-secondary"><i class="fas fa-question-circle"></i> Help</button>
        </div>
    </nav>

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

        /* Navigation Bar */
        .navbar {
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            color: white;
            padding: 0.8rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .logo i {
            font-size: 1.8rem;
        }

        .logo h1 {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 0.8rem;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .nav-links a:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .nav-actions {
            display: flex;
            gap: 1rem;
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

        
    </style>
