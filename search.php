<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.html');
    exit;
}

try {
    $pdo = new PDO("pgsql:host=host;dbname=dbname", 'user', 'password');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_POST) {
        $name = $_POST['name'];
        
        $query = 'SELECT * FROM personal_info WHERE name = :name';
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':name' => $name
        ));
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            echo "User Info:<br>";
            echo "Name: " . $result['name'] . "<br>";
            echo "Mobile: " . $result['mobile'] . "<br>";
            echo "Address: " . $result['address'] . "<br>";
            echo "Gender: " . $result['gender'] . "<br>";
            echo "Occupation: " . $result['occupation'] . "<br>";
        } else {
            echo "No results found.";
        }
    } else {
        header('Location: search.html');
    }

} catch (PDOException $e) {
    die($e->getMessage());
}
?>
