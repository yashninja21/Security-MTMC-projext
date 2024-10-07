<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gate Pass Information</title>
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

    .submit-button {
      background-color: #3498db;
    }

    .submit-button:hover {
      background-color: #2980b9;
    }

    .hidden {
      display: none;
    }
  </style>
</head>
<body>
<div class="form-container">
  <div class="form-column">
    <form id="gatePassForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="gatepassno">Gate Pass No:</label>
  <select id="gatePassno" name="gatePassno">
    <option value="gate1">Gate1</option>
    <option value="gate2">Gate2</option>
    <option value="gate3">Gate3</option>
    <option value="gate4">Gate4</option>
  </select>
      
      <label for="date">Date:</label>
      <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" required>
     
      <label for="from">From:</label>
      <input type="text" id="from" name="from" required>
      
      <label for="to">To:</label>
      <input type="text" id="to" name="to" required>
      
      <label for="material">Material:</label>
      <input type="text" id="material" name="material" required>
      
      <label for="quantity">Quantity:</label>
      <input type="text" id="quantity" name="quantity" required>

      </div>
  
      <div class="form-column">

      <label for="sender">Sender:</label>
      <input type="text" id="sender" name="sender" required>
      
      <label for="purpose">Purpose:</label>
      <input type="text" id="purpose" name="purpose" required>

      <label for="vehicle">Vehicle No:</label>
      <input type="text" id="vehicle" name="vehicle" required>

      <label for="driver">Driver:</label>
      <input type="text" id="driver" name="driver" required>
      
      <label for="gatePassType">Gate Pass Type:</label>
      <select id="gatePassType" name="gatePassType" onchange="toggleReturnDate()">
        <option value="nrgp">NRGP</option>
        <option value="rgp">RGP</option>
      </select>
      
      <label for="returnDate" id="returnDateLabel" class="hidden">Return Date:</label>
      <input type="date" id="returnDate" name="returnDate" value="<?php echo date('Y-m-d'); ?>" class="hidden">
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
    $stmt = $conn->prepare("INSERT INTO material_outgoing (`GATE PASS NO`, `DATE`, `FROMM`, `TOO`, `MATERIAL`, `QUANTITY`, `SENDER`, `PURPOSE`, `VEHICLE NO`, `DRIVER`, `GATE PASS TYPE`, `RETURN DATE`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("ssssssssssss", $gatePassNo, $date, $from, $to, $material, $quantity, $sender, $purpose, $vehicleNo, $driver, $gatePassType, $returnDate);

    // Set parameters and execute
    $gatePassNo = $_POST['gatePassno'];
    $date = $_POST['date'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $material = $_POST['material'];
    $quantity = $_POST['quantity'];
    $sender = $_POST['sender'];
    $purpose = $_POST['purpose'];
    $vehicleNo = $_POST['vehicle'];
    $driver = $_POST['driver'];
    $gatePassType = $_POST['gatePassType'];

    // Check if the gate pass type is RGP to include the return date
    if ($gatePassType === "rgp") {
        $returnDate = $_POST['returnDate'];
    } else {
        $returnDate = null; // Set return date to null for NRGP
    }

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

function submitForm() {
  // Continue with form submission
  document.getElementById("gatePassForm").submit();
  if (form.checkValidity()) {
    // Mock submission (Replace this with your actual form submission logic)
    alert("Form submitted successfully!");
    form.reset(); // Reset the form after successful submission
  } else {
    form.reportValidity(); // Display validation messages if any
  }
}

function toggleReturnDate() {
  var gatePassType = document.getElementById("gatePassType").value;
  var returnDateLabel = document.getElementById("returnDateLabel");
  var returnDateInput = document.getElementById("returnDate");

  if (gatePassType === "rgp") {
    returnDateLabel.classList.remove("hidden");
    returnDateInput.classList.remove("hidden");
  } else {
    returnDateLabel.classList.add("hidden");
    returnDateInput.classList.add("hidden");
  }
}


</script>

</body>
</html>
