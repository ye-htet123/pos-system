<?php

include('../config/function.php'); // Fixed typo from 'finction.php' to 'function.php'

if (isset($_POST['saveAdmin'])) {
    global $conn; // Ensure you have a global reference to your DB connection

    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);
    
    // Properly set is_ban value based on checkbox input
    $is_ban = isset($_POST['is_ban']) ? 1 : 0;
    
    // Ensure all required fields are filled
    if (!empty($name) && !empty($email) && !empty($password)) {
        // Check if the email is already used
        $emailCheck = mysqli_query($conn, "SELECT * FROM admins WHERE email='$email'");
        
        if ($emailCheck) {
            if (mysqli_num_rows($emailCheck) > 0) {
                redirect('admins-created.php', 'Email already used by another user.');
            } else {
                // Hash the password for secure storage
                $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);

                // Prepare the data array for insertion
                $data = [
                    'name' => $name,
                    'email' => $email,
                    'password' => $bcrypt_password,
                    'phone' => $phone,
                    'is_ban' => $is_ban
                ];

                // Insert the data into the 'admins' table (fixed typo from 'admis')
                $result = insert('admins', $data);

                if ($result) {
                    redirect('admins.php', 'Admin created successfully.');
                } else {
                    redirect('admins-created.php', 'Something went wrong!');
                }
            }
        } else {
            redirect('admins-created.php', 'Database query failed.');
        }
    } else {
        redirect('admins-created.php', 'Please fill in all required fields.');
    }
}
if(isset($_POST['updateAdmin'])){

    $adminId = validate($_POST['adminId']);
    $adminData= getById('admins',$adminId);
    if($adminData['status']!= 200){
        redirect('admins-edited.php?id='.$adminId,'Please fill requied fields.');
    }


    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $phone = validate($_POST['phone']);
    
    // Properly set is_ban value based on checkbox input
    $is_ban = isset($_POST['is_ban']) ? 1 : 0;

    if($password !=''){
        $hashedPassword= password_hash($password, PASSWORD_BCRYPT);
    }else{
        $hashedPassword= $adminData['data']['password'];
    }

    if (!empty($name) && !empty($email) ) {
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'phone' => $phone,
            'is_ban' => $is_ban
        ];

        // Insert the data into the 'admins' table (fixed typo from 'admis')
        $result = update('admins', $adminId, $data);

        if ($result) {
            redirect('admins-edited.php?id='.$adminId, 'Admin updated successfully.');
        } else {
            redirect('admins-edited.php?id='.$adminId, 'Something went wrong!');
        }

    }else {
        redirect('admins-created.php', 'Please fill in all required fields.');
    }

}

if(isset($_POST['saveCategory'])){
    $name= validate($_POST['name']);
    $description= validate($_POST['description']);
    $status= isset($_POST['status']) ? 1:0;

    $data = [
        'name' => $name,
        'description' => $description,
        'status' => $status
        
    ];


    // Insert the data into the 'admins' table (fixed typo from 'admis')
    $result = insert('categories', $data);

    if ($result) {
        redirect('categories.php', 'Category Added successfully.');
    } else {
        redirect('categories-created.php', 'Something went wrong!');
    }

}
if(isset($_POST['updateCategory'])){

    $categoryId= validate($_POST['categoryId']);


    $name= validate($_POST['name']);
    $description= validate($_POST['description']);
    $status= isset($_POST['status']) ? 1:0;

    $data = [
        'name' => $name,
        'description' => $description,
        'status' => $status
        
    ];


    // Insert the data into the 'admins' table (fixed typo from 'admis')
    $result = update('categories',$categoryId,$data);

    if ($result) {
        redirect('categories.php?id='.$categoryId, 'Category Added successfully.');
    } else {
        redirect('categories-edited.php?id='.$categoryId, 'Something went wrong!');
    }

}

if (isset($_POST['saveProduct'])) {
    $category_id = validate($_POST['category_id']);
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $price = validate($_POST['price']);
    $quantity = validate($_POST['quantity']);
    $status = isset($_POST['status']) ? 1 : 0;

    // Check if an image file is provided
    if ($_FILES['image']['size'] > 0) {
        $path = "../assets/uploads/products";
        
        // Ensure the directory exists, and create it if it doesn't
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = time() . '.' . $image_ext;

        // Move uploaded file to the specified directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $path . "/" . $filename)) {
            $finalimage = "assets/uploads/products/" . $filename;
        } else {
            redirect('products-created.php', 'Failed to upload image.');
        }
    } else {
        $finalimage = '';
    }

    $data = [
        'category_id' => $category_id,
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'quantity' => $quantity,
        'image' => $finalimage,
        'status' => $status
    ];

    $result = insert('products', $data);

    if ($result) {
        redirect('products.php', 'Product added successfully.');
    } else {
        redirect('products-created.php', 'Something went wrong!');
    }
}
   
if(isset($_POST['updateProduct'])){

    $product_id = validate($_POST['product_id']);
    $productData= getById('products',$product_id);
    if(!$productData){
        redirect('products.php','No such product found');

    }

    $category_id = validate($_POST['category_id']);
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $price = validate($_POST['price']);
    $quantity = validate($_POST['quantity']);
    $status = isset($_POST['status']) ? 1 : 0;

    // Check if an image file is provided
    if ($_FILES['image']['size'] > 0) {
        $path = "../assets/uploads/products";
        
        // Ensure the directory exists, and create it if it doesn't
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = time() . '.' . $image_ext;

        // Move uploaded file to the specified directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $path . "/" . $filename)) {
            $finalimage = "assets/uploads/products/" . $filename;
            $deleteImage="../".$productData['data']['image'];
            if(file_exists($deleteImage)){
                unlink($deleteImage);

            }
        } else {
            redirect('products-created.php', 'Failed to upload image.');
        }
    } else {
        $finalimage = $productData['data']['image'];
    }
    $data = [
        'category_id' => $category_id,
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'quantity' => $quantity,
        'image' => $finalimage,
        'status' => $status
    ];

    $result = update('products',$product_id, $data);

    if ($result) {
        redirect('products-edited.php?id='.$product_id, 'Product updated successfully.');
    } else {
        redirect('products-edited.php?id='.$product_id, 'Something went wrong!');
    }
}

if(isset($_POST['saveCustomer'])){
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    
    $status = isset($_POST['status']) ? 1 : 0;
    if($name !=''){
        $emailCheck=mysqli_query($conn, "SELECT * FROM customers WHERE email='$email'");
        if($emailCheck){
            if(mysqli_num_rows($emailCheck) > 0){
                redirect('customers.php',' Email already used by another user');
            }
        }
        $data = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            
            'status' => $status
        ];
        $result = insert('customers', $data);

    if ($result) {
        redirect('customers.php', 'Customer added successfully.');
    } else {
        redirect('customers-created.php', 'Something went wrong!');
    }
    }else{
        redirect('customers.php','Please fill required fields');

    }
}

if(isset($_POST['updateCustomer'])){
    $customer_id = validate($_POST['customerId']);

    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    
    $status = isset($_POST['status']) ? 1 : 0;
    if($name !=''){
        $emailCheck=mysqli_query($conn, "SELECT * FROM customers WHERE email='$email'AND id!='$customer_id'");
        if($emailCheck){
            if(mysqli_num_rows($emailCheck) > 0){
                redirect('customers-edited.php?id='.$customer_id ,'Email already used by another user');
            }
        }
        $data = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            
            'status' => $status
        ];
        $result = update('customers',$customer_id, $data);

    if ($result) {
        redirect('customers-edited.php?id='.$customer_id, 'Customer edited successfully.');
    } else {
        redirect('customers-edited.php?id='.$customer_id, 'Something went wrong!');
    }
    }else{
        redirect('customers-edited.php?id='.$customer_id,'Please fill required fields');

    }

}
?>
