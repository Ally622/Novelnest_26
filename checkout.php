<?php
session_start();
include 'init.php';
include 'includes/header.php';

$user_id = $_SESSION['user_id'] ?? null;
if(!$user_id){
    redirect('login.php');
}

// Fetch cart items
$stmt = $conn->prepare("
    SELECT c.cart_id, p.product_id, p.product_name, p.price, c.quantity
    FROM cart c
    JOIN products p ON c.product_id = p.product_id
    WHERE c.user_id=?
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$cart_items = $stmt->get_result();

if($cart_items->num_rows == 0){
    echo "<p>Your cart is empty!</p>";
    include 'includes/footer.php';
    exit;
}

// Here you would normally insert into orders/order_items
// For simplicity, we just display the summary
$grand_total = 0;
?>

<h2>Checkout</h2>
<table>
<tr>
    <th>Product</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Total</th>
</tr>
<?php while($item = $cart_items->fetch_assoc()): 
    $total = $item['price'] * $item['quantity'];
    $grand_total += $total;
?>
<tr>
    <td><?= htmlspecialchars($item['product_name']) ?></td>
    <td><?= number_format($item['price'],2) ?></td>
    <td><?= $item['quantity'] ?></td>
    <td><?= number_format($total,2) ?></td>
</tr>
<?php endwhile; ?>
</table>

<h3>Grand Total: KES <?= number_format($grand_total,2) ?></h3>
<p>Checkout functionality can be implemented here.</p>

<?php include 'includes/footer.php'; ?>
