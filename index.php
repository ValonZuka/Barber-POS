<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuzzCut Barber </title>
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
</style>
</head>
<body>
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

        document.getElementById("barcodeInput").addEventListener("keydown", function (e) {
            if (e.key === "Enter") {
                const barcode = e.target.value.trim();
                if (!barcode) return;

                fetch("backend/get-product.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ barcode })
                })
                .then(res => res.json())
                .then(product => {
                    if (product.error) {
                        alert(product.error);
                    } else {
                        addToCart({
                            product_id: product.id,
                            name: product.name,
                            quantity: 1,
                            price: product.price
                        });
                    }
                    e.target.value = ""; // Clear the input
                })
                .catch(() => alert("Nuk u gjend produkti"));
            }
        });

        function addService(name, price) {
            addToCart({
                product_id: name, // Using service name as ID for simplicity
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
            const cartDiv = document.getElementById("cart");
            cartDiv.innerHTML = "";
            if (cart.length === 0) {
                const emptyMessage = document.createElement("div");
                emptyMessage.id = "emptyCartMessage";
                emptyMessage.textContent = "Shporta Bosh ...";
                cartDiv.appendChild(emptyMessage);
            } else {
                cart.forEach(item => {
                    const line = document.createElement("div");
                    line.textContent = `${item.name} x${item.quantity} - $${(item.price * item.quantity).toFixed(2)}`;
                    cartDiv.appendChild(line);
                });
            }
            document.getElementById("totalAmount").textContent = `Total: $${cart.reduce((sum, item) => sum + item.price * item.quantity, 0).toFixed(2)}`;
        }
          document.getElementById("checkoutBtn").addEventListener("click", function () {
            if (cart.length === 0) {
                document.getElementById("emptyCartModal").style.display = "block";
                return;
            }

            let checkoutDetails = cart.map(item => `${item.name} x${item.quantity} - $${(item.price * item.quantity).toFixed(2)}`).join('<br>');
            let total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0).toFixed(2);
            document.getElementById("checkoutDetails").innerHTML = checkoutDetails + `<br><strong>Total: $${total}</strong>`;
            document.getElementById("checkoutModal").style.display = "block";
        });

document.querySelectorAll(".close").forEach(closeBtn => {
            closeBtn.onclick = function() {
                this.closest(".modal").style.display = "none";
            };
        });

        window.onclick = function(event) {
            if (event.target.classList.contains("modal")) {
                event.target.style.display = "none";
            }
        };
</script>
</body>
</html>

