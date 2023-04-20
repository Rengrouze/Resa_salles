var numberOfDaysClicked = 0;
var days = [];
// Sélectionnez la balise <div> contenant le calendrier

const calendar = document.getElementById("calendar");

// Sélectionnez les boutons de navigation précédent et suivant
const prevMonthBtn = document.querySelector(".previous-month");
const nextMonthBtn = document.querySelector(".next-month");

// select button href attributes on the page
const prevMonthBtnHref = prevMonthBtn.getAttribute("href");
const nextMonthBtnHref = nextMonthBtn.getAttribute("href");
// call the listener binding function for the first time
bindListenersToTdElements();
bindNavButton();
preventDefaultBehaviourOfLinks();
addSelectedClassToAlreadySelectedDays();

// Fonction pour naviguer dans le calendrier via AJAX
function navigateCalendar(url) {
  // Envoyer une requête AJAX pour récupérer le contenu du calendrier pour la nouvelle URL
  try {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", url);
    xhr.onload = function () {
      // Mettre à jour la balise <div> contenant le calendrier avec le nouveau contenu en ne prenant que la div avec la classe "calendar"
      const responseHtml = xhr.response;
      const parser = new DOMParser();
      const newDoc = parser.parseFromString(responseHtml, "text/html");

      // select the new href attributes for the previous and next month buttons
      const newPrevMonthBtnHref = newDoc
        .querySelector(".previous-month")
        .getAttribute("href");
      const newNextMonthBtnHref = newDoc
        .querySelector(".next-month")
        .getAttribute("href");
      // update the href attributes for the previous and next month buttons
      prevMonthBtn.setAttribute("href", newPrevMonthBtnHref);
      nextMonthBtn.setAttribute("href", newNextMonthBtnHref);
      // select the new calendar div

      const newCalendarDiv = newDoc.querySelector("#calendar");
      const currentCalendarDiv = document.querySelector("#calendar");
      // in the old calendar, select the previous and next month buttons

      currentCalendarDiv.innerHTML = newCalendarDiv.innerHTML;
      bindListenersToTdElements();
     // preventDefaultBehaviourOfLinks();
      bindNavButton();
      addSelectedClassToAlreadySelectedDays();
    };
    xhr.send();
    // call the listener binding function
  } catch (error) {
    console.log(error);
  }
}

// create a function to bind listeners to the td elements so when they are clicked, they became selected or unselected with a class
function bindListenersToTdElements() {
  // select all the td elements
  const tdElements = document.querySelectorAll("td");

  // loop through the td elements
  tdElements.forEach((td) => {
    // add an event listener to each td element
    td.addEventListener("click", function (event) {
      // if the td element has the class "selected" remove it
      if (td.classList.contains("selected")) {
        td.classList.remove("selected");
        // remove selected class from div with the class "circle" inside the td element
        td.querySelector("div").classList.remove("selected");
        removeSelectedDayFromArray(event);
        // if the td element does not have the class "selected" add it
      } else {
        td.classList.add("selected");
        // add selected class to the child <div> element
        td.querySelector("div").classList.add("selected");
        addSelectedDayToArray(event);
      }
    });
  });
}
// create a function to prevent default behaviours of the links inside the td elements
function preventDefaultBehaviourOfLinks() {
  // select all the links inside the td elements with the class "prevent-default"
  const links = document.querySelectorAll(".prevent-default");
  
  // loop through the links
  links.forEach((link) => {
    // add an event listener to each link
    link.addEventListener("click", function (event) {
      // prevent the default behaviour of the link
      event.preventDefault();
    });
  });
}

// create a function to add the selected day to an array by getting the date in the <a> inside the td element this function will be called
// on the same click event that adds the class "selected" to the td element
function addSelectedDayToArray(event) {
  // prevent the default behaviour of the link
  event.preventDefault();
  // get the date from the <a> element href (exemple href="add.php?date=2024-02-16")
  const link = event.target;
  //const date = link.getAttribute("href").split("=")[1];
  // get the date in the class of the div (it's the first class)
  const date = link.className.split(" ")[0];
  // add the date to the array
  days.push(date);
  // increment the number of days clicked
  numberOfDaysClicked++;
  // call the function to display the selected days
  displaySelectedDays();
}

// same as above but for removing the day from the array
function removeSelectedDayFromArray(event) {
  // prevent the default behaviour of the link
  event.preventDefault();
  // get the date from the <a> element
  const link = event.target;
  const date = link.className.split(" ")[0];
  // const date = link.getAttribute("href").split("=")[1];
  // remove the date from the array
  days = days.filter((day) => day !== date);
  // decrement the number of days clicked
  numberOfDaysClicked--;
  // call the function to display the selected days
  displaySelectedDays();
}

// on change of number of days clicked, display the selected days and the number of days clicked in the <p> element class arraydate and numberofdayselected
function displaySelectedDays() {
  const arrayDate = document.querySelector(".arraydate");
  const numberOfDaysSelected = document.querySelector(".numberofdayselected");
  arrayDate.innerText = days;
  numberOfDaysSelected.innerText = numberOfDaysClicked;
}
function addSelectedClassToAlreadySelectedDays() {
  // select all the td elements
  const tdElements = document.querySelectorAll("td");

  // loop through the td elements
  tdElements.forEach((td) => {
    const dateLink = td;
    console.log(dateLink); // Ajout de la ligne pour afficher le lien dans la console
    const date = dateLink.className.split(" ")[0];

    // check if the date is in the days array
    if (days.includes(date)) {
      // add the "selected" class to the td element
      td.classList.add("selected");
      // add the "selected" class to the child <div> element
      td.querySelector("div").classList.add("selected");
    }
  });
}

// create a function to bind the nav button
function bindNavButton() {
  const prevMonthBtn = document.querySelector(".previous-month");
  const nextMonthBtn = document.querySelector(".next-month");
  prevMonthBtn.addEventListener("click", function (event) {
    event.preventDefault();
    navigateCalendar(event.target.getAttribute("href"));
  });
  nextMonthBtn.addEventListener("click", function (event) {
    event.preventDefault();
    navigateCalendar(event.target.getAttribute("href"));
  });
}

// add a listener on the validate button id validate
const validateBtn = document.getElementById("validate");
validateBtn.addEventListener("click", function (event) {
  validate(numberOfDaysClicked, days);
});

function validate(numberOfDaysClicked, days) {
  // chech is number of days clicked is 0
  if (numberOfDaysClicked === 0) {
    alert("Veuillez sélectionner au moins un jour");
  } else {
    //check is number of days clicked is equal to days.length
    if (numberOfDaysClicked == days.length) {
      // if yes, send the array to the server
      window.location.href = "validation.php?days=" + days;
    } else {
      numberOfDaysClicked = days.length;
      //send in local storage the number of days clicked and the days array

      // redirect to the validation page
      window.location.href = "validation.php?days=" + days;
    }
  }
}

const logoutBtn = document.getElementById("logout");
logoutBtn.addEventListener("click", function (event) {
  window.location.href = "logout.php";
});

const myBookingsBtn = document.getElementById("mybookings");
myBookingsBtn.addEventListener("click", function (event) {
  window.location.href = "mybookings.php";
});
