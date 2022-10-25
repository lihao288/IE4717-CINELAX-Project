const firstDate = document.querySelector(".showtimes-date-1");
const secondDate = document.querySelector(".showtimes-date-2");
const thirdDate = document.querySelector(".showtimes-date-3");
const leftArrow = document.querySelector(".showtimes-date-leftarrow");
const rightArrow = document.querySelector(".showtimes-date-rightarrow");
const selectedDateContainer = document.querySelector(".showtimes-date");
const dateSelection = document.querySelectorAll(".showtimes-timing");
var count = 0;
const today = new Date();

function calculateDate() {
  var dateOne = new Date();
  dateOne.setDate(dateOne.getDate() + count);
  var dateTwo = new Date(dateOne);
  dateTwo.setDate(dateTwo.getDate() + 1);
  var dateThree = new Date(dateOne);
  dateThree.setDate(dateThree.getDate() + 2);

  if (dateOne < today) {
    alert("Cannot select a date that is earlier than today");
    count = 0;
    dateOne.setDate(today.getDate());

    dateTwo = new Date(dateOne);
    dateTwo.setDate(dateTwo.getDate() + 1);

    dateThree = new Date(dateOne);
    dateThree.setDate(dateThree.getDate() + 2);
  }
  firstDate.innerHTML = dateOne.toDateString();
  secondDate.innerHTML = dateTwo.toDateString();
  thirdDate.innerHTML = dateThree.toDateString();
}

// initialize
calculateDate();
localStorage.setItem("Date", today.toDateString());

function getSelectedDate() {
  var localDate = localStorage.getItem("Date");
  dateSelection.forEach((date) => {
    date.classList.remove("selected");
    if (date.innerHTML == localDate) {
      date.classList.add("selected");
    }
  });
}

leftArrow.addEventListener("click", () => {
  count--;
  calculateDate();
  getSelectedDate();
});
rightArrow.addEventListener("click", () => {
  count++;
  calculateDate();
  getSelectedDate();
});

selectedDateContainer.addEventListener("click", (e) => {
  if (
    e.target.classList.contains("showtimes-date-1") ||
    e.target.classList.contains("showtimes-date-2") ||
    e.target.classList.contains("showtimes-date-3")
  ) {
    dateSelection.forEach((date) => {
      date.classList.remove("selected");
    });
    e.target.classList.toggle("selected");
    localStorage.setItem("Date", e.target.innerHTML);
  }
});
