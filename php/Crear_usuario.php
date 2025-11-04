<?php
include("conexion.php");

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

// Verificar si el correo ya existe
$check = $conexion->prepare("SELECT correo FROM registro WHERE correo = ?");
$check->bind_param("s", $correo);
$check->execute();
$resultado = $check->get_result();

if ($resultado->num_rows > 0) {
    // Si ya existe, mostramos un mensaje claro
    echo "<script>
            alert('El correo ya está registrado, intente con otro ;-;');
            window.history.back();
          </script>";
} else {
    // Insertar nuevo usuario
    $sql = $conexion->prepare("INSERT INTO registro (nombre, correo, contraseña) VALUES (?, ?, ?)");
    $sql->bind_param("sss", $nombre, $correo, $contraseña);
    // Ejecutar la consulta y redirigir a inicio
    if ($sql->execute()) {
        header("Location: ../Html/inicio_sesion.html");
        exit();
    } else {
        echo "Error al crear usuario: " . $conexion->error;
    }
}

$conexion->close();
?>
