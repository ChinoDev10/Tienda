<?php
session_start();
include('../includes/header.php');

if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    echo "<p>Tu carrito está vacío. <a href='../Productos/catalogo.php'>Ir al catálogo</a></p>";
    include('../includes/footer.php');
    exit;
}

// Calcular total
$total_general = 0;
foreach ($_SESSION['carrito'] as $item) {
    $total_general += $item['precio'] * $item['cantidad'];
}

// Simular pago con un formulario simple
?>

<h2>Checkout</h2>

<p>Total a pagar: <strong>$<?php echo number_format($total_general, 2); ?></strong></p>

<form method="post" action="procesar_pago.php">
    <label>Nombre completo:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Correo electrónico:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Método de pago:</label><br>
    <select name="metodo_pago" required>
        <option value="">--Seleccione--</option>
        <option value="tarjeta">Tarjeta de crédito</option>
        <option value="paypal">PayPal</option>
        <option value="transferencia">Transferencia bancaria</option>
    </select><br><br>

    <button type="submit">Pagar</button>
</form>

<?php include('../includes/footer.php'); ?>
