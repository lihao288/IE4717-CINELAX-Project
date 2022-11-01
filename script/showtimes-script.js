// Get all the date selection components
const firstDate = document.querySelector(".showtimes-date-1");
const secondDate = document.querySelector(".showtimes-date-2");
const thirdDate = document.querySelector(".showtimes-date-3");
const leftArrow = document.querySelector(".showtimes-date-leftarrow");
const rightArrow = document.querySelector(".showtimes-date-rightarrow");
const dateSelectionContainer = document.querySelector(".showtimes-date");
const dateSelection = document.querySelectorAll(".showtimes-timing");

// Get the inidividual movie's time selection
const timeSelectionContainer = document.querySelectorAll(
  ".showtimes-shows-timing"
);

// Initialize the varibale to store the selected items
var movieName;
var timeSelected;
var dateSelected;

// Seat count
var count = 0;

// Get today's date
const today = new Date();

// boolean flag to indicate whether the seat is selected
var isSelected = false;

// This function is to calculate the future date with respect to the current date
function calculateDate() {
  var dateOne = new Date();
  dateOne.setDate(dateOne.getDate() + count);
  var dateTwo = new Date(dateOne);
  dateTwo.setDate(dateTwo.getDate() + 1);
  var dateThree = new Date(dateOne);
  dateThree.setDate(dateThree.getDate() + 2);

  // To prevent user to select a date earlier than the current date
  if (dateOne < today) {
    alert("Cannot select a date that is earlier than today");
    count = 0;
    dateOne.setDate(today.getDate());

    // Add 1 day to the first date
    dateTwo = new Date(dateOne);
    dateTwo.setDate(dateTwo.getDate() + 1);

    // Ad 2 days to the first date
    dateThree = new Date(dateOne);
    dateThree.setDate(dateThree.getDate() + 2);
  }
  // Set the content
  firstDate.innerHTML = dateOne.toDateString();
  secondDate.innerHTML = dateTwo.toDateString();
  thirdDate.innerHTML = dateThree.toDateString();
}

// Get currently selected date
function getSelectedDate() {
  var localDate = localStorage.getItem("Date");
  dateSelection.forEach((date) => {
    date.classList.remove("selected");
    if (date.innerHTML == localDate) {
      date.classList.add("selected");
    }
  });
}

// Check if a date is selected
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

// Add event listeners to left and right arrows
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

// Add event handlers to date selection
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

// Add event handlers to time selection
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
