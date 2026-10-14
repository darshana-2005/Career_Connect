// SHOW FORMS
function showSignup() {
  document.getElementById("loginForm").style.display = "none";
  document.getElementById("signupForm").style.display = "block";
  document.getElementById("formTitle").innerText = "Sign Up";
}

function showLogin() {
  document.getElementById("signupForm").style.display = "none";
  document.getElementById("loginForm").style.display = "block";
  document.getElementById("formTitle").innerText = "Login";
}

// ================= LOGIN =================
document.getElementById("loginForm").addEventListener("submit", async e => {
  e.preventDefault();

  const data = {
    action: "login",
    email: loginEmail.value,
    password: loginPassword.value,
    role: loginRole.value
  };

  const res = await fetch("login.php", {
    method: "POST",
    body: JSON.stringify(data)
  });

  const result = await res.json();

  if (result.status === "success") {
    window.location.href = "jobss.php"; // redirect after login
  } else {
    alert("Invalid login");
  }
});

// ================= SIGNUP =================
document.getElementById("signupForm").addEventListener("submit", async e => {
  e.preventDefault();

  const data = {
    action: "signup",
    name: document.getElementById("name").value,
    email: document.getElementById("signupEmail").value,
    password: document.getElementById("signupPassword").value,
    role: document.getElementById("signupRole").value
  };

  const res = await fetch("login.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify(data)
  });

  const result = await res.json();

  if (result.status === "registered") {
    window.location.href = "jobss.php";
  } else if (result.status === "exists") {
    alert("Email already exists");
  }
});
