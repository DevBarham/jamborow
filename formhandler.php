<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.html');
    exit;
}

if ($_POST) {
    try {
        $pdo = new PDO("pgsql:host=host;dbname=dbname", 'user', 'password');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = 'INSERT INTO personal_info (user_id, name, mobile, address, gender, occupation) 
                    VALUES (:user_id, :name, :mobile, :address, :gender, :occupation)';
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':user_id' => $_SESSION['user']['id'],
            ':name' => $_POST['name'],
            ':mobile' => $_POST['mobile'],
            ':address' => $_POST['address'],
            ':gender' => $_POST['gender'],
            ':occupation' => $_POST['occupation']
        ));

        echo "Data inserted successfully.";

    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

?>
