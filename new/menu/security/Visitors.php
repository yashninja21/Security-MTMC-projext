<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Visitor Information</title>
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
  </style>
</head>
<body>
<div class="form-container">
  <div class="form-column">
    <form id="visitorForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>
      
      <label for="nationalId">National ID:</label>
      <input type="text" id="nationalId" name="nationalId" required>

      <label for="vId">Visitors ID:</label>
      <input type="text" id="vId" name="vId" required>
      
      <label for="date">Date:</label>
      <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" required>
      
      <label for="mobileNumber">Mobile Number:</label>
      <input type="tel" id="mobileNumber" name="mobileNumber" pattern="[0-9]{10}" required>
  </div>
  
  <div class="form-column">
      <label for="purpose">Purpose to Visit:</label>
      <input type="text" id="purpose" name="purpose" required>
      
      <label for="personToMeet">Person to Meet:</label>
      <input type="text" id="personToMeet" name="personToMeet" required>
      
      <label for="numberOfPersons">Number of Persons:</label>
      <input type="number" id="numberOfPersons" name="numberOfPersons" min="1" required>
      
      <label>Sex:</label>
      <label for="male">Male</label>
      <input type="radio" id="male" name="sex" value="male" required>
      <label for="female">Female</label>
      <input type="radio" id="female" name="sex" value="female" required>
      
  </div>

  <button class="back-button" type="button" onclick="goBackToHomepage()">Back to Homepage</button>
  <button class="submit-button" type="submit">Submit</button>
 
  </form>
  </div>

<?php
$servername = "localhost"; // Change this if your MySQL server is running on a different host
$username = "root"; // Default username for XAMPP
$password = ""; // Default password for XAMPP (empty by default)
$dbname = "security"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare SQL statement to insert form data
    $stmt = $conn->prepare("INSERT INTO visitors (NAME, `NATIONAL ID`, `VISITORS ID`, date, `MOBILE NUMBER`, `PURPOSE TO VISIT`, `PERSON TO MEET`, `NUMBER OF PERSON`, SEX) VALUES (?, ?, ?, ?, ?, ?, ?,?,?)");

    // Bind parameters
    $stmt->bind_param("sssssssis", $name, $nationalId, $vId, $date, $mobileNumber, $purpose, $personToMeet, $numberOfPersons, $sex);

    // Set parameters and execute
    $name = $_POST['name'];
    $nationalId = $_POST['nationalId'];
    $vId=$_POST['vId'];
    $date = $_POST['date'];
    $mobileNumber = $_POST['mobileNumber'];
    $purpose = $_POST['purpose'];
    $personToMeet = $_POST['personToMeet'];
    $numberOfPersons = $_POST['numberOfPersons'];
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
// Function to go back to the previous page
function goBackToHomepage() {
  window.location.href = 'http://localhost/new/index.php'; // Replace 'https://example.com' with your homepage URL
}


// Function to submit the form and show a confirmation message
function submitForm() {
  var form = document.getElementById("visitorForm");
  if (form.checkValidity()) {
    // Mock submission (Replace this with your actual form submission logic)
    alert("Form submitted successfully!");
    form.reset(); // Reset the form after successful submission
  } else {
    form.reportValidity(); // Display validation messages if any
  }
}

// Function to dynamically set current time in 12-hour format
function setCurrentTime() {
  var now = new Date();
  var hours = now.getHours();
  var minutes = now.getMinutes();
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // Handle midnight (0 hours)
  minutes = minutes < 10 ? '0' + minutes : minutes;
  var timeString = hours + ':' + minutes + ' ' + ampm;
  document.getElementById('time').value = timeString;
}

// Call setCurrentTime function when the page loads
window.onload = setCurrentTime;


</script>

</body>
</html>
