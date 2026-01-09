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
