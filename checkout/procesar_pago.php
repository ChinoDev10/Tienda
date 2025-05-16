<?php
session_start();
include('../includes/header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir datos del formulario
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $metodo_pago = htmlspecialchars($_POST['metodo_pago']);

    // Aquí normalmente iría la integración real de pago...

    // Simulación: vaciar carrito
    unset($_SESSION['carrito']);

    echo "<h2>¡Pago procesado con éxito!</h2>";
    echo "<p>Gracias, $nombre. Hemos recibido tu pago mediante $metodo_pago.</p>";
    echo "<p>Se ha enviado un comprobante a $email.</p>";
    echo "<p><a href='../Productos/catalogo.php'>Volver al catálogo</a></p>";
} else {
    echo "<p>Acceso inválido.</p>";
}

include('../includes/footer.php');
