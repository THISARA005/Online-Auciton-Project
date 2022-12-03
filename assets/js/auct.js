const upcoming = document.querySelectorAll(".upcoming-auct");
const ongoing = document.querySelectorAll(".ongoing-auct");
const totalUp = upcoming.length;
const totalon = ongoing.length;

////////////////////
// Upcoming Auction Slider

var countup = 0;
upcoming.forEach(
  (slide, index) => {
    slide.style.left = `${index * 100}%`;
  }
)
const nextUpcoming = () => {
  countup >= (totalUp - 1) ? countup = -1 : countup;
  countup++;
  slideUpcoming();

}
const slideUpcoming = () => {
  upcoming.forEach(
    (slide) => {
      slide.style.transform = `translateX(-${countup * 100}%)`;
    })
}

////////////////////
// Ongoing Auction Slider

var counton = totalon;
ongoing.forEach(
  (slide, index) => {
    slide.style.left = `${index * 100}%`;
  }
)
const nextOngoing = () => {
  counton < 1 ? counton = totalon : counton;
  counton--;
  slideOngoing();

}
const slideOngoing = () => {
  ongoing.forEach(
    (slide) => {
      slide.style.transform = `translateX(-${counton * 100}%)`;
    })
}
