<?php include("auth.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Jobs & Internships | CareerConnect</title>

<link rel="stylesheet" href="jobss.css">
</head>

<body>

<header>
  <div class="logo">
    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Logo" style="width:35px; vertical-align:middle; margin-right:8px;">
    CareerConnect
  </div>
  <nav>
    <a href="index.html">Home</a>

    

      <a href="jobss.php">Jobs</a>
    <a href="resources.html">Resources</a>
   <a href="postjob.html">Post Job</a>
    <a href="contact.html">Contact</a>
    

  </nav>
 <!-- <a href="login.html" class="btn-login">Login / Sign Up</a>-->
</header>

<section class="filters">
  <select id="experienceFilter" onchange="applyFilters()">
    <option value="">Experience Level</option>
    <option value="Fresher">Fresher</option>
    <option value="Experienced">Experienced</option>
    <option value="Intern">Intern</option>
  </select>

  <select id="locationFilter" onchange="applyFilters()">
    <option value="">Location</option>
    <option value="Mumbai">Mumbai</option>
    <option value="Bangalore">Bangalore</option>
    <option value="Pune">Pune</option>
    <option value="Hyderabad">Hyderabad</option>
  </select>
</section>

<section class="jobs-container" id="jobsContainer"></section>

<!-- APPLY POPUP -->
<div class="popup" id="applyPopup">
  <div class="popup-content apply-form">

    <span class="close-btn" onclick="closePopup()">×</span>

    <h3>Apply for Job</h3>
    <p class="form-subtitle">Please complete the application form</p>

    <!-- Name -->
    <div class="form-row">
      <input type="text" id="firstName" placeholder="First Name *" required>
      <input type="text" id="lastName" placeholder="Last Name *" required>
    </div>

    <!-- Email -->
    <input type="email" id="email" placeholder="Email Address *" required>

    <!-- Gender -->
    <label class="field-label">Gender *</label>
    <select id="gender" required>
      <option value="">Select Gender</option>
      <option>Male</option>
      <option>Female</option>
      <option>Other</option>
      <option>Prefer not to say</option>
    </select>

    <!-- Worked before -->
    <label class="field-label">Have you worked with this company before? *</label>
    <div class="radio-group">
      <label><input type="radio" name="workedBefore" value="Yes"> Yes</label>
      <label><input type="radio" name="workedBefore" value="No"> No</label>
    </div>

    <!-- Resume -->
    <label class="field-label">Upload Resume (PDF only) *</label>
    <input type="file" id="resume" accept="application/pdf" required>
    <small id="pdfMessage">Only PDF format is allowed</small>

    <!-- Terms -->
    <div class="checkbox-area">
      <input type="checkbox" id="terms">
      <label for="terms">
        I agree and confirm that the information provided is correct
      </label>
    </div>

    <button class="submit-btn" onclick="submitApplication()">Submit Application</button>
    <button class="cancel-btn" onclick="closePopup()">Cancel</button>

  </div>
</div>


<script src="jobss.js"></script>
</body>
</html>
