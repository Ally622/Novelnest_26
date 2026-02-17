<?php
// cart.php
session_start();
include_once 'config/init.php';

// Redirect if user is not logged in
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

// Fetch user's name for greeting
$stmt = $conn->prepare("SELECT name FROM users WHERE user_id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$user_name = $user['name'] ?? 'User'; // corrected variable
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once 'includes/html_head.php'; ?>
<title>Your Cart - Novelnest & Stationery</title>
</head>
<body>

<header>
  <h1>NovelNest & Stationery</h1>
  <nav>
    <span>Welcome, <?= htmlspecialchars($user_name) ?></span>
    <a href="index.php">Home</a>
    <a href="cart.php">Cart</a>
    <a href="orders.php">My Orders</a>
    <a href="logout.php" style="padding:5px 10px; background:#801515; color:white; border-radius:5px;">
      Logout
    </a>
  </nav>
</header>

<div class="cart-container">
  <h2>Your Shopping Cart</h2>
  <table id="cart-table">
    <thead>
      <tr>
        <th>Image</th>
        <th>Product</th>
        <th>Price (Ksh)</th>
        <th>Quantity</th>
        <th>Subtotal</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr><td colspan="6">Loading...</td></tr>
    </tbody>
  </table>
  <div class="total" id="cart-total">Total: Ksh 0</div>
  <div class="message" id="cart-message"></div>

  <button class="btn place-order-btn" onclick="placeOrder()" id="place-order-btn" style="display:none;">Place Order</button>
  <!-- View Orders Button -->
  <button class="btn view-orders-btn" onclick="window.location.href='orders.php'">
      View My Orders
  </button>
  <div style="clear:both;"></div>
</div>

<script>
// Load cart items
async function loadCart(){
    const tbody = document.querySelector("#cart-table tbody");
    const totalDiv = document.getElementById("cart-total");
    const msgDiv = document.getElementById("cart-message");
    const placeOrderBtn = document.getElementById("place-order-btn");

    tbody.innerHTML = "<tr><td colspan='6'>Loading...</td></tr>";
    totalDiv.textContent = "Total: Ksh 0";
    msgDiv.textContent = "";
    placeOrderBtn.style.display = "none"; // Hide button by default

    try{
        const res = await fetch("cart/view_cart.php");
        const data = await res.json();

        tbody.innerHTML = "";
        let total = 0;

        if(!data.success || data.items.length === 0){
            tbody.innerHTML = `<tr><td colspan="6">Your cart is empty.</td></tr>`;
            return;
        }

        data.items.forEach(item => {
            const subtotal = item.price * item.quantity;
            total += subtotal;

            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td><img src="${item.image}" alt="${item.name}"></td>
                <td>${item.name}</td>
                <td>${item.price.toFixed(2)}</td>
                <td>
                    <input type="number" min="1" value="${item.quantity}" onchange="updateQuantity(${item.product_id}, this.value)">
                </td>
                <td>${subtotal.toFixed(2)}</td>
                <td><button class="btn" onclick="removeFromCart(${item.product_id})">Remove</button></td>
            `;
            tbody.appendChild(tr);
        });

        totalDiv.textContent = `Total: Ksh ${total.toFixed(2)}`;
        placeOrderBtn.style.display = "block"; // Show button if cart is not empty

    } catch(err){
        console.error(err);
        msgDiv.textContent = "Failed to load cart.";
    }
}

// ... (rest of the functions remain the same) ...

// Place Order
async function placeOrder(){
    // For simplicity, prompt for shipping address and payment method
    // In a real application, these would come from form inputs
    const shippingAddress = prompt("Please enter your shipping address:");
    if (!shippingAddress) {
        alert("Shipping address is required to place an order.");
        return;
    }

    const paymentMethod = prompt("Please enter your preferred payment method (e.g., cash_on_delivery, mpesa, paypal):", "cash_on_delivery");
    if (!paymentMethod) {
        alert("Payment method is required to place an order.");
        return;
    }

    try {
        const res = await fetch("orders/submit_order.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `shipping_address=${encodeURIComponent(shippingAddress)}&payment_method=${encodeURIComponent(paymentMethod)}`
        });
        const data = await res.json();

        if (data.success) {
            alert("Order placed successfully! Order ID: " + data.order_id);
            window.location.href = "orders.php"; // Redirect to orders page
        } else {
            alert("Failed to place order: " + data.message);
        }
    } catch (err) {
        console.error(err);
        alert("An error occurred while placing your order.");
    }
}

// Update quantity
async function updateQuantity(productId, qty){
    qty = parseInt(qty);
    if(qty <= 0) return;

    try{
        const res = await fetch("cart/update_cart.php", {
            method:"POST",
            headers: {"Content-Type":"application/x-www-form-urlencoded"},
            body: `product_id=${productId}&quantity=${qty}`
        });
        const data = await res.json();
        const msgDiv = document.getElementById("cart-message");
        msgDiv.textContent = data.message;
        msgDiv.style.color = data.success ? "green" : "red";

        loadCart();
    } catch(err){
        console.error(err);
        alert("Failed to update quantity.");
    }
}

// Remove item
async function removeFromCart(productId){
    if(!confirm("Remove this item from cart?")) return;

    try{
        const res = await fetch("cart/remove_from_cart.php", {
            method:"POST",
            headers: {"Content-Type":"application/x-www-form-urlencoded"},
            body: `product_id=${productId}`
        });
        const data = await res.json();
        const msgDiv = document.getElementById("cart-message");
        msgDiv.textContent = data.message;
        msgDiv.style.color = data.success ? "green" : "red";

        loadCart();
    } catch(err){
        console.error(err);
        alert("Failed to remove item.");
    }
}

// Initial load
loadCart();
</script>

</body>
</html>

