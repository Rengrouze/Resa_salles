var numberOfDaysClicked = 0;
var days = [];
// get room id from the url
const urlParams = new URLSearchParams(window.location.search);
const room = urlParams.get("room");
console.log(room);
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
displaySelectedDays();

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
 // const tdElements = document.querySelectorAll("td");
 // select all the td eleemtsn with calenday-day class
  const tdElements = document.querySelectorAll(".calendar-date");

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
        displayMobileSectionValidate();
        // if the td element does not have the class "selected" add it
      } else {
        td.classList.add("selected");
        // add selected class to the child <div> element
        td.querySelector("div").classList.add("selected");
        addSelectedDayToArray(event);
        displayMobileSectionValidate();
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

// on change of number of days clicked, display the selected days in the date-list table
function removeSelectedDay(dayToDelete) {
  const index = days.findIndex((day) => {
    const date = new Date(day);
    const dayNumber = date.getDate();
    var monthNumber = date.getMonth() + 1;
    // add a 0 before the month number if it's less than 10
    if (monthNumber < 10) {
      monthNumber = `0${monthNumber}`;
    }
    const year = date.getFullYear();
    const formattedDay = `${year}-${monthNumber}-${dayNumber}`;
    
    return  dayToDelete = formattedDay;
  });
  

  // remove the day from the days array
  days.splice(index, 1);
  numberOfDaysClicked--;



  // select all the td elements with the class "calendar-date" and "selected"
  const tdElements = document.querySelectorAll(".calendar-date.selected");

  
  // loop through the td elements
  tdElements.forEach((td) => {
    // if the td element has the same date as the one to delete, remove the class "selected"
    if (td.classList.contains(dayToDelete)) {
      td.classList.remove("selected");
      // remove selected class from div with the class "circle" inside the td element
      td.querySelector(".circle").classList.remove("selected");
    }
  });

  displaySelectedDays();
}


//set an on click listener on delete buttons
function bindDeleteButtons() {
  const deleteButtons = document.querySelectorAll(".delete-day");
  deleteButtons.forEach((button) => {
    button.addEventListener("click", function (event) {
      // prevent the default behaviour of the link
      event.preventDefault();
      const dayToDelete = event.target.getAttribute("data-day");
      removeSelectedDay(dayToDelete);
    });
  });
}

function displaySelectedDays() {
  const dateListTable = document.querySelector("#date-list");
  // if there are no days selected, display a message
  if (numberOfDaysClicked == 0 ) {
    dateListTable.innerHTML = "<p class='ml-2 mr-2' style='margin-left : 10 px'>Aucun jour sélectionné, cliquez sur une date pour l'ajouter au tableau</p>";
  }
  else {
    days.sort((a, b) => new Date(a) - new Date(b));
    // change the format of the date to dd/mm/yyyy by creating a new array only for display
    const daysForDisplay = days.map((day) => {
      const date = new Date(day);
      const dayNumber = date.getDate().toString().padStart(2, '0');
      const monthNumber = (date.getMonth() + 1).toString().padStart(2, '0');
      const year = date.getFullYear();
      const dayForDisplay = `${dayNumber}/${monthNumber}/${year}`;
      return dayForDisplay;
    });

    // create a td element for each day in day selected
    let dateListTableContent = "";
    // loop through the days array
    daysForDisplay.forEach((day) => {
      // create a td element with the date and a button to remove the date
      dateListTableContent += `<tr>
      <td>${day}</td>
      <td><a class="btn btn-sm btn-danger delete-day" data-day="${day}">Supprimer</a></td>
    </tr>`;
    });
    
    // add the td elements to the date-list table
    dateListTable.innerHTML = dateListTableContent;
    bindDeleteButtons();
  }
}


function addSelectedClassToAlreadySelectedDays() {
  // select all the td elements
  const tdElements = document.querySelectorAll("td");

  // loop through the td elements
  tdElements.forEach((td) => {
    const dateLink = td;
     
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

const validateBtn = document.querySelectorAll(".validate-btn");



// add a listener for each validate button
validateBtn.forEach((button) => {
  button.addEventListener("click", function (event) {
    event.preventDefault();
    validate(numberOfDaysClicked, days, room);
  });
});


const noUserBtn = document.querySelectorAll(".no-user-btn");

noUserBtn.forEach((button) => {
  button.addEventListener("click", function (event) {
    event.preventDefault();
    noUser();
  });
});

function noUser() {
  login = confirm("Vous devez être connecté pour réserver une date");
  if (login == true) {
    window.location.href = "login.php";
  }
}



function validate(numberOfDaysClicked, days, room) {
  // chech is number of days clicked is 0
  if (numberOfDaysClicked === 0) {
    alert("Veuillez sélectionner au moins un jour");
  } else {
    //check is number of days clicked is equal to days.length
    if (numberOfDaysClicked == days.length) {
      // if yes, send the array to the server
      window.location.href = "validate-booking.php?days=" + days+"&room=" + room;
    } else {
      numberOfDaysClicked = days.length; 
      // redirect to the validation page
      window.location.href = "validate-booking.php?days=" + days +"&room=" + room;
    }
  }
}


function displayMobileSectionValidate() {
  const mobileSectionValidate = document.querySelector("#mobile-section-validate");
  if (numberOfDaysClicked == 0 ) {
    // hide the section
    mobileSectionValidate.classList.add("d-none");

  }
  else {
    // show the section
    mobileSectionValidate.classList.remove("d-none");
  }

}
