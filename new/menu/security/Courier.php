<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Courier Information</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      height: 100vh;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(135deg, #3498db, #9b59b6);
      animation: gradient-animation 10s ease infinite alternate;
    }

    @keyframes gradient-animation {
      0% {
        background-position: 0% 50%;
      }
      100% {
        background-position: 100% 50%;
      }
    }

    .form-container {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      max-width: 600px;
      width: 100%;
    }

    .form-column {
      flex: 1;
      min-width: 200px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
    }

    input, select {
      width: 100%;
      padding: 10px;
      box-sizing: border-box;
    }

    input[type="date"] {
      width: calc(100% - 20px);
    }

    input[type="radio"] {
      margin-right: 5px;
    }

    button {
      background-color: #4caf50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #45a049;
    }

    .back-button {
      background-color: #f44336;
      margin-right: 10px;
    }

    .back-button:hover {
      background-color: #d32f2f;
    }
  </style>
</head>
<body>
<div class="form-container">
  <div class="form-column">
    <form id="Courierform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <label for="slNo">SL NO:</label>
      <input type="text" id="slNo" name="slNo" required>
      
      <label for="recieved">Recieved:</label>
      <input type="text" id="recieved" name="recieved" required>
      
      <label for="to">To:</label>
      <input type="text" id="to" name="to" required>
  
      <label for="from">From:</label>
      <input type="text" id="from" name="from" required>
      
      <label for="productNo">Product No:</label>
      <input type="text" id="productNo" name="productNo" required>
      
      
  </div>

  <div class="form-column">
      <label for="mobileNumber">Mobile Number:</label>
      <input type="tel" id="mobileNumber" name="mobileNumber" pattern="[0-9]{10}" required>
      
      <label for="date">Date:</label>
      <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" required>

      <label for="time">Time:</label>
      <input type="text" id="time" name="time"  required>

      <label for="signature">Signature:</label>
      <input type="text" id="signature" name="signature"  required>
<br>
<br>
      <label>Sex:</label>
      <label for="male">Male</label>
      <input type="radio" id="male" name="sex" value="male" required>
      <label for="female">Female</label>
      <input type="radio" id="female" name="sex" value="female" required>
  
  </div>
  <button class="back-button" type="button" onclick="goBackToHomepage()">Back to Homepage</button>
  <button class="submit-button" type="button" onclick="submitForm()">Submit</button>
  </form>
</div>

<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "security";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare SQL statement to insert form data
    $stmt = $conn->prepare("INSERT INTO Courier (`SL NO`,`RECIVED`, `TOO`, `FROMM`, `PRODUCT NO`,`MOBILE NUMBER`,DATE, TIME, `SIGNATURE`, SEX) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("sssssissss", $slNo, $recieved, $to, $from, $productNo, $mobileNumber,$date, $time, $signature,$sex);

    // Set parameters and execute
    $slNo = $_POST['slNo'];
    $recieved = $_POST['recieved'];
    $to = $_POST['to'];
    $from = $_POST['from'];
    $productNo = $_POST['productNo'];
    $mobileNumber = $_POST['mobileNumber'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $signature = $_POST['signature'];
    $sex = $_POST['sex'];

    if ($stmt->execute()) {
      $success_message = "New record created successfully";
  } else {
      $error_message = "Error: " . $stmt->error;
  }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

<script>

function goBackToHomepage() {
  window.location.href = 'http://localhost/new/index.php'; // Replace 'https://example.com' with your homepage URL
}



function setCurrentTime() {
            var now = new Date();
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // Handle midnight (0 hours)
            minutes = minutes < 10 ? '0' + minutes : minutes;
            var timeString = hours + ':' + minutes + ' ' + ampm;
            document.getElementById('time').value = timeString;
        }

        // Call setCurrentTime function when the page loads
        window.onload = setCurrentTime;


function submitForm() {
  // Continue with form submission
  document.getElementById("Courierform").submit();
  if (form.checkValidity()) {
    // Mock submission (Replace this with your actual form submission logic)
    alert("Form submitted successfully!");
    form.reset(); // Reset the form after successful submission
  } else {
    form.reportValidity(); // Display validation messages if any
  }
}
</script>


</body>
</html>
