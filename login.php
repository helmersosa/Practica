<?php
    session_start();

    if (isset($_SESSION['user_id'])) {
        header('Location: /Practica MySQLi');
    }
    require 'database.php';

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $message = '';

        if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
        $_SESSION['user_id'] = $results['id'];
        header("Location: /Practica MySQLi");
        } else {
        $message = 'Lo sentimos, el correo o la contraseña son incorrectos.';
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Inicio de sesión</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="assest/style.css">
    </head>
    <body>
        <?php require 'partials/header.php' ?>

        <?php if(!empty($message)): ?>
        <p> <?= $message ?></p>
        <?php endif; ?>

        <h1>Iniciar sesión</h1>
        <span>o <a href="signup.php">Registrarse</a></span>

        <form action="login.php" method="POST">
        <input name="email" type="text" placeholder="Ingrese su correo">
        <input name="password" type="password" placeholder="Ingrese su contraseña">
        <input type="submit" value="Iniciar sesión">
        </form>
    </body>
</html>