/*
  Name:     Dayrit, Dhalenzhei Anne c.
  Section:  WD - 202
  Date:     11th of October, 2025   |     Saturday
  Act:      Javascript for Journal Page
*/

const popup = document.getElementById("popup");
const openBtn = document.getElementById("openBtn");
const closeBtn = document.getElementById("closeBtn");

openBtn.addEventListener("click", () => {
  popup.style.display = "block";
});

closeBtn.addEventListener("click", () => {
  popup.style.display = "none";
});

window.addEventListener("click", (event) => {
  if (event.target === popup) {
    popup.style.display = "none";
  }
});