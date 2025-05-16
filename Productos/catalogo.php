<?php
session_start();
include('../includes/db.php');
include('../includes/header.php');

// Consulta para obtener todos los productos
$sql = "SELECT productos.*, categorias.nombre AS categoria 
        FROM productos 
        LEFT JOIN categorias ON productos.categoria_id = categorias.id";

$resultado = $conn->query($sql);
?>

<h2>Catálogo de Productos</h2>

<div style="display: flex; flex-wrap: wrap; gap: 20px;">
<?php while ($row = $resultado->fetch_assoc()) { ?>
    <div style="border: 1px solid #ccc; padding: 10px; width: 200px;">
        <h3><?php echo htmlspecialchars($row['nombre']); ?></h3>
        <p><strong>Precio:</strong> $<?php echo $row['precio']; ?></p>
        <p><strong>Categoría:</strong> <?php echo htmlspecialchars($row['categoria']); ?></p>
        <p><?php echo substr(htmlspecialchars($row['descripcion']), 0, 50); ?>...</p>
        <form action="../carro/carro.php" method="post">
            <input type="hidden" name="producto_id" value="<?php echo $row['id']; ?>">
            <button type="submit">Agregar al carrito</button>
        </form>
    </div>
<?php } ?>
</div>

<?php include('../includes/footer.php'); ?>
