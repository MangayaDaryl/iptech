<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session if not already started
}

// Database connection
try {
    $pdo = new PDO('mysql:host=localhost;dbname=ipt', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error connecting to the database: " . $e->getMessage());
}

// Retrieve the subtotal passed from cart.php
$subtotal = isset($_POST['subtotal']) ? (float)$_POST['subtotal'] : 0.00;

// After the payment is processed, insert the order into the database
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Assuming user is logged in and user_id is stored in session
    $order_status = 'completed';
    $order_date = date('Y-m-d H:i:s');

    // Prepare the order insertion
    $stmt = $pdo->prepare('INSERT INTO orders_tbl (user_id, product_id, quantity, total_price, status, order_date) VALUES (?, ?, ?, ?, ?, ?)');
    foreach ($_SESSION['shopping_cart_tbl'] as $product_id => $quantity) {
        $stmt->execute([
            $user_id,
            $product_id,
            $quantity,
            $subtotal,
            $order_status,
            $order_date
        ]);
    }

    // Clear the cart after order is placed
    unset($_SESSION['shopping_cart_tbl']);
}




// Retrieve the subtotal passed from cart.php
$subtotal = isset($_POST['subtotal']) ? (float)$_POST['subtotal'] : 0.00;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #023047;
            margin: 0;
            padding: 121px;
        }
        .container {
            max-width: 658px;
            margin: 36px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .form-section, .summary-section {
            padding: 20px;
        }
        .summary-section {
            background-color: #f8f9fa;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .btn-primary {
            width: 100%;
        }
        .form-title {
            margin-bottom: 20px;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .list-group-item:hover {
            cursor: pointer;
            background-color: #f0f0f0;
        }
        #autocomplete-results {
            position: absolute;
            z-index: 1000;
            max-height: 200px;
            overflow-y: auto;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .custom-heading {
        font-family: 'Georgia', serif; /* Example: Use Georgia font */
        font-size: 37px; /* Adjust size */
        font-weight: bold; /* Make it bold */
        color: #333; /* Change the color */
    }
    .form-control {
    display: block;
    width: 100%;
    margin-top: 7px;
    padding: 10.375px 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #ffffff;
    background-clip: padding-box;
    border: 1.5px solid #9c8d8d;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 10px;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}
/* Default button style with gradient background */
.btn-primary {
    background: linear-gradient(45deg, #ff6a00, #ee0979); /* Gradient from orange to pink */
    border: none;  /* Remove default border */
    color: white;  /* White text color */
    padding: 10px 20px;  /* Adjust padding for button size */
    font-size: 16px;  /* Font size */
    border-radius: 5px;  /* Rounded corners */
    cursor: pointer;  /* Pointer cursor on hover */
    transition: background 0.3s ease, transform 0.3s ease;  /* Smooth transition for hover effects */
}

/* Hover effect */
.btn-primary:hover {
    background: linear-gradient(45deg, #ee0979, #ff6a00);  /* Inverted gradient */
    transform: scale(1.05);  /* Slightly enlarge the button */
}

    </style>
</head>
<body>
    <div class="container">
    <h2 class="custom-heading">Payment Details</h2>
    <br>
        <form action="send.php" method="post">
            <div class="form-group">
               <b></v> <label for="full_name">Full Name:</label></b>
                <input type="text" id="full_name" name="full_name" class="form-control" placeholder="Enter your full name" required>
            </div>
           
            <div class="form-group">
            <b><label for="email">Email:</label></b>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
            <b><label for="address">Address:</label></b>
                 <input type="text" id="address" name="address" class="form-control" placeholder="Search for your address" required>
                 <ul id="autocomplete-results" class="list-group"></ul>
            </div>

            <div class="form-group">
    <b><label for="card_number">Card Number:</label></b>
    <input type="text" id="card_number" name="card_number" class="form-control" placeholder="**** **** **** ****" maxlength="19" pattern="^(\d{4}[\s]?)\d{0,4}([\s]?\d{0,4}){0,3}$" required oninput="formatCardNumber(this)">
</div>
            <div class="form-group">
                <b><label for="subtotal">Total:</label></b>
                <input type="hidden" name="subtotal" value="<?php echo $subtotal; ?>">
                <input type="text" id="subtotal_display" class="form-control" value="&#8369; <?php echo number_format($subtotal, 2); ?>" readonly>
            </div>
           
            <button type="submit" name="send" class="btn btn-primary">Pay Now</button>

        </form>
    </div>
</body>
</html>

<script>
    const addressInput = document.getElementById("address");
    const resultsContainer = document.getElementById("autocomplete-results");

    // Debounce function to limit API requests
    let timeout;
    function debounce(func, delay) {
        clearTimeout(timeout);
        timeout = setTimeout(func, delay);
    }

    // Fetch suggestions from Nominatim
    function fetchSuggestions(query) {
        const url = `https://nominatim.openstreetmap.org/search?format=json&addressdetails=1&q=${encodeURIComponent(query)}&limit=5`;
        
        fetch(url)
            .then(response => response.json())
            .then(data => {
                resultsContainer.innerHTML = ""; // Clear previous results
                if (data.length > 0) {
                    data.forEach(item => {
                        const suggestion = document.createElement("li");
                        suggestion.className = "list-group-item";
                        suggestion.textContent = item.display_name;
                        suggestion.addEventListener("click", () => {
                            addressInput.value = item.display_name;
                            resultsContainer.innerHTML = ""; // Clear suggestions after selection
                        });
                        resultsContainer.appendChild(suggestion);
                    });
                }
            })
            .catch(error => console.error("Error fetching suggestions:", error));
    }

    // Event listener for address input
    addressInput.addEventListener("input", () => {
        const query = addressInput.value;
        if (query.length > 2) {
            debounce(() => fetchSuggestions(query), 300); // Call API after 300ms delay
        } else {
            resultsContainer.innerHTML = ""; // Clear suggestions for short input
        }
    });




    function formatCardNumber(input) {
        let value = input.value.replace(/\D/g, '');  // Remove non-digit characters
        if (value.length > 4) {
            value = value.replace(/(\d{4})(?=\d)/g, '$1 ');  // Add space every 4 digits
        }
        input.value = value;
    }



</script>
<style>
    #autocomplete-results {
        max-height: 200px;
        overflow-y: auto;
        background-color: #fff;
        border: 1px solid #fff;
        border-radius: 4px;
        margin-top: -3px;
        position: absolute;
        z-index: 1000;
        width: 30.7%;
    }
    .list-group-item {
        cursor: pointer;
        padding: 10px;
    }
    .list-group-item:hover {
        background-color: #f0f0f0;
    }
</style>
