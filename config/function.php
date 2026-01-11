<?php

session_start(); // Start the session

require 'dbcon.php';

// Updated validate function with proper parameter
function validate($inputData){
    global $conn;
    if (is_array($inputData)) {
        // If inputData is an array, recursively apply the validation
        $validatedData = array_map('validate', $inputData);
    } else {
        // Otherwise, sanitize it as a string
        $validatedData = mysqli_real_escape_string($conn, $inputData);
        $validatedData = trim($validatedData);
    }
    return $validatedData;
}

// Redirect from one page to another page with the message(status)
function redirect($url, $status){
    $_SESSION['status'] = $status;
    header('Location: ' . $url);
    exit(0);
}

// Display message or status after any process
function alertMessage() {
    if (isset($_SESSION['status'])) {
        ?>
        <style>
            #customAlert {
                position: fixed;
                top: 20px;
                left: 50%;
                transform: translateX(-50%);
                background-color:rgb(67, 162, 181); /* green success */
                color: white;
                padding: 15px 30px;
                border-radius: 6px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.2);
                font-family: Arial, sans-serif;
                font-size: 16px;
                z-index: 10000;
                opacity: 1;
                transition: opacity 0.5s ease;
                display: flex;
                align-items: center;
                max-width: 400px;
                min-width: 250px;
            }
            #customAlert.hide {
                opacity: 0;
            }
            #customAlert button.closeBtn {
                background: transparent;
                border: none;
                color: white;
                font-size: 22px;
                font-weight: bold;
                margin-left: 20px;
                cursor: pointer;
                line-height: 1;
            }
            #customAlert button.closeBtn:hover {
                color: #ddd;
            }
        </style>

        <div id="customAlert">
            <?= htmlspecialchars($_SESSION['status']); ?>
            <button class="closeBtn" aria-label="Close">&times;</button>
        </div>

        <script>
            const alertBox = document.getElementById('customAlert');
            const closeBtn = alertBox.querySelector('.closeBtn');

            closeBtn.addEventListener('click', () => {
                alertBox.classList.add('hide');
                setTimeout(() => alertBox.remove(), 500);
            });

            setTimeout(() => {
                alertBox.classList.add('hide');
                setTimeout(() => alertBox.remove(), 500);
            }, 5000);
        </script>
        <?php
        unset($_SESSION['status']);
    }
}



// Insert record using this function 
function insert($tableName, $data){
    global $conn;

    // Validate table name
    $table = validate($tableName);
    $columns = array_keys($data);
    $values = validate(array_values($data)); // Validate each value in the array

    // Build the SQL columns and values string
    $finalColumn = implode(',', $columns);
    $finalValues = "'" . implode("','", $values) . "'";

    $query = "INSERT INTO $table ($finalColumn) VALUES ($finalValues)";
    $result = mysqli_query($conn, $query);
    return $result;
}

// Update data using this function
function update($tableName, $id, $data){
    global $conn;
    $table = validate($tableName);
    $id = validate($id);
    $data = validate($data); // Validate the entire data array

    $updateDataString = "";
    foreach($data as $column => $value){
        $updateDataString .= $column . "='" . $value . "',";
    }
    $finalUpdateData = substr(trim($updateDataString), 0, -1);

    $query = "UPDATE $table SET $finalUpdateData WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    return $result;
}

// Get all data from table
function getAll($tableName, $status = NULL){
    global $conn;
    $table = validate($tableName);
    $status = validate($status);
    if ($status == 'status'){
        $query = "SELECT * FROM $table WHERE status='0'";
    } else {
        $query = "SELECT * FROM $table";
    }
    return mysqli_query($conn, $query);
}

// Get data by id
function getById($tableName, $id){
    global $conn;
    $table = validate($tableName);
    $id = validate($id);
    $query = "SELECT * FROM $table WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        return [
            'status' => 200,
            'data' => $row,
            'message' => "Record found"
        ];
    } else {
        return [
            'status' => 404,
            'message' => 'No data found'
        ];
    }
}

// Delete data from the database using id
function delete($tableName, $id){
    global $conn;
    $table = validate($tableName);
    $id = validate($id);
    $query = "DELETE FROM $table WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    return $result;
}

function checkParamId($type){
    if(isset($_GET[$type])){
        if($_GET[$type] != ''){
            return $_GET[$type];
        }else{
            return '<h5> No id found</h5>';
        }
    }else{
        return '<h5> No id given</h5>';
    }

}
function logOutSession(){
     unset($_SESSION['loggedIn']);
     unset($_SESSION['loggedInUser']);
     unset($_SESSION['productItems']);
}


function jsonResponse($status, $status_type, $message){
    $response= [

        'status' => $status,
        'status_type' => $status_type,
        'message' => $message
    ];
    echo json_encode($response);
    return;
}
function getCount($tableName){

    global $conn;
     $table= validate($tableName);
     $query= "SELECT * FROM $table";
     $query_run= mysqli_query($conn, $query);
     if($query_run){

        $totalCount = mysqli_num_rows($query_run);
        return $totalCount;
     }
     else{
        return 'Something went wrong';
     }
}
?>
