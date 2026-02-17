<?php
// Product prices
$products = [
    "Laptop" => 800,
    "Phone" => 500,
    "Headphones" => 100
];

$errors = [];
$orderProcessed = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $product = $_POST["product"];
    $quantity = (int)$_POST["quantity"];

    // Validation
    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required.";
    }

    if (!isset($products[$product])) {
        $errors[] = "Invalid product selected.";
    }

    if ($quantity <= 0) {
        $errors[] = "Quantity must be at least 1.";
    }

    if (empty($errors)) {
        $price = $products[$product];
        $total = $price * $quantity;
        $orderProcessed = true;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Order Processing</title>
    <style>
        body { font-family: Arial; margin: 40px; }
        .error { color: red; }
        .success { color: green; }
        .box { border: 1px solid #ccc; padding: 20px; width: 400px; }
    </style>
</head>
<body>

<div class="box">

<?php if (!$orderProcessed): ?>

    <h2>Place Your Order</h2>

    <?php
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p class='error'>$error</p>";
        }
    }
    ?>

    <form method="POST">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Product:</label><br>
        <select name="product">
            <?php foreach ($products as $key => $value): ?>
                <option value="<?php echo $key; ?>">
                    <?php echo $key . " ($" . $value . ")"; ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Quantity:</label><br>
        <input type="number" name="quantity" min="1" required><br><br>

        <input type="submit" value="Submit Order">

    </form>

<?php else: ?>

    <h2 class="success">Order Successful!</h2>

    <p><strong>Name:</strong> <?php echo $name; ?></p>
    <p><strong>Email:</strong> <?php echo $email; ?></p>
    <p><strong>Product:</strong> <?php echo $product; ?></p>
    <p><strong>Price per item:</strong> $<?php echo $price; ?></p>
    <p><strong>Quantity:</strong> <?php echo $quantity; ?></p>
    <p><strong>Total:</strong> $<?php echo $total; ?></p>

<?php endif; ?>

</div>

</body>
</html>
