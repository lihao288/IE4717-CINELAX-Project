function name_field_check(event) {
  var name_field = event.currentTarget;
  console.log(name_field);

  var pos = name_field.value.search(/[A-Za-z]/);

  console.log(pos);

  if (pos != 0) {
    alert(
      "The name you entered (" +
        name_field.value +
        ") is not in the correct form. \n" +
        "It should contain alphabet characters and character spaces."
    );
    name_field.focus();
    name_field.select();
    return false;
  }
}

function email_field_check(event) {
  var email_field = event.currentTarget;
  console.log(email_field);

  // var pos = email_field.value.search(
  //   /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3}){1,3}$/
  // );
  var pos = email_field.value.search(
    /^\w+([\.-]?\w+)*@\w+(\.\w+){0,2}(\.\w{2,3})$/
  );

  console.log(pos);

  if (pos != 0) {
    alert(
      "The email you entered (" +
        email_field.value +
        ") is not in the correct form. \n" +
        "It should contain a user name part follows by “@” and a domain name part. The user name contains word characters including hyphen (“-”) and period (“.”). The domain name contains two to four address extensions. Each extension is string of word characters and separated from the others by a period (“.”). The last extension must have two to three characters."
    );
    email_field.focus();
    email_field.select();
    return false;
  }
}

function date_field_check(event) {
  var date_field = event.currentTarget.value;
  date_field = new Date(date_field); // convert value from date string to Date object

  var today = new Date();

  if (date_field <= today) {
    alert(
      "The date you entered (" +
        date_field.toLocaleString() +
        ") cannot be from today and the past. \n" +
        "Please select a new date."
    );
    return false;
  }
}
