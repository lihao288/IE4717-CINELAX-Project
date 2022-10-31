const container = document.querySelector(".ticket-seating-plan-container");
const seats = document.querySelectorAll(
  ".ticket-seat-row .ticket-seat:not(.occupied):not(.not-available)"
);
const count = document.getElementById("seat-count");
const seatNumber = document.getElementById("ticket-cinema-seat-selected");
var seatNumberList = [];

const date = document.getElementById("ticket-date-selected");
const hall = document.getElementById("ticket-cinema-hall-selected");
const time = document.getElementById("ticket-time-selected");
const movie = document.getElementById("movie-name");
const moviePoster = document.getElementById("movie-poster");

const totalAmount = document.getElementById("ticket-price");
const ticketPrice = 10.5;
const convenienceFee = 2.0;

const customerName = document.getElementById("customer-name");
const customerMobile = document.getElementById("customer-mobileno");
const customerEmail = document.getElementById("customer-email");

function resizeInput() {
  if (this.value.length > 40) {
    this.style.width = (this.value.length + 5) * 8 + "px";
  } else if (this.value.length > 20) {
    this.style.width = (this.value.length + 1) * 9.5 + "px";
  } else {
    this.style.width = (this.value.length + 3) * 8 + "px";
  }
}

function fetchData() {
  // date.innerHTML = localStorage.getItem("Date");
  // hall.innerHTML = localStorage.getItem("Hall");
  // time.innerHTML = localStorage.getItem("Time");
  // movie.innerHTML = localStorage.getItem("Movie");

  date.value = localStorage.getItem("Date");
  hall.value = localStorage.getItem("Hall");
  time.value = localStorage.getItem("Time");

  movie.value = localStorage.getItem("Movie");
  movie.addEventListener("input", resizeInput);
  resizeInput.call(movie);

  // Display Poster
  switch (movie.value) {
    case "Ant-Man":
      moviePoster.src = "../movie images & videos/Ant-man/Ant-Man.jpeg";
      break;
    case "Black Panther":
      moviePoster.src =
        "../movie images & videos/Black Panther/Black Panther.jpeg ";
      break;
    case "Doctor Strange in the Multiverse of Madness":
      moviePoster.src =
        "../movie images & videos/Doctor Strange/Doctor Strange in the Multiverse of Madness.jpeg ";
      break;
    case "Eternals":
      moviePoster.src = "../movie images & videos/Eternals/Eternals.jpeg ";
      break;
    case "Guardians of the Galaxy":
      moviePoster.src =
        "../movie images & videos/Guardians of the Galaxy/Guardians of the Galaxy.jpeg ";
      break;
    case "Shang-Chi":
      moviePoster.src =
        "../movie images & videos/Shang Chi/Shang-Chi and The Legend of The Ten Rings.jpeg ";
      break;
    case "Spider-Man: No Way Home":
      moviePoster.src =
        "../movie images & videos/Spider-man/Spider-Man- No Way Home.jpeg ";
      break;
    case "Thor: Love and Thunder":
      moviePoster.src =
        "../movie images & videos/Thor/Thor- Love and Thunder poster.jpeg ";
      break;
  }
}

// update couunt
function updateSelectedCount() {
  // const selectedSeats = document.querySelectorAll(
  //   ".ticket-seat-row .ticket-seat.selected"
  // );

  // const selectedSeatsCount = selectedSeats.length;

  const selectedSeatsCount = seatNumberList.length;

  // update ui on count change
  count.value = selectedSeatsCount;

  // update total amount
  updatePrice(selectedSeatsCount);

  // update ui on selected seats
  seatNumber.value = seatNumberList;
}

function updatePrice(quantity) {
  let totalPrice = quantity * ticketPrice + convenienceFee;
  totalAmount.innerText = totalPrice.toFixed(2);
}

function checkValue() {
  if (count.value == 0) {
    alert("No seat has been selected. Please select at least one seat.");
    return false;
  }
  return true;
}

function name_field_check(event) {
  var name_field = event.currentTarget;
  // console.log(name_field);

  var pos = name_field.value.search(/^[A-Za-z\s]+$/);

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

function mobile_field_check(event) {
  var mobile_field = event.currentTarget;
  // console.log(mobile_field);

  var pos = mobile_field.value.search(/^[0-9]{8}$/);

  console.log(pos);

  if (pos != 0) {
    alert(
      "The mobile no. you entered (" +
        mobile_field.value +
        ") is not in the correct form. \n" +
        "It should contain exactly 8 digits and only numbers are allowerd."
    );
    mobile_field.focus();
    mobile_field.select();
    return false;
  }
}

function email_field_check(event) {
  var email_field = event.currentTarget;
  // console.log(email_field);

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

// Initialize
window.onload = fetchData();

container.addEventListener("click", (e) => {
  if (
    e.target.classList.contains("ticket-seat") &&
    !e.target.classList.contains("occupied") &&
    !e.target.classList.contains("not-available")
  ) {
    e.target.classList.toggle("selected");
    let clickedSeatNumber = e.target.dataset.value;
    if (e.target.classList.contains("selected")) {
      seatNumberList.push(clickedSeatNumber);
      seatNumberList.sort();
      localStorage.setItem("Seat", seatNumberList);
    } else {
      let index = seatNumberList.indexOf(clickedSeatNumber);
      if (index > -1) {
        seatNumberList.splice(index, 1);
      }
    }
  }

  updateSelectedCount();
});

customerName.addEventListener("change", name_field_check, false);
customerMobile.addEventListener("change", mobile_field_check, false);
customerEmail.addEventListener("change", email_field_check, false);
