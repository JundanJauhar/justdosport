window.addEventListener("scroll", function () {
  var header = document.getElementById("navbar");
  const navStyle = {
    backgroundColor: "rgba(255, 255, 255, 0.1)",
    backdropFilter: "blur(10px)",
  };

  if (window.scrollY < 100) {
    header.style.backgroundColor = "transparent";
    header.style.backdropFilter = "none";
  } else {
    header.style.backgroundColor = navStyle.backgroundColor;
    header.style.backdropFilter = navStyle.backdropFilter;
  }
});

const loginButton = document.getElementById("login-button");
const loginModal = document.getElementById("login-modal");
const registModal = document.getElementById("regist-modal");

loginModal.style.display = "none";
registModal.style.display = "none";

document.getElementById("login-button").addEventListener("click", function () {
  var loginModal = document.getElementById("login-modal");
  loginModal.style.display = "block";
  // center the modal
  var modalHeight = loginModal.clientHeight;
  var modalWidth = loginModal.clientWidth;
  loginModal.style.left = "50%";
  loginModal.style.top = "50%";

  loginModal.style.marginLeft = -(modalWidth / 2) + "px";
  loginModal.style.marginTop = -(modalHeight / 2) + "px";
});

document.getElementById("regist-button").addEventListener("click", function () {
  var registModal = document.getElementById("regist-modal");
  registModal.style.display = "block";
  // center the modal
  var modalHeight = registModal.clientHeight;
  var modalWidth = registModal.clientWidth;
  registModal.style.left = "50%";
  registModal.style.top = "50%";

  registModal.style.marginLeft = -(modalWidth / 2) + "px";
  registModal.style.marginTop = -(modalHeight / 2) + "px";
});

document.addEventListener("click", function (event) {
  if (event.target === registModal) {
    registModal.style.display = "none";
  }
});

document.addEventListener("click", function (event) {
  if (event.target === loginModal) {
    loginModal.style.display = "none";
  }
});
