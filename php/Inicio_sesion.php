<?php
session_start();
include("conexion.php");

$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
// Consulta para verificar el usuario
$sql = "SELECT * FROM registro WHERE correo='$correo'";
$resultado = $conexion->query($sql);
// Verifica si se encontró el usuario
if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
    // Verifica la contraseña
    if (password_verify($contraseña, $usuario['contraseña'])) {
        // Guarda el nombre del usuario en la sesión
        $_SESSION['usuario'] = $usuario['nombre'];
        
        // Registrar el inicio en la tabla inicio_sesion
        $id_usuario = $usuario['id'];
        $insert_sesion = "INSERT INTO inicio_sesion (id_usuario, correo, estado)
                          VALUES ('$id_usuario', '$correo', 'activo')";
        $conexion->query($insert_sesion);

        // Redirigir al inicio
        header("Location: ../Html/index.html");
        exit();
    } else {
        echo "<script>
            alert('Contraseña incorrecta >:(');
            window.history.back();
          </script>";
    }
} else {
    echo "<script>
            alert('El corrreo no esta registrado ;-;');
            window.history.back();
          </script>";
}

$conexion->close();
?>
