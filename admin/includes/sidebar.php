
<?php     
  $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
  $ownerEmailSubstring = 'owner@gmail.com'; 
  
  ?>


<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>


                            <a class="nav-link <?= $page=='index.php' ? 'active' : '';  ?>" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard 
                            </a>

                            <a class="nav-link <?= $page=='orders-created.php' ? 'active' : '';  ?> " href="orders-created.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-bell"></i></div>
                                Create Order
                            </a>
                            <a class="nav-link <?= $page=='orders.php' ? 'active' : '';  ?>" href="orders.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                                Orders
                            </a>


                            <div class="sb-sidenav-menu-heading">Interface</div>
                            
                            <?php if (strpos($_SESSION['loggedInUser']['email'], $ownerEmailSubstring) !== false): ?>
                                <!-- Only visible if the logged-in user's email contains 'owner@gmail.com' -->




                            <a class="nav-link  

                             <?=( $page=='categories-created.php') || ($page=='categories.php' ) ? 'collapse active' : 'collapsed';  ?> 
                            
                            " 
                            href="#" data-bs-toggle="collapse" data-bs-target="#collapseCategory" aria-expanded="false" aria-controls="collapseCategory">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                              Categories
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse

                            <?= ($page=='categories-created.php') ||($page=='categories.php' ) ? 'show' : '';  ?> 
                              "  
                            
                            
                            id="collapseCategory" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?= $page=='categories-created.php' ? 'active' : '';  ?> " href="categories-created.php">Create Category</a>
                                    <a class="nav-link <?= $page=='categories.php' ? 'active' : '';  ?> " href="categories.php">View Categories</a>
                                </nav>
                            </div>

                            

                            <a class="nav-link 
                            <?= ($page=='products-created.php') ||($page=='products.php' ) ? 'collapse active' : 'collapsed';  ?> "
                             href="#" data-bs-toggle="collapse"
                             data-bs-target="#collapseProduct" aria-expanded="false"
                              aria-controls="collapseProduct">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                              Products
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse
                             <?= ($page=='products-created.php') ||($page=='products.php' ) ? 'show' : '';  ?> 
                                " 
                            id="collapseProduct" aria-labelledby="headingOne" 
                            data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?= $page=='products-created.php' ? 'active' : '';  ?> " href="products-created.php">Create Products</a>
                                    <a class="nav-link <?= $page=='products.php' ? 'active' : '';  ?> " href="products.php">View Products</a>
                                </nav>
                            </div>

                            <?php endif; ?>


                            <a class="nav-link 
                                    <?= ($page == 'change_password.php') ? 'collapse active' : 'collapsed'; ?> 
                                    " href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="<?= ($page == 'change_password.php') ? 'true' : 'false'; ?>" aria-controls="collapsePages">
                                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                    Pages
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse <?= ($page == 'change_password.php') ? 'show' : ''; ?>" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                        
                                        <!-- Authentication Section -->
                                        <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="<?= ($page == 'change_password.php') ? 'true' : 'false'; ?>" aria-controls="pagesCollapseAuth">
                                            Authentication
                                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                        </a>
                                        <div class="collapse <?= ($page == 'change_password.php') ? 'show' : ''; ?>" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                            <nav class="sb-sidenav-menu-nested nav">
                                                <a class="nav-link" href="login.html">Login</a>
                                                <a class="nav-link" href="register.html">Register</a>
                                                <a class="nav-link" href="forgot_password.php">Forgot Password</a>
                                                <a class="nav-link <?= ($page == 'change_password.php') ? 'active' : ''; ?>" href="change_password.php">Change Password</a>
                                            </nav>
                                        </div>

                                        <!-- Error Pages Section -->
                                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                            Error
                                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                        </a>
                                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                            <nav class="sb-sidenav-menu-nested nav">
                                                <a class="nav-link" href="401.html">401 Page</a>
                                                <a class="nav-link" href="404.html">404 Page</a>
                                                <a class="nav-link" href="500.html">500 Page</a>
                                            </nav>
                                        </div>
                                    </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Manager Users</div>

                            <a class="nav-link 
                             <?= ($page=='customers-created.php') ||($page=='customers.php' ) ? 'collapse active' : 'collapsed';  ?> " 
                             href="#" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#collapseCustomer" 
                            aria-expanded="false" aria-controls="collapseCustomer">
                               <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                              Customers
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse
                            <?= ($page=='customers-created.php') ||($page=='customers.php' ) ? 'show' : '';  ?> " 
                            id="collapseCustomer" aria-labelledby="headingOne" 
                            data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?= $page=='customers-created.php' ? 'active' : '';  ?>" href="customers-created.php">Add Customer</a>
                                    <a class="nav-link <?= $page=='customers.php' ? 'active' : '';  ?> " href="customers.php">Views Customers</a>
                                </nav>
                            </div>

                                                    <?php if (strpos($_SESSION['loggedInUser']['email'], $ownerEmailSubstring) !== false): ?>
                                <!-- Only visible if the logged-in user's email contains 'owner@gmail.com' -->

                                <div class="sb-sidenav-menu-heading">Manager Users</div>

                                <a class="nav-link <?= ($page == 'admins-created.php') || ($page == 'admins.php') ? 'collapse active' : 'collapsed'; ?>" 
                                href="#" data-bs-toggle="collapse" data-bs-target="#collapseAdmins" aria-expanded="false" aria-controls="collapseAdmins">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Admins/Staff
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>

                                <div class="collapse <?= ($page == 'admins-created.php') || ($page == 'admins.php') ? 'show' : ''; ?>" 
                                    id="collapseAdmins" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link <?= $page == 'admins-created.php' ? 'active' : ''; ?>" href="admins-created.php">Add Admins</a>
                                    <a class="nav-link <?= $page == 'admins.php' ? 'active' : ''; ?>" href="admins.php">View Admins</a>
                                </nav>
                                </div>

                                <?php endif; ?>

                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>