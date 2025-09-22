<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Aroma Nazlatte</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            color: #6b4c3b;
        }
        table {
            width: 50%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #6b4c3b;
            color: white;
        }

        h2.marq {
            color: #ff00c8ff;
        }

        input[type="submit"] {
            background-color: #6b4c3b;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

    </style>

</head> 

<?php

// an array to hold coffee menu items and their prices
$menu = array(
    array("name" => "Espresso", "price" => 3),
    array("name" => "Signature Nazlatte", "price" => 13),
    array("name" => "Americano", "price" => 5),
    array("name" => "Macha", "price" => 9)
);

// function to calculate total price
function calculateTotal($coffee, $quantity, $menu) {
    if (array_key_exists($coffee, $menu)) {
        return $menu[$coffee]['price'] * $quantity;
    }
}

// initialize variables to hold order details
$customerName = "";
$selectedCoffee = "";
$quantity = 0;
$totalPrice = 0;
$ordered = false;
$flag = false;

// process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerName = htmlspecialchars($_POST['name']); // sanitize input
    $selectedCoffee = $_POST['coffee']; 
    $quantity = intval($_POST['quantity']);
    $totalPrice = calculateTotal($selectedCoffee, $quantity, array_column($menu, null, 'name'));
    // set ordered flag to true
    $ordered = true;
}

?>

<body>
    <h1>☕ Sweet Aroma Nazlatte Menu ☕</h1>
    <h2 class="marq"><marquee>Made with love!🥰</marquee></h2>
    <hr>
    <h2>Our Menu:</h2>

    <table>
        <tr>
            <th>No.</th>
            <th>Coffee</th>
            <th>Price (RM)</th>
        </tr>
        <?php
        $itemNumber = 1;
        foreach ($menu as $item) {
            echo "<tr>";
            echo "<td>" . $itemNumber++ . "</td>";
            echo "<td>" . $item['name'] . "</td>";
            echo "<td>" . $item['price'] . "</td>";
            echo "</tr>";
        }
        ?>

</table>

<br><br>

<h2>Place Your Order:</h2>

<!-- Order form -->
<form action="" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    <br><br>
    <label for="coffee">Select Coffee:</label>
    <select name="coffee" id="coffee" required>

            <?php
            // dynamically generate coffee options
    foreach ($menu as $item) {
        echo '<option value="' . $item['name'] . '">' . $item['name'] . ' - RM' . $item['price'] . '</option>';
    }
    ?>

    </select>

    <br><br>

    <label for="quantity">Quantity:</label>
    <input type="number" id="quantity" name="quantity" min="1" required>

    <br><br>

    <input type="submit" value="Place Order">
</form>

<hr>

<h1>Order Summary</h1>

<table>
    <tr>
        <th>Name</th>
        <th>Coffee</th>
        <th>Quantity</th>
        <th>Total Price (RM)</th>
    </tr>
    <?php
    if ($ordered) {
        if ($customerName == "admin"){
            $flag = true;
        }
        else{
            $flag = false;
            echo "<tr>";
            echo "<td>" . $customerName . "</td>";
            echo "<td>" . $selectedCoffee . "</td>";
            echo "<td>" . $quantity . "</td>";
            echo "<td>" . number_format($totalPrice, 2) . "</td>";
            echo "</tr>";
        }

    } 

    while ($flag) {
        include 'flag.php';
        break;
    }
    ?>

</body>
</html>