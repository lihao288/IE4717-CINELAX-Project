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

function fetchData() {
  date.innerHTML = localStorage.getItem("Date");
  hall.innerHTML = localStorage.getItem("Hall");
  time.innerHTML = localStorage.getItem("Time");
  movie.innerHTML = localStorage.getItem("Movie");

  // Display Poster
  switch (movie.innerHTML) {
    case "Ant-Man":
      moviePoster.src = "./movie images & videos/Ant-man/Ant-Man.jpeg";
      break;
    case "Black Panther":
      moviePoster.src =
        "./movie images & videos/Black Panther/Black Panther.jpeg ";
      break;
    case "Doctor Strange in the Multiverse of Madness":
      moviePoster.src =
        "./movie images & videos/Doctor Strange/Doctor Strange in the Multiverse of Madness.jpeg ";
      break;
    case "Eternals":
      moviePoster.src = "./movie images & videos/Eternals/Eternals.jpeg ";
      break;
    case "Guardians of the Galaxy":
      moviePoster.src =
        "./movie images & videos/Guardians of the Galaxy/Guardians of the Galaxy.jpeg ";
      break;
    case "Shang-Chi":
      moviePoster.src =
        "./movie images & videos/Shang Chi/Shang-Chi and The Legend of The Ten Rings.jpeg ";
      break;
    case "Spider-Man: No Way Home":
      moviePoster.src =
        "./movie images & videos/Spider-man/Spider-Man- No Way Home.jpeg ";
      break;
    case "Thor: Love and Thunder":
      moviePoster.src =
        "./movie images & videos/Thor/Thor- Love and Thunder poster.jpeg ";
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
  count.innerText = selectedSeatsCount;

  // update total amount
  updatePrice(selectedSeatsCount);

  // update ui on selected seats
  seatNumber.innerHTML = seatNumberList;
}

function updatePrice(quantity) {
  let totalPrice = quantity * ticketPrice + convenienceFee;
  totalPrice.toFixed(2);
  console.log(totalPrice);

  totalAmount.innerText = totalPrice;
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
