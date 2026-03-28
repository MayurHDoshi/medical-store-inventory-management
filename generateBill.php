<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MYM - Generated Bill</title>
    <link rel="stylesheet" href="00.main.css" />
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
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
        .btn{
            background-color: #980328;
            padding: 0px;
            margin-bottom: 0px;
            margin-top: 0px;
            margin-left: 0px;
            margin-right: 0px;
            color: #F0F5F9;
            border: none;
            display: inline-block;
            border-radius: 5px;
            cursor: pointer;
            width: 14vw;
            height: 7vh;
            font-size: 1.5rem;
            font-family: 'CP';
            align-items: center;
        }   
        @media print {
            .btn1 {
                display: none;
            }
        }
        .btn1{
            background-color:  #980328;
            color: #F0F5F9;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            width: 11vw;
            height: 7vh;
            font-size: large;
            font-family: 'CP';
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
                    $price = floatval($item['price']);
                    $quantity = isset($item['quantity']) ? intval($item['quantity']) : 0;
                    $totalItemCost = $price * $quantity; // Calculate total cost
                    $totalCost += $totalItemCost; // Update total cost
                    echo "<tr>";
                    echo "<td>{$item['name']}</td>";
                    echo "<td>{$price}</td>"; // Display price
                    echo "<td>{$quantity}</td>";
                    echo "<td>{$totalItemCost}</td>"; // Show individual item total cost
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
        <a href="03.billing.php"><button type="button" class="btn1">Go Back</button></a>
        <button onclick="window.print();" class="btn1">Print Bill</button>
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
