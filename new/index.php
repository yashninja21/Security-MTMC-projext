<!DOCTYPE html>
<html>
  <head>
    <title>College Website </title>
    <link href="Design.css" rel="stylesheet">
    <style>
      /* Additional styles for hiding the 'event' class */
      .event {
        transition: opacity 0.5s ease, transform 0.5s ease;
      }

      .event.transparent {
        opacity: 0.5;
      }

      .event.move-aside {
        transform: translateX(350px); /* Adjust the value based on your preference */
      }

      .event.transparent.move-aside {
        opacity: 0; /* Adjust the value for the desired transparency */
      }

      .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        z-index: 1;
        border: none; /* Remove border */
      }

      .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
      }

      .dropdown-content a:hover {
        background-color: #ddd;
      }

      .dropdown:hover .dropdown-content {
        display: block;
      }
    </style>
  </head>
  <body>
    <!---TOP-HEADER STARTS TOP-HEADER STARTS--->
    <div class="header">
      <div class="container">
        <b>NEWS : </b>
        <marquee> Today's Update  ---  Today's Update. </marquee>
      </div>
    </div>


    <div class="container">
      <!---LOGO SECTION ----->
      <img src="images/logo.png" class="logo">
      <!----MENU SECTION----->
      <nav>
        <a href="#">Home</a>
        <div class="dropdown" onmouseover="moveEventAside()" onmouseout="moveEventBack()">
        <a href="menu/dashboard/Dashboard.php">Dashboard</a>
        </div>
        <div class="dropdown" onmouseover="moveEventAside()" onmouseout="moveEventBack()">
          <a href="#">Security</a>
          <div class="dropdown-content">
            <a href="menu/security/Deployment.php"><span style="white-space: nowrap;">Deployment</span></a>
            <a href="menu/security/Visitors.php">Visitors</a>
            <a href="menu/security/MatOutgoing.php"><span style="white-space: nowrap;">Material Outgoing</span></a>
            <a href="menu/security/MatIncoming.php"><span style="white-space: nowrap;">Material Incoming</span></a>
            <a href="menu/security/LostFound.php"><span style="white-space: nowrap;">Lost & Found</span></a>
            <a href="menu/security/Courier.php"><span style="white-space: nowrap;">Courior</span></a>
          </div>
        </div>
        <div class="dropdown" onmouseover="moveEventAside()" onmouseout="moveEventBack()">
        <div class="dropdown-content">
          </div>
        </div>
        <div class="dropdown" onmouseover="moveEventAside()" onmouseout="moveEventBack()">
        <a href="#">Admin</a>
        <div class="dropdown-content">
        <a href="menu/Guest_house.php"><span style="white-space: nowrap;">Guest House</span></a>
        <a href="menu/House_Allotment.php"><span style="white-space: nowrap;">House Allotment</span></a>
        <a href="menu/House_Keeping.php"><span style="white-space: nowrap;">House Keeping</span></a>
        <a href="menu/Car_hire.php"><span style="white-space: nowrap;">Car Hire</span></a>
        <a href="menu/Hotel_Booking.php"><span style="white-space: nowrap;">Hotel Booking</span></a>
        <a href="menu/Past_Control.php"><span style="white-space: nowrap;">Pest Control</span></a>
        <a href="menu/Land_Esc.php"><span style="white-space: nowrap;">Land Escaping</span></a>
        <a href="menu/Room_Booking.php"><span style="white-space: nowrap;">Room Booking</span></a>
        <a href="menu/Land_Esc.php"><span style="white-space: nowrap;">Confreance</span></a>
        <a href="menu/Room_Booking.php"><span style="white-space: nowrap;">Cabin</span></a>
          </div>
        </div>
        
        <div class="dropdown" onmouseover="moveEventAside()" onmouseout="moveEventBack()">
        <a href="#">Engineering</a>
        <div class="dropdown-content">
        <a href="menu/AMNC.php"><span style="white-space: nowrap;">Annual Maintainance</span></a>
        <a href="menu/Utilities_manage.php"><span style="white-space: nowrap;">Utilities Managements</span></a>
        <a href="menu/House_Keeping.php"><span style="white-space: nowrap;">Raw Water</span></a>
        <a href="menu/Car_hire.php"><span style="white-space: nowrap;">Electricity</span></a>
        <a href="menu/Hotel_Booking.php"><span style="white-space: nowrap;">Diseal</span></a>
          </div>
        </div>
       
        <a href="http://localhost/complaint-management-system/Complaint%20Management%20System/index.html">HelpDesk</a>
      </nav>
    </div>

    <!-----SLIDER SECTION----->
    <div class="slider">
      <img src="images/slider.jpg">
    </div>
    <!----END SLIDER SECTION----->

    <div class="main-section" style="background:#f0f3fa">
      <div class="container">
        <!----key highlights----->
        <div class="event">
          <h2 class="heading">Key Highlight</h2>
          <div>
            <marquee direction="up" scrollamount="" style="height:340px;">
              <ul>
                 <li>
              <i>01-Sep-2024 :</i> This is info <img src="images/new.gif">
            </li>
            <li>
              <i>01-Sep-2024 :</i> This is info <img src="images/new.gif">
            </li>
            <li>
              <i>01-Sep-2024 :</i> This is info <img src="images/new.gif">
            </li>
            <li>
              <i>01-Sep-2024 :</i> This is info <img src="images/new.gif">
            </li>
            <li>
              <i>01-Sep-2024 :</i> This is info <img src="images/new.gif">
            </li>
            <li>
              <i>01-Sep-2024 :</i> This is info <img src="images/new.gif">
            </li>
            <li>
              <i>01-Sep-2024 :</i> This is info <img src="images/new.gif">
            </li>
            <li>
              <i>01-Sep-2024 :</i> This is info <img src="images/new.gif">
            </li>
            <li>
              <i>01-Sep-2024 :</i> This is info <img src="images/new.gif">
            </li>
              </ul>
            </marquee>
          </div>
        </div>
      </div>
    </div>


    <!---FOOTER SECTION--->

    <div class="footer">
      <div class="container">
        <div class="footer-sect">
          <img class="footer-logo" src="">
        </div>
        <div class="footer-sect">
          <address> Manipal Tata Medical College (MTMC) at Baridih, Jamshedpur, <br>East Singhbhum District of Jharkhand, 831017 </address>
        </div>
        <div class="footer-sect">
          <img src=""> +91 - 7432895239
        </div>
        <div class="footer-sect">
        <a href="https://www.manipal.edu/mtmc-jamshedpur.html">JAMSHEDPUR_MTMC.COM</a>
    </div>
   

<script>
  var isOverDropdown = false;

  function hideEvent() {
    var eventElement = document.querySelector('.event');
    eventElement.classList.toggle('hidden');
  }

  function moveEventAside() {
    var eventElement = document.querySelector('.event');
    eventElement.classList.add('move-aside', 'transparent');
  }

  function moveEventBack() {
    // Check if the mouse is still over the dropdown or its items
    if (!isOverDropdown) {
      var eventElement = document.querySelector('.event');
      eventElement.classList.remove('move-aside', 'transparent');
    }
  }

  // Event listener for dropdown mouseover
  document.querySelector('.dropdown').addEventListener('mouseover', function () {
    isOverDropdown = true;
    moveEventAside();
  });

  // Event listener for dropdown mouseout
  document.querySelector('.dropdown').addEventListener('mouseleave', function () {
    isOverDropdown = false;
    // Move event container back only if the mouse is not over the dropdown
    moveEventBack();
  });

  function hideDropdown() {
    var dropdownContent = document.querySelector('.dropdown-content');

    // Set pointer-events to none on dropdown content to allow interactions with elements below
    dropdownContent.style.pointerEvents = "none";
  }

  function showDropdown() {
    var dropdownContent = document.querySelector('.dropdown-content');

    // Set pointer-events to auto on dropdown content to restore normal interactions
    dropdownContent.style.pointerEvents = "auto";
  }


  
</script>
  </body>
</html>

