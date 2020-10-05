<?php
    require 'database.php';

    $message = '';

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
        $message = 'El usuario fue creado correctamente.';
        } else {
        $message = 'Lo sentimos, su cuenta no pudo ser creada.';
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Registrarse</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" href="assest/style.css">
    </head>
    <body>
        <?php require 'partials/header.php' ?>

        <?php if(!empty($message)): ?>
        <p> <?= $message ?></p>
        <?php endif; ?>

        <h1>Registrarse</h1>
        <span>o <a href="login.php">Iniciar sesión</a></span>

        <form action="signup.php" method="POST">
        <input name="email" type="text" placeholder="Ingrese su correo">
        <input name="password" type="password" placeholder="Ingrese su contraseña">
        <input name="confirm_password" type="password" placeholder="Confirme su contraseña">
        <input type="submit" value="Registrarse">
        </form>
    </body>
</html>