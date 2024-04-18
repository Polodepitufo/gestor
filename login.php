<?php
if (isset($_GET['mensaje'])) {
    $errorMessage = 'No tienes permisos para acceder a esta sección.';
} else {
    $errorMessage = '';
}
if (isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sqlUser = $db->query("SELECT * FROM USUARIOS WHERE email ='$email'");
    $user = $sqlUser->fetch_array();
    if ($user) {
        $passwordHash = $user['PASSWORD'];
        if (password_verify($password, $passwordHash)) {
            if ($user['ROL'] == 'ADMIN') {
                $_SESSION['sesion_email']=$user['EMAIL'];
                $_SESSION['sesion_nombre']=$user['NOMBRE'];
                $_SESSION['sesion_apellidos']=$user['APELLIDOS'];
                $_SESSION['sesion_rol']=$user['ROL'];
                header('Location:app/dashboard/index.php');
            } else {
                $errorMessage = 'No tienes permisos para acceder a esta sección.';
            }
        } else {
            $errorMessage = 'Contraseña inválida.';
        }
    } else {
        $errorMessage = 'Email y/o contraseña inválidos.';
    }
}
