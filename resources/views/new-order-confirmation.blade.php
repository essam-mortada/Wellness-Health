<!DOCTYPE html>
<html>
<head>
    <title>New Order Confirmation</title>
</head>
<body>
    <h1>New Order Confirmation</h1>
    <p>Order Details:</p>
    <ul>
        <li><strong>Order ID:</strong> {{ $order['id'] }}</li>
        <li><strong>First Name:</strong> {{ $order['first_name'] }}</li>
        <li><strong>Last Name:</strong> {{ $order['last_name'] }}</li>
        <li><strong>Email:</strong> {{ $order['email'] }}</li>
        <li><strong>Phone:</strong> {{ $order['phone'] }}</li>
        <li><strong>Country:</strong> {{ $order['country'] }}</li>
        <li><strong>City:</strong> {{ $order['city'] }}</li>
        <li><strong>Street:</strong> {{ $order['street'] }}</li>
        <li><strong>Floor:</strong> {{ $order['floor'] }}</li>
        <li><strong>Delivery:</strong> {{ $order['delivery'] }}</li>
        <li><strong>Payment Method:</strong> {{ $order['payment'] }}</li>
        <li><strong>Total Price:</strong> {{ $order['total_price'] }}</li>
    </ul>
</body>
</html>
