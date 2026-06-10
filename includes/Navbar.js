document.addEventListener('DOMContentLoaded', function() {
  // Navbar scroll effect
  window.addEventListener("scroll", function () {
    var header = document.getElementById("navbar");
    if (header) {
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
    }
  });

  // Safe element access with null checks
  const loginButton = document.getElementById("login-button");
  const loginModal = document.getElementById("login-modal");
  const registButton = document.getElementById("regist-button");
  const registModal = document.getElementById("regist-modal");

  if (loginModal) loginModal.style.display = "none";
  if (registModal) registModal.style.display = "none";

  if (loginButton) {
    loginButton.addEventListener("click", function () {
      if (loginModal) {
        loginModal.style.display = "block";
        var modalHeight = loginModal.clientHeight;
        var modalWidth = loginModal.clientWidth;
        loginModal.style.left = "50%";
        loginModal.style.top = "50%";
        loginModal.style.marginLeft = -(modalWidth / 2) + "px";
        loginModal.style.marginTop = -(modalHeight / 2) + "px";
      }
    });
  }

  if (registButton) {
    registButton.addEventListener("click", function () {
      if (registModal) {
        registModal.style.display = "block";
        var modalHeight = registModal.clientHeight;
        var modalWidth = registModal.clientWidth;
        registModal.style.left = "50%";
        registModal.style.top = "50%";
        registModal.style.marginLeft = -(modalWidth / 2) + "px";
        registModal.style.marginTop = -(modalHeight / 2) + "px";
      }
    });
  }

  document.addEventListener("click", function (event) {
    if (registModal && event.target === registModal) {
      registModal.style.display = "none";
    }
    if (loginModal && event.target === loginModal) {
      loginModal.style.display = "none";
    }
  });
});
