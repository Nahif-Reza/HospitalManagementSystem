<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'db_online');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_nid = $_SESSION['user_nid'];

// Fetch user and transaction details
$query = "
    SELECT 
        tb_u.Name, 
        tb_u.Address, 
        tb_u.P_number, 
        tb_um.name AS product_name, 
        tb_um.price, 
        tb_um.quantity, 
        tb_um.total, 
        tb_um.total_amount
    FROM 
        tb_u
    INNER JOIN 
        tb_um
    ON 
        tb_u.Nid = tb_um.c_nid
    WHERE tb_u.Nid = '$user_nid'";

    $result = $conn->query($query);

if ($result->num_rows === 0) {
    die("No records found for this user.");
}

$order = $result->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            color: white;
            background-color: #d32f2f;
            padding: 20px;
            border-radius: 8px 8px 0 0;
        }

        .header h1 {
            margin: 0;
            font-size: 1.8rem;
        }

        .header p {
            margin: 5px 0;
        }

        .details {
            margin: 20px 0;
        }

        .details h2 {
            text-align: left;
            margin-bottom: 10px;
            color: #d32f2f;
        }

        .details p {
            margin: 5px 0;
            line-height: 1.6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #d32f2f;
            color: white;
        }

        .totals {
            margin-top: 20px;
            font-size: 1rem;
            text-align: right;
        }

        .totals p {
            margin: 5px 0;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #d32f2f;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
        }

        .btn:hover {
            background-color: #b71c1c;
        }

        @media print {
            .btn {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>TechWave Solutions</h1>
            <p>123 Innovation Blvd, Techville, CA 54321 | (555) 123-4567</p>
        </div>

        <div class="details">
            <h2>Payment Receipt</h2>
            <p><strong>Sold To:</strong> <?php echo $order['Name']; ?></p>
            <p><strong>Address:</strong> <?php echo $order['Address']; ?></p>
            <p><strong>Phone Number:</strong> <?php echo $order['P_number']; ?></p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $order['product_name']; ?></td>
                    <td><?php echo $order['quantity']; ?></td>
                    <td>$<?php echo number_format($order['price'], 2); ?></td>
                    <td>$<?php echo number_format($order['total'], 2); ?></td>
                </tr>
            </tbody>
        </table>

        <div class="totals">
            <p><strong>Subtotal:</strong> $<?php echo number_format($order['total_amount'], 2); ?></p>
            <p><strong>Tax Rate:</strong> 7%</p>
            <p><strong>Tax Amount:</strong> $<?php echo number_format($order['total_amount'] * 0.07, 2); ?></p>
            <p><strong>Total Amount Due:</strong> $<?php echo number_format($order['total_amount'] * 1.07, 2); ?></p>
        </div>

        <a href="dashboard.html" class="btn">Go to Dashboard</a>
    </div>
</body>
</html>