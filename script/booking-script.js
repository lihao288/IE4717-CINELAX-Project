const movies = document.querySelectorAll(".movie");

function resizeInput() {
  console.log(this.value.length);
  if (this.value.length >= 7) {
    this.style.width = (this.value.length + 1) * 11 + "px";
  } else if (this.value.length == 8) {
    this.style.width = (this.value.length + 1) * 8 + "px";
  } else if (this.value.length > 10) {
    this.style.width = (this.value.length + 1) * 10 + "px";
  }
}

movies.forEach((movie) => {
  movie.addEventListener("input", resizeInput);
  resizeInput.call(movie);
});
