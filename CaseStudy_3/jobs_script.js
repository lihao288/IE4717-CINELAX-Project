var nameNode = document.getElementById("ename");
var emailNode = document.getElementById("eemail");
var dateNode = document.getElementById("esdate");

nameNode.addEventListener("change", name_field_check, false);
emailNode.addEventListener("change", email_field_check, false);
dateNode.addEventListener("change", date_field_check, false);
