<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuzzCut Barber </title>
</head>
<body>
</body>
</html>
<style>
    body {
        background-color: #2c2c2c;  
        color: #d4af37; 
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }
    h1 {
        text-align: center;
        margin-bottom: 20px;
    }
    /* ALL CSS */
</style>
<h1>BuzzCutt System</h1>
<input type="text" id="barcodeInput" placeholder="Scan barcode" />

<div class="button-container">
    <button class="service-button" onclick="addService('Qethje', 3.00)">Qethje - $3.00</button>
    <button class="service-button2" onclick="addService('Qethje me rroje', 4.00)">Qethje mrezh - $4.00</button>
    <button class="service-button2" onclick="addService('Larje Flokve', 1.00)">Larje Flokve - $1.00</button>
    <button class="service-button2" onclick="addService('Pastrimi Ftyres me Dyll', 2.00)">Pastrimi Ftyres me Dyll - $2.00</button>
</div>

<div id="cart"></div>
<div id="totalAmount">Total: $0.00</div>
<button id="checkoutBtn">~ Totali ~</button>

<button class="stock-btn" onclick="window.location.href='stock.php'">Shiko Stock-un</button>
<button class="realisation-btn" onclick="window.location.href='Realisation.php'">Shiko Shitjet</button>
<div id="checkoutModal" class="modal">
    <div class="modal-content">
        <span class="close">×</span>
        <h2>Checkout Summary</h2>
        <p id="checkoutDetails"></p>
        <button id="confirmCheckout">Confirm Checkout</button>
    </div>
</div>

<div id="emptyCartModal" class="modal">
    <div class="modal-content">
        <span class="close">×</span>
        <h2>Shporta Bosh</h2>
        <p>Shporta eshte bosh! te lutem mbushe per te perfunduar realizimin .</p>
        <button id="closeEmptyCart">Close</button>
    </div>
</div>
<script>    
let cart = [];

function addService(name, price) {
    addToCart({
        product_id: name,
        name: name,
        quantity: 1,
        price: price
    });
}

function addToCart(item) {
    const index = cart.findIndex(i => i.product_id === item.product_id);
    if (index !== -1) {
        cart[index].quantity += 1;
    } else {
        cart.push(item);
    }
    renderCart();
}

function renderCart() {
    
}
document.getElementById("barcodeInput").addEventListener("keydown", function (e) {
    
});

document.getElementById("checkoutBtn").addEventListener("click", function () {
    
});

document.getElementById("confirmCheckout").addEventListener("click", function () {
    fetch("backend/api.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(cart)
    })
});


</script>