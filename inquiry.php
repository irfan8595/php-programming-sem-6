<?php
$messageSent = "";

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$dbname = "inquiry_db";

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize input
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    if (!empty($name) && !empty($email) && !empty($message)) {

        // Insert into database
        $sql = "INSERT INTO inquiries (name, email, message) 
                VALUES ('$name', '$email', '$message')";

        if ($conn->query($sql) === TRUE) {
            $messageSent = "✅ Saved to database successfully!";
        } else {
            $messageSent = "❌ Error: " . $conn->error;
        }

    } else {
        $messageSent = "⚠️ All fields are required.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inquiry Form</title>
</head>
<body>

<h2>Inquiry Form</h2>

<?php if (!empty($messageSent)) { ?>
    <p><?php echo $messageSent; ?></p>
<?php } ?>

<form method="POST">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Message:</label><br>
    <textarea name="message" required></textarea><br><br>

    <input type="submit" value="Submit">
</form>

</body>
</html>