function confirmSubmission() {
    if (confirm("Are you sure you want to delete this item?")) {
      return true; // Proceed with the form submission
    } else {
      document.getElementById("demo").innerHTML = "Deletion canceled.";
      return false; // Prevent the form from being submitted
    }
  }