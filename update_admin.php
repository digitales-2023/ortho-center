<?php
// Script para actualizar usuario administrador
require_once "model/conexion.php";

try {
    $emailNuevo = "admin@orthocenter.pe";
    $passwordNuevo = "#orthocenter20";
    $salt = '$2a$07$usesomesillystringfore2uDLvp1Ii2e./U9C8sBjqp8I90dH6hi';
    
    // Generar hash
    $passwordHash = crypt($passwordNuevo, $salt);
    
    echo "<h2>Actualizando usuario administrador...</h2>";
    echo "<p><strong>Nuevo Email:</strong> " . htmlspecialchars($emailNuevo) . "</p>";
    echo "<p><strong>Contraseña:</strong> " . htmlspecialchars($passwordNuevo) . "</p>";
    echo "<p><strong>Hash:</strong> " . htmlspecialchars($passwordHash) . "</p>";
    echo "<p><strong>Largo del hash:</strong> " . strlen($passwordHash) . " caracteres</p>";
    
    // Actualizar en la BD
    $statement = Conexion::conn()->prepare("UPDATE tba_usuario SET CorreoUsuario = :email, PasswordUsuario = :pwd, FechaActualizacion = NOW() WHERE IdUsuario = 1");
    $statement->bindParam(":email", $emailNuevo, PDO::PARAM_STR);
    $statement->bindParam(":pwd", $passwordHash, PDO::PARAM_STR);
    
    if ($statement->execute()) {
        echo "<p style='color: green; font-weight: bold;'>✓ Usuario actualizado correctamente</p>";
        echo "<hr>";
        echo "<h3>Nuevas credenciales:</h3>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($emailNuevo) . "</p>";
        echo "<p><strong>Contraseña:</strong> " . htmlspecialchars($passwordNuevo) . "</p>";
        echo "<p><a href='index.php' style='padding: 10px 20px; background-color: #17a2b8; color: white; text-decoration: none; border-radius: 4px;'>Ir al login</a></p>";
    } else {
        echo "<p style='color: red;'><strong>✗ Error al actualizar</strong></p>";
        print_r($statement->errorInfo());
    }
} catch (Exception $e) {
    echo "<p style='color: red;'><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
