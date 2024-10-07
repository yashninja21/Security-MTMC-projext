<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lost&Found Information</title>
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

    /* Added style for search button */
    .search-button {
      background-color: #3498db;
    }

    .search-button:hover {
      background-color: #2980b9;
    }
  </style>
</head>
<body>
<div class="form-container">
  <div class="form-column">
    <form id="LostFoundform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
      <label for="slNo">SL NO:</label>
      <input type="text" id="slNo" name="slNo" required>
      
      <label for="material">Material Details:</label>
      <input type="text" id="material" name="material" required>
      
      <label for="handover">Handover:</label>
      <input type="text" id="handover" name="handover" required>
  
      <label for="recived">Received:</label>
      <input type="text" id="recived" name="recived" required>
      
      <label for="location">Location:</label>
      <input type="text" id="location" name="location" required>
      
      <label for="signature">Signature:</label>
      <input type="text" id="signature" name="signature" required>
      
      <label for="picture">Upload Picture:</label>
      <input type="file" id="picture" name="picture" accept="image/*">
      
      
  </div>

  <div class="form-column">
      <label for="mobileNumber">Mobile Number:</label>
      <input type="tel" id="mobileNumber" name="mobileNumber" pattern="[0-9]{10}" required>
      
      <label for="date">Date:</label>
      <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" required>

      <label for="time">Time:</label>
      <input type="text" id="time" name="time" required><br>

      <label id="sexLabel">Sex:</label>
      <label for="male">Male</label>
      <input type="radio" id="male" name="sex" value="male" required>
      <label for="female">Female</label>
      <input type="radio" id="female" name="sex" value="female" required><br>
  </div>
  <button class="back-button" type="button" onclick="goBackToHomepage()">Back to Homepage</button>
  <button type="button" id="submitButton" onclick="submitForm()" style="display:none;">Submit</button>
  <button type="button" id="findButton" onclick="toggleSearch()">Find</button>
  <div id="searchButtonContainer"></div>
  </form>
</div>
<div id="imageContainer"></div>

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
    $stmt = $conn->prepare("INSERT INTO Lost_Found (`SL NO`, `MATERIAL DETAILS`, `HANDOVER`,`RECIVED`, `LOCATION`, `SIGNATURE`, `IMAGE`,`MOBILE NUMBER`, DATE, TIME, SEX) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("sssssssisss", $slNo, $material, $handover, $recived, $location, $signature, $picture, $mobileNumber, $date, $time, $sex);

    // Set parameters and execute
    $slNo = $_POST['slNo'];
    $material = $_POST['material'];
    $handover = $_POST['handover'];
    $recived = $_POST['recived'];
    $location = $_POST['location'];
    $signature = $_POST['signature'];
    $mobileNumber = $_POST['mobileNumber'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $sex = $_POST['sex'];


  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'sex' field is set before accessing it
    $sex = isset($_POST['sex']) ? $_POST['sex'] : "";

    // Rest of the code remains the same
}

// Check if a file is uploaded
if ($_FILES['picture']['error'] === UPLOAD_ERR_OK) {
  // Define the target directory where the file will be stored
  $targetDir = __DIR__ . "/uploads/";

  // Ensure that the directory exists, if not, create it
  if (!file_exists($targetDir)) {
      mkdir($targetDir, 0755, true);
  }

  // Generate a unique filename to prevent overwriting existing files
  $targetFileName = uniqid() . '_' . basename($_FILES["picture"]["name"]);
  $targetFile = $targetDir . $targetFileName;

  // Move the uploaded file to the target directory
  if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFile)) {
      // File upload successful, set the $picture variable to the target file path
      $picture = $targetFile;
  } else {
      // File upload failed, set the $picture variable to an empty string
      $picture = "";
      $error_message = "Failed to move uploaded file.";
  }
} else {
  // No file uploaded or an error occurred, set the $picture variable to an empty string
  $picture = "";
  $error_message = "File upload error: " . $_FILES['picture']['error'];
}


    // Execute the SQL statement
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
    // Check form validity using custom validation function
    if (validateForm()) {
        // Continue with form submission
        document.getElementById("LostFoundform").submit();
        // Mock submission (Replace this with your actual form submission logic)
        alert("Form submitted successfully!");
        // Reset the form after successful submission
        document.getElementById("LostFoundform").reset();
    } else {
        // Display validation messages if any
        alert("Please fill out all required fields.");
    }
}

function toggleSearch() {
  var findButton = document.getElementById("findButton");
  var submitButton = document.getElementById("submitButton");
  var inputBoxes = document.querySelectorAll('.form-column input');
  var sexLabel = document.getElementById("sexLabel");
  var searchButtonContainer = document.getElementById("searchButtonContainer");
  
  if (findButton.innerHTML === "Find") {
    findButton.innerHTML = "Back";
    submitButton.style.display = "none";
    sexLabel.style.display = "none";
    searchButtonContainer.innerHTML = '<button class="search-button" type="button" onclick="search()">Search</button>';
    for (var i = 0; i < inputBoxes.length; i++) {
      if (inputBoxes[i].id !== 'material') {
        inputBoxes[i].style.display = "none";
        inputBoxes[i].previousElementSibling.style.display = "none"; // Hide the label
      }
    }
  } else {
    findButton.innerHTML = "Find";
    submitButton.style.display = "block";
    sexLabel.style.display = "block";
    searchButtonContainer.innerHTML = ''; // Remove search button
    for (var i = 0; i < inputBoxes.length; i++) {
      inputBoxes[i].style.display = "block";
      inputBoxes[i].previousElementSibling.style.display = "block"; // Show the label
    }
  }
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
window.onload = function() {
  setCurrentTime();
  var submitButton = document.getElementById("submitButton");
  submitButton.style.display = "block"; // Ensure submit button is initially visible
};

function validateForm() {
    var slNo = document.getElementById("slNo").value;
    var material = document.getElementById("material").value;
    var handover = document.getElementById("handover").value;
    var received = document.getElementById("recived").value;
    var location = document.getElementById("location").value;
    var signature = document.getElementById("signature").value;
    var picture = document.getElementById("picture").value;
    var mobileNumber = document.getElementById("mobileNumber").value;
    var date = document.getElementById("date").value;
    var time = document.getElementById("time").value;
    var sex = document.querySelector('input[name="sex"]:checked');

    if (slNo === "" || material === "" || handover === "" || received === "" || location === "" || signature === "" || picture === "" || mobileNumber === "" || date === "" || time === "" || sex === null) {
        alert("Please fill out all required fields");
        return false;
    }
    return true;
}

function search() {
  // Your search logic here
  alert("Search functionality will be implemented here.");
}

</script>



</body>
</html>
