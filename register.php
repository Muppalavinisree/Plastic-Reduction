

<?php
include "connect.php";

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['signUp'])) {
        $firstName = trim($_POST['fName']);
        $lastName = trim($_POST['lName']);
        $email = strtolower(trim($_POST['email'])); // Convert to lowercase
        $password = trim($_POST['password']);

        // Validate input
        if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
            $error_message = "All fields are required!";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "Please enter a valid email address.";
        } else {
            // Hash the password before storing it
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Check if email already exists in the database
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $error_message = "Email Address Already Exists!";
                echo "<p>$error_message <a href='index.php'>Sign in here</a>.</p>";
            } else {
                // Insert the user into the database with the hashed password
                $stmt = $conn->prepare("INSERT INTO users (firstName, lastName, email, password) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $firstName, $lastName, $email, $hashedPassword);

                if ($stmt->execute()) {
                    $success_message = "User registered successfully! You can now log in.";
                    echo "<p>$success_message <a href='index.php'>Sign in here</a>.</p>";
                } else {
                    $error_message = "Error during registration. Please try again later.";
                   
                }
            }
            $stmt->close();
        }
    }

    // If there was an error, display it
    if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }

    // If registration was successful, show the success message
    if (isset($success_message)) {
        echo "<p style='color: green;'>$success_message</p>";
    }
}

if(isset($_POST['signIn'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password) ;
    
    $sql="SELECT * FROM users WHERE email='$email' ";
    $result=$conn->query($sql);
    if($result->num_rows>0){
     session_start();
     $row=$result->fetch_assoc();
     $_SESSION['email']=$row['email'];
     header("Location: homepage.php");
     exit();
    }
    else{
     echo "Not Found, Incorrect Email or Password";
    }
 
 }
 
?>


