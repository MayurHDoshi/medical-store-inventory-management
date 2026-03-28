<!DOCTYPE html>
<html>
<head>
    <title>MYM - Generated Bill</title>
    <link rel="stylesheet" href="00.main.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        .btn1{
            background-color: #980328;
            color: #f0f5f9;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            width: 11vw;
            height: 7vh;
            font-size: 1.30rem;
            font-family: 'CP';
        }
        th, td {
            border: 2px solid #dddddd;
            text-align: left;
            padding: 8px;
            text-align: center; 
        }
        th{
            color: #980328;
        }
           
        @media print {
            .btn1 {
                display: none;
            }
        }
        
        footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            color: #980328;
            text-align: center;
            padding: 10px;
            /* background-color: #F0F5F9; */
        }
        .footer-left {
            float: left;
        }
        .footer-right {
            float: right;
        }
    </style>
</head>
<body>
    <h1 align="center">Generated Bill</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Cost</th>
            </tr>
        </thead>
        <tbody>
            <?php
            date_default_timezone_set('Asia/Kolkata'); // Set the timezone to India Standard Time (IST)

            $totalCost = 0;
            if (isset($_GET['data'])) {
                $data = json_decode($_GET['data'], true);
                foreach ($data as $item) {
                    $name = $item['name'];
                    $price = floatval($item['price']);
                    $quantity = isset($item['quantity']) ? intval($item['quantity']) : 0;
                    $itemTotal = $price * $quantity;
                    $totalCost += $itemTotal; // Calculate total cost
                    echo "<tr>";
                    echo "<td>{$name}</td>";
                    echo "<td>{$price}</td>"; // Display price
                    echo "<td>{$quantity}</td>";
                    echo "<td>{$itemTotal}</td>"; // Show individual item total cost
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td><?php echo number_format($totalCost, 2); ?></td>
            </tr>
        </tfoot>
    </table>
    <br>
    <center>
    <a href="03.billing.php"><button type="button" class="btn1">Back</button></a>
    <button onclick="window.print();" class="btn1">Print</button>
    </center>

    <footer>
        <div>
            <?php echo date("F j, Y, g:i a"); ?> <!-- Display current date and time -->
        </div>
        <div>
            <p>MYM Medical © 2024 - All rights reserved.</p>
        </div>
    </footer>
            
</body>
</html>