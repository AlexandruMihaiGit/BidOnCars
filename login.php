<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="stylelogin.css">
</head>
<body>
    <div class="bara_prezentare">
        <ul class="bara_start">
            <img class="poza_logo" src="poze/logo_site.png">
            <li><a href="despre_noi.php">Despre noi</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a class="active" href="login.php">Login</a></li>
            <li><a href="index.php">Home</a></li>
        </ul>
    </div>
    <div class="chenar">
        <?php
        // Activează raportarea erorilor (pentru dezvoltare)
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        if (isset($_POST["login"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];

            // Conexiune la baza de date
            $conn = mysqli_connect("localhost", "root", "", "login_register");

            // Verifică conexiunea
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Folosirea prepared statements pentru a preveni SQL injection
            $sql = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $sql->bind_param("s", $email);
            $sql->execute();
            $result = $sql->get_result();
            $user = $result->fetch_assoc();

            if ($user) {
                if (password_verify($password, $user["password"])) {
                    $_SESSION["user"] = "yes";
                    header("Location: index.php");
                    exit();
                } else {
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }

            // Închide conexiunea
            $sql->close();
            $conn->close();
        }
        ?>

        <form action="login.php" method="post">
            <h2>Logare</h2>
            <div class="date">
                <label>Email:</label>
                <input type="text" name="email" class="form-control" required>
            </div>
            <div class="date">
                <label>Parola:</label>
                <input type="password" name="password" class="form-control" required>
                <input type="checkbox" class="termeni" name="connected">Ramai logat!
            </div>
            <input type="submit" name="login" class="btn" value="login">
        </form>
    </div>
</body>
</html>
