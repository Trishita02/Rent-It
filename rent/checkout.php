<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details & Billing</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif; /* Premium font style */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(to right, #088169, #088198); /* Gradient background */
        }

        .container {
            display: flex;
            flex-direction: row;
            max-width: 1000px; /* Increased width */
            width: 95%;
            height: 20%; /* Reduced height */
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: box-shadow 0.3s;
        }

        .container:hover {
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.4);
        }

        .user-details {
            flex: 1;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 10px 0 0 10px;
        }

        .billing-details {
            flex: 1;
            padding: 10px;
            background-color: #e0e0e0;
            border-radius: 0 10px 10px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            background-image: url('payment.avif'); /* Background image */
            background-size: cover; /* Ensure background image covers the entire area */
            background-position: center; /* Center the background image */
            color: #333; /* Text color */
            overflow: hidden;
        }

        .billing-details::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255,0.6); /* Semi-transparent white overlay */
            z-index: 1;
        }

        .billing-details h2,
        .billing-amount,
        .pay-now-btn {
            position: relative;
            z-index: 2;
        }

        .billing-amount {
            margin-bottom: 10px;
            font-size: 26px;
            padding:10px;
            color: #333;
            text-align: center;
        }

        .pay-now-btn {
            padding: 12px 32px; /* Increased padding */
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
        }

        .pay-now-btn:hover {
            background-color: #45a049;
        }

        .form-group {
            margin-bottom: 8px; 
        }

        label {
            display: block;
            margin-bottom: 3px;
            color: #333;
            font-size: 14px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        textarea {
            width: calc(100% - 20px);
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            transition: border-color 0.3s;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus,
        textarea:focus {
            outline: none;
            border-color: #4caf50;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="user-details">
            <h2>User Details</h2>
            <form> 
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" required maxlength="10">
            </div>
            <div class="form-group">
                <label for="altPhone">Alternative Phone Number:</label>
                <input type="tel" id="altPhone" name="altPhone" maxlength="10">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address" rows="3" required style="resize:none;"></textarea>
            </div>
            <div class="form-group">
                <label for="pincode">Pincode:</label>
                <input type="text" id="pincode" name="pincode" required>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" required>
            </div>
            <div class="form-group">
                <label for="landmark">Landmark:</label>
                <input type="text" id="landmark" name="landmark">
            </div>
        </div>
        <div class="billing-details">
            <h2>Amount to pay</h2>
            <div class="billing-amount">&#x20B9; 335</div>
            <input type="button" class="pay-now-btn" value="Pay" style="cursor:pointer" onclick="pay_now()">
        </div>
    </form>
    </div>
</body>
</html>
