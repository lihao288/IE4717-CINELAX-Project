const firstDate = document.querySelector(".showtimes-date-1");
const secondDate = document.querySelector(".showtimes-date-2");
const thirdDate = document.querySelector(".showtimes-date-3");
const leftArrow = document.querySelector(".showtimes-date-leftarrow");
const rightArrow = document.querySelector(".showtimes-date-rightarrow");

const dateSelectionContainer = document.querySelector(".showtimes-date");
const dateSelection = document.querySelectorAll(".showtimes-timing");

const timeSelectionContainer = document.querySelectorAll(
  ".showtimes-shows-timing"
);

var movieName;
var timeSelected;
var dateSelected;

var count = 0;
const today = new Date();
var isSelected = false;

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

function getSelectedDate() {
  var localDate = localStorage.getItem("Date");
  dateSelection.forEach((date) => {
    date.classList.remove("selected");
    if (date.innerHTML == localDate) {
      date.classList.add("selected");
    }
  });
}

function checkDateSelection(e) {
  dateSelection.forEach((date) => {
    if (date.classList.contains("selected")) {
      isSelected = true;
    }
  });

  if (!isSelected) {
    alert("Please select a date.");
    return false;
  }
  return true;
}

// initialize
calculateDate();
localStorage.setItem("Date", today.toDateString());

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

dateSelectionContainer.addEventListener("click", (e) => {
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

timeSelectionContainer.forEach((timeSelection) => {
  timeSelection.addEventListener("click", (e) => {
    if (e.target.classList.contains("showtimes-shows-selection")) {
      let currentIndex = e.target.name.substring(e.target.name.length - 1);
      // console.log(currentIndex);

      // Save time
      localStorage.setItem("Time", e.target.value);
      timeSelected = document.getElementById("time_" + currentIndex);
      timeSelected.value = e.target.value;

      // Save hall
      let selectedHall =
        e.target.parentElement.parentElement.parentElement.parentElement
          .firstElementChild.firstElementChild.innerHTML;
      localStorage.setItem("Hall", selectedHall);

      // Get Movie and Save it to localStorage
      movieName = document.getElementById("movie_" + currentIndex);
      localStorage.setItem("Movie", movieName.value);

      // Get Date
      let selectedDate = localStorage.getItem("Date");
      dateSelected = document.getElementById("date_" + currentIndex);
      dateSelected.value = selectedDate;
    }
  });
});

// // When the user scrolls the page, execute stickyFunc
// window.onscroll = function () {
//   stickyFunc();
// };

// // Get the navbar
// var navbar = document.getElementById("navbar");

// // Get the offset position of the navbar
// var sticky = dateSelectionContainer.offsetTop;

// // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
// function stickyFunc() {
//   if (window.pageYOffset >= sticky) {
//     navbar.classList.add("sticky");
//     dateSelectionContainer.classList.add("sticky");
//   } else {
//     navbar.classList.remove("sticky");
//     dateSelectionContainer.classList.remove("sticky");
//   }
// }
