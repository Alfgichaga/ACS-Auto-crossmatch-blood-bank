<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ACS BloodBank</title>
  <link rel="stylesheet" href="home.css">
</head>
<body>
  <button class="logout-button" onclick="logout()">Logout</button>

  <div class="container swiper">
    <div class="slider-wrapper">
      <div class="card-list">
        <div class="card-item">
          <img src="Blooddonor.jpg" alt="User Image" class="user-image">
          <h2 class="user-name">Blood Donation</h2>
          <p class="user-profession">Click Here to apply to Donate Blood</p>
          <a href="blood_donation.html">
          <button class="message-button">Blood Donation</button>
          </a>
        </div>

        <div class="card-item">
          <img src="bloodtransfusion.jpg" alt="User Image" class="user-image">
          <h2 class="user-name">Blood Transfusion</h2>
          <p class="user-profession">Sign up to receive Blood Transfusion</p>
          <a href="B_transfusion.html">
          <button class="message-button">Blood Transfusion</button>
          </a>
        </div>
      </div>
    </div>
  </div>

  <script>
    function logout() {
      alert("You have been logged out!");
      window.location.href = "frontend.html"; 
    }
  </script>
</body>
</html>