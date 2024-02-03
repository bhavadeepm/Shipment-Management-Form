<?php
$host = 'localhost';
$dbname = 'shipment_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $shipmentNo = $_POST['shipmentNo'];
        $description = $_POST['description'];
        $source = $_POST['source'];
        $destination = $_POST['destination'];
        $shippingDate = $_POST['shippingDate'];
        $expectedDeliveryDate = $_POST['expectedDeliveryDate'];

        $sql = "INSERT INTO SHIPMENT_TABLE (SHIPMENT_NO, DESCRIPTION, SOURCE, DESTINATION, SHIPPING_DATE, EXPECTED_DELIVERY_DATE) 
                VALUES (:shipmentNo, :description, :source, :destination, :shippingDate, :expectedDeliveryDate)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':shipmentNo', $shipmentNo);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':source', $source);
        $stmt->bindParam(':destination', $destination);
        $stmt->bindParam(':shippingDate', $shippingDate);
        $stmt->bindParam(':expectedDeliveryDate', $expectedDeliveryDate);

        $stmt->execute();

        echo "Shipment data saved successfully";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Shipment Management Form</title>
<style>
    form {
        max-width: 400px;
        margin: 0 auto;
    }
    .form-group {
        margin-bottom: 1rem;
    }
    label {
        display: block;
        margin-bottom: 0.5rem;
    }
    input[type="text"], input[type="date"] {
        width: 100%;
        padding: 0.5rem;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
    input[type="submit"], button {
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 5px;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
    }
    button {
        margin-left: 1rem;
        background-color: #dc3545;
    }
</style>
</head>
<body>

<form id="shipmentForm" method="post">
    <div class="form-group">
        <label for="shipmentNo">Shipment No.:</label>
        <input type="text" id="shipmentNo" name="shipmentNo" required>
    </div>
    <div class="form-group">
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required>
    </div>
    <div class="form-group">
        <label for="source">Source:</label>
        <input type="text" id="source" name="source" required>
    </div>
    <div class="form-group">
        <label for="destination">Destination:</label>
        <input type="text" id="destination" name="destination" required>
    </div>
    <div class="form-group">
        <label for="shippingDate">Shipping Date:</label>
        <input type="date" id="shippingDate" name="shippingDate" required>
    </div>
    <div class="form-group">
        <label for="expectedDeliveryDate">Expected Delivery Date:</label>
        <input type="date" id="expectedDeliveryDate" name="expectedDeliveryDate" required>
    </div>
    <input type="submit" value="Save" id="saveBtn">
    <button type="button" id="updateBtn" disabled>Update</button>
    <button type="button" id="resetBtn">Reset</button>
</form>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('resetBtn').addEventListener('click', function() {
            document.getElementById("shipmentForm").reset();
        });
    });
</script>

</body>
</html>
