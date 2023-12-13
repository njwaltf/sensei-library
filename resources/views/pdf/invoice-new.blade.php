<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .invoice {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .invoice-header,
        .invoice-footer {
            background-color: #5D87FF;
            color: #fff;
            padding: 10px;
            text-align: center;
            width: 100%;
        }

        .invoice-body {
            flex-grow: 1;
            padding: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #5D87FF;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #5D87FF;
            color: #fff;
        }

        .qr-code-container {
            text-align: center;
            margin-right: 20px;
            border: 2px solid #5D87FF;
            padding: 10px;
        }

        .book-image {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="invoice">
        <div class="invoice-header">
            <h2>Invoice</h2>
        </div>

        <div class="invoice-body">
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Book Title:</td>
                        <td>JavaScript for Beginners</td>
                    </tr>

                    <tr>
                        <td>Amount:</td>
                        <td>$25.00</td>
                    </tr>

                    <tr>
                        <td>Customer Name:</td>
                        <td>Gojo Satoru</td>
                    </tr>

                    <tr>
                        <td>Transaction Date:</td>
                        <td>2023-12-13</td>
                    </tr>

                    <tr>
                        <td>Customer Email:</td>
                        <td>john.doe@example.com</td>
                    </tr>

                    <!-- Add more details as needed -->

                </tbody>
            </table>

            <div class="qr-code-container">
                <!-- Your QR code image -->
                <img src="data:image/png;base64, {!! base64_encode(QrCode::size(100)->generate('http://127.0.0.1:8000/dashboard/bookings/' . 1 . '/edit')) !!} " alt="QR Code">
            </div>

            <div class="book-image">
                <!-- Add your book image source here -->
                <img src="{{ asset('book-image/cover.jpg') }}" alt="Book Image">
            </div>

            <div class="item total">
                <span>Total:</span>
                <span>$25.00</span>
            </div>
        </div>

        <div class="invoice-footer">
            <p>Thank you for your business!</p>
        </div>
    </div>
</body>

</html>
