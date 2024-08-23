<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Register </title>
        <link rel="stylesheet" type="text/css" href="stylelogin.css"> 
    </head>
    <body> 
        <div class="bara_prezentare">
            <ul class="bara_start">
                <img class="poza_logo" src="poze/logo_site.png">
                <li><a href="despre_noi.php">Despre noi</a></li>
                <li><a class="active" href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="index.php">Home</a></li>
            </ul>
        </div>
        <div class="chenar">
        <?php
            if (isset($_POST["submit"])) {
                $email = $_POST["email"];
                $user = $_POST["user"];
                $password = $_POST["passwd1"];
                $passwordRepeat = $_POST["passwd2"];
                
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                $errors = array();
                
                // Validarea datelor
                if (empty($email) || empty($user) || empty($password) || empty($passwordRepeat)) {
                    array_push($errors, "All fields are required");
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "Email is not valid");
                }
                if (strlen($password) < 8) {
                    array_push($errors, "Password must be at least 8 characters long");
                }
                if ($password !== $passwordRepeat) {
                    array_push($errors, "Passwords do not match");
                }

                // Conectarea la baza de date
                $conn = mysqli_connect("localhost", "root", "", "login_register");

                if ($conn) {
                    // Verificarea dacă emailul există deja
                    $sql = "SELECT * FROM users WHERE email = ?";
                    $stmt = mysqli_stmt_init($conn);
                    if (mysqli_stmt_prepare($stmt, $sql)) {
                        mysqli_stmt_bind_param($stmt, "s", $email);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        if (mysqli_num_rows($result) > 0) {
                            array_push($errors, "Email already exists!");
                        }
                    } else {
                        array_push($errors, "Database query error: " . mysqli_error($conn));
                    }

                    // Afișarea erorilor
                    if (count($errors) > 0) {
                        foreach ($errors as $error) {
                            echo "<div class='alert alert-danger'>$error</div>";
                        }
                    } else {
                        // Inserarea utilizatorului în baza de date
                        $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
                        if ($stmt = mysqli_stmt_init($conn)) {
                            if (mysqli_stmt_prepare($stmt, $sql)) {
                                $fullName = $user;
                                mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);
                                if (mysqli_stmt_execute($stmt)) {
                                    echo "<div class='alert'>You are registered successfully.</div>";
                                } else {
                                    echo "<div class='alert'>Error: Could not execute query: " . mysqli_error($conn) . "</div>";
                                }
                            } else {
                                echo "<div class='alert'>Error: Could not prepare statement: " . mysqli_error($conn) . "</div>";
                            }
                        } else {
                            echo "<div class='alert'>Error: Could not initialize statement: " . mysqli_error($conn) . "</div>";
                        }
                    }
                    //mysqli_close($conn);
                } else {
                    array_push($errors, "Connection failed: " . mysqli_connect_error());
                    foreach ($errors as $error) {
                        echo "<div class='alert'>$error</div>";
                    }
                }
            }
            ?>

            <form action="register.php" method="post">
                <h2>Inregistrare</h2>
                <div class="date">
                    <label>Email:</label>
                    <input type="text" class="form-control" name="email" required>
                </div>
                <div class="date">
                    <label>Nume de utilizator:</label>
                    <input type="text" class="form-control" name="user" required>
                </div>
                <div class="date">
                    <label>Parola:</label>
                    <input type="password" class="form-control" name="passwd1" required>
                </div>
                <div class="date">
                    <label>Repetati parola:</label>
                    <input type="password" class="form-control" name="passwd2" required>
                </div>
                <input type="checkbox" class="termeni" name="termeni">Am citit termenii si conditiile!
                <input type="submit" class="btn" value="register" name="submit">
            </form>
        </div>
    </body>
</html>