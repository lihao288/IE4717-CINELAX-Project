const container = document.querySelector(".ticket-seating-plan-container");
const seats = document.querySelectorAll(
  ".ticket-seat-row .ticket-seat:not(.occupied):not(.not-available)"
);
const count = document.getElementById("seat-count");
const movie = document.getElementById("movie-name");

// let ticketPrice = 15.0;

// update couunt
function updateSelectedCount(seat) {
  const selectedSeats = document.querySelectorAll(
    ".ticket-seat-row .ticket-seat.selected"
  );

  const selectedSeatsCount = selectedSeats.length;

  count.innerText = selectedSeatsCount;
}

container.addEventListener("click", (e) => {
  if (
    e.target.classList.contains("ticket-seat") &&
    !e.target.classList.contains("occupied") &&
    !e.target.classList.contains("not-available")
  ) {
    e.target.classList.toggle("selected");
  }

  updateSelectedCount();
});
