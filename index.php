<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .navbar ul {
            list-style-type: none;
            width: 100%;
            background-color: rgb(121, 118, 118);
            padding: 0;
            margin: 0;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
        }
        .navbar a {
            text-decoration: none;
            color: white;
            display: block;
            text-align: center;
            padding: 15px;
        }
        .navbar a:hover {
            background-color: rgb(32, 16, 16);
        }
        .navbar li {
            float: right;
        }
        .main img {
            width: 100%;
            height: auto;
        }
        .donorinfo, .donorinfos {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }
        .donorinfo img, .donorinfos img {
            width: 400px;
            height: 300px;
            margin: 100px;
            padding: 10px;
            border-radius: 13px;
            box-shadow: 0px 0px 10px black;
            cursor: pointer;
            transition: 0.15s;
        }
        .donorinfo img:hover, .donorinfos img:hover {
            filter: brightness(1);
            transform: scale(1.03);
        }
        .de h3, .he h3, .des h3, .hes h3 {
            font-size: 25px;
            margin-left: 40px;
        }
        form {
            margin: 50px;
        }
        label {
            font-weight: bold;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .message {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <ul>
            <li><a href="logout.php">Logout</a></li>
            <li><a href="aboutus.php">About Us</a></li>
            <li><a href="searchbloodbank.php">Blood Banks</a></li>
            <li><a href="request.php">Request</a></li>
            <li><a href="#">Home</a></li>
        </ul>
    </nav>

    <div class="main">
        <img src="blood6.jpg" alt="Blood Bank">
    </div>

    <div class="donorinfo">
        <a href="#donorForm"><img src="pdi.jpg" alt="Post Donor Info"></a>
        <a href="#"><img src="mydon.jpg" alt="My Donor Info"></a>
    </div>
    <div class="de">
        <h3>Post Donor Info</h3>
    </div>
    <div class="he">
        <h3>My Donor Info</h3>
    </div>

    <!-- Donor Form Section -->
    <section id="donorForm">
        <h2>Post Donor Information</h2>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['donorName'];
            $age = $_POST['donorAge'];
            $bloodGroup = $_POST['donorBloodGroup'];
            $contact = $_POST['donorContact'];
            $email = $_POST['donorEmail'];
            $address = $_POST['donorAddress'];

            // Database connection (update with your own credentials)
            $conn = new mysqli('localhost', 'username', 'password', 'blood_bank');

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "INSERT INTO donors (name, age, bloodGroup, contact, email, address) 
                    VALUES ('$name', '$age', '$bloodGroup', '$contact', '$email', '$address')";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='message'>New donor record created successfully</div>";
            } else {
                echo "<div class='message'>Error: " . $sql . "<br>" . $conn->error . "</div>";
            }

            $conn->close();
        }
        ?>

        <form action="#donorForm" method="POST">
            <label for="donorName">Name:</label><br>
            <input type="text" id="donorName" name="donorName" required><br><br>

            <label for="donorAge">Age:</label><br>
            <input type="number" id="donorAge" name="donorAge" min="18" required><br><br>

            <label for="donorBloodGroup">Blood Group:</label><br>
            <select id="donorBloodGroup" name="donorBloodGroup" required>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select><br><br>

            <label for="donorContact">Contact Number:</label><br>
            <input type="tel" id="donorContact" name="donorContact" pattern="[0-9]{10}" required><br><br>

            <label for="donorEmail">Email:</label><br>
            <input type="email" id="donorEmail" name="donorEmail" required><br><br>

            <label for="donorAddress">Address:</label><br>
            <textarea id="donorAddress" name="donorAddress" rows="4" cols="50" required></textarea><br><br>

            <input type="submit" value="Submit">
        </form>
    </section>

</body>
</html>
