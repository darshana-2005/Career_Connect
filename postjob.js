document.getElementById("jobForm").addEventListener("submit", function(e) {
  e.preventDefault();

  document.getElementById("successMsg").innerText =
    "✅ Job posted successfully! Students can now view this job.";

  this.reset();
});
