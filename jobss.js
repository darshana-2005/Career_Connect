// --------------------
// 1. STATIC JOBS (DEFAULT)
// --------------------
const staticJobs = [
  { title: "Software Engineer", company: "JP Morgan", location: "Mumbai", experience: "Fresher" },
  { title: "Data Analyst", company: "Flipkart", location: "Bangalore", experience: "Intern" },
  { title: "Product Manager", company: "Amazon", location: "Mumbai", experience: "Experienced" },
  { title: "UX Designer", company: "Oracle", location: "Pune", experience: "Experienced" },
  { title: "Frontend Developer", company: "Infosys", location: "Hyderabad", experience: "Fresher" },
  { title: "Backend Intern", company: "TCS", location: "Bangalore", experience: "Intern" }
];

const container = document.getElementById("jobsContainer");

// --------------------
// 2. DISPLAY FUNCTION (SAME UI)
// --------------------
function displayJobs(list) {
  list.forEach(job => {
    container.innerHTML += `
      <div class="job-card">
        <b>${job.company}</b>
        <h3>${job.title}</h3>
        <p>Location: ${job.location}</p>
        <p>Experience: ${job.experience}</p>
        <button onclick="openPopup()">Apply</button>
      </div>
    `;
  });
}

// --------------------
// 3. SHOW STATIC JOBS FIRST
// --------------------
container.innerHTML = "";
displayJobs(staticJobs);

// --------------------
// 4. FETCH JOBS FROM DATABASE
// --------------------
fetch("fetchjobs.php")
  .then(res => res.json())
  .then(dbJobs => {
    if (dbJobs.length > 0) {
      displayJobs(dbJobs); // append DB jobs BELOW static jobs
    }
  })
  .catch(err => {
    console.log("DB jobs not loaded", err);
  });

// --------------------
// 5. FILTER LOGIC (STATIC + DB)
// --------------------
function applyFilters() {
  const exp = document.getElementById("experienceFilter").value;
  const loc = document.getElementById("locationFilter").value;

  container.innerHTML = "";

  const allJobs = [...staticJobs];

  fetch("fetchjobs.php")
    .then(res => res.json())
    .then(dbJobs => {
      const combined = allJobs.concat(dbJobs);

      const filtered = combined.filter(job =>
        (exp === "" || job.experience === exp) &&
        (loc === "" || job.location === loc)
      );

      displayJobs(filtered);
    });
}

// --------------------
// 6. POPUP FUNCTIONS (UNCHANGED)
// --------------------
  function openPopup() {
   document.getElementById("applyPopup").style.display = "flex";
 }

  function closePopup() {
   document.getElementById("applyPopup").style.display = "none";
}


//// --------------------
// 7. SUBMIT APPLICATION (NEW)
// --------------------
function submitApplication() {
  console.log("Submit clicked"); // DEBUG LINE

  const firstName = document.getElementById("firstName").value.trim();
  const lastName  = document.getElementById("lastName").value.trim();
  const email     = document.getElementById("email").value.trim();
  const gender    = document.getElementById("gender").value;
  const resume    = document.getElementById("resume").files[0];
  const terms     = document.getElementById("terms").checked;
  const worked    = document.querySelector('input[name="workedBefore"]:checked');

  if (!firstName || !lastName || !email || !gender || !resume || !worked || !terms) {
    alert("Please fill all required fields");
    return;
  }

  if (resume.type !== "application/pdf") {
    alert("Only PDF allowed");
    return;
  }

  const formData = new FormData();
  formData.append("firstName", firstName);
  formData.append("lastName", lastName);
  formData.append("email", email);
  formData.append("gender", gender);
  formData.append("workedBefore", worked.value);
  formData.append("resume", resume);

  fetch("apply_job.php", {
    method: "POST",
    body: formData
  })
    .then(res => res.text())
    .then(resp => {
      if (resp.trim() === "success") {
        alert("Application submitted successfully!");
        closePopup();
      } else {
        alert("Server Error: " + resp);
      }
    })
    .catch(() => alert("Network error"));
}