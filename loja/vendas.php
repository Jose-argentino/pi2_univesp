<?php
include "php/partes/validaSession.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
 <link rel="stylesheet" href="css/geral.css">
 <link rel="stylesheet" href="css/menu.css">
 <link rel="stylesheet" href="css/vendas.css">
 <link rel="stylesheet" href="css/footerInterno.css">
 <title>Vendas</title>
</head>

<body>

<div id="container">

<header>
    <?php include "php/partes/menuInterno.php"; ?>
</header>

<main>

    <h2>Produto de Exemplo</h2>
    <p>Valor: R$ 10,00</p>

    <button id="btnPagar">Pagar com PayPal</button>

</main>

<footer>
    <?php include "php/partes/footerInterno.php"; ?>
</footer>

</div>

<script src="https://www.paypal.com/sdk/js?client-id=SEU_CLIENT_ID_AQUI&currency=BRL"></script>

<div id="paypal-button-container"></div>

<script>
paypal.Buttons({
    createOrder: function () {
        return fetch("php/paypal/create_order.php", {
            method: "POST"
        })
        .then(res => res.json())
        .then(data => data.id);
    },

    onApprove: function (data) {
        return fetch(`php/paypal/capture_order.php?orderID=${data.orderID}`, {
            method: "POST"
        })
        .then(res => res.json())
        .then(details => {
            alert("Pagamento aprovado!");
            console.log(details);
        });
    }
}).render("#paypal-button-container");
</script>


</body>
</html>
