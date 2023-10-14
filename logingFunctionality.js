function confirmSubmissionDelete() {
    if (confirm("Are you sure you want to delete this item?")) {
      return true; // Proceed with the form submission
    } else {
      document.getElementById("demo").innerHTML = "Deletion canceled.";
      return false; // Prevent the form from being submitted
    }
  }

function confirmSubmissionLogout() {
  if (confirm("Are you sure you want to logout?")) {
    return true; // Proceed with the form submission
  } else {
    document.getElementById("demo").innerHTML = "Logout canceled.";
    return false; // Prevent the form from being submitted
  }
}

function confirmSubmissionDeleteAdmin() {
  if (confirm("Are you sure you want to Delete this user's account?")) {
    return true; // Proceed with the form submission
  } else {
    document.getElementById("demo").innerHTML = "Deletion canceled.";
    return false; // Prevent the form from being submitted
  }
}