<?php
session_start();
try {
    $pdo = new PDO("pgsql:host=localhost;dbname=postgres", 'postgres', 'Barham1975');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die($e->getMessage());
}

if ($_POST) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username = :username AND password = :password";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array(
        ':username' => $username,
        ':password' => $password
    ));

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['user'] = $user;
        header('Location:form.html');
        exit;
    } else {
        echo "Invalid credentials.";
    }
}

?>
