const container = document.querySelector(".ticket-seating-plan-container");
const seats = document.querySelectorAll(
  ".ticket-seat-row .ticket-seat:not(.occupied):not(.not-available)"
);
const count = document.getElementById("seat-count");
const movie = document.getElementById("movie-name");
const seatNumber = document.getElementById("ticket-cinema-seat-selected");
var seatNumberList = [];

// let ticketPrice = 15.0;

// update couunt
function updateSelectedCount() {
  // const selectedSeats = document.querySelectorAll(
  //   ".ticket-seat-row .ticket-seat.selected"
  // );

  // const selectedSeatsCount = selectedSeats.length;
  const selectedSeatsCount = seatNumberList.length;

  count.innerText = selectedSeatsCount;
  seatNumber.innerHTML = seatNumberList;
}

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
    } else {
      let index = seatNumberList.indexOf(clickedSeatNumber);
      if (index > -1) {
        seatNumberList.splice(index, 1);
      }
    }
  }

  updateSelectedCount();
});
