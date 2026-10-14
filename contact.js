document.addEventListener("DOMContentLoaded", () => {

  const form = document.getElementById("contactForm");

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const formData = new FormData(form);

    fetch("contact.php", {
      method: "POST",
      body: formData
    })
    .then(res => res.text())
    .then(data => {
      if (data.trim() === "success") {
        showPopup("Success", "Message sent successfully!");
        form.reset();
      } else {
        showPopup("Error", data);
      }
    })
    .catch(() => {
      showPopup("Error", "Server not responding");
    });
  });

});

function showPopup(title, text) {
  document.getElementById("popupTitle").innerText = title;
  document.getElementById("popupText").innerText = text;
  document.getElementById("popup").style.display = "flex";
}

function closePopup() {
  document.getElementById("popup").style.display = "none";
}
