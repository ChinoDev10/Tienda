<?php
session_start();
include('../includes/db.php');
include('../includes/header.php');

// Inicializar carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Si se ha enviado un producto por POST desde el catálogo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['producto_id'])) {
    $producto_id = intval($_POST['producto_id']);

    // Verificar si ya está en el carrito
    if (isset($_SESSION['carrito'][$producto_id])) {
        $_SESSION['carrito'][$producto_id]['cantidad']++;
    } else {
        // Obtener datos del producto
        $sql = "SELECT id, nombre, precio FROM productos WHERE id = $producto_id";
        $resultado = $conn->query($sql);
        if ($resultado && $resultado->num_rows > 0) {
            $producto = $resultado->fetch_assoc();
            $_SESSION['carrito'][$producto_id] = [
                'id' => $producto['id'],
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'cantidad' => 1
            ];
        }
    }
}
?>

<h2>Tu Carrito de Compras</h2>

<?php if (empty($_SESSION['carrito'])): ?>
    <p>Tu carrito está vacío.</p>
<?php else: ?>
    <table border="1" cellpadding="5">
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Total</th>
        </tr>
        <?php
        $total_general = 0;
        foreach ($_SESSION['carrito'] as $item):
            $total = $item['precio'] * $item['cantidad'];
            $total_general += $total;
        ?>
        <tr>
            <td><?php echo htmlspecialchars($item['nombre']); ?></td>
            <td>$<?php echo number_format($item['precio'], 2); ?></td>
            <td><?php echo $item['cantidad']; ?></td>
            <td>$<?php echo number_format($total, 2); ?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3"><strong>Total a pagar:</strong></td>
            <td><strong>$<?php echo number_format($total_general, 2); ?></strong></td>
        </tr>
    </table>
    <br>
    <a href="../checkout/checkout.php">Proceder al pago</a>
<?php endif; ?>

<?php include('../includes/footer.php'); ?>
