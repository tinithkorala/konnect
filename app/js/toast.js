// function for creating toast elements available with parameters
function createToast(type, title, text) {

    // Creating toast message container as dom element
    const toastElem = document.createElement("div");
    // Adding toast class to it
    toastElem.classList.add('toast');
    // If there is a type, add that type name as class to toast message container
    if (type) {
        toastElem.classList.add(type);
    }

    // create title dom element
    const titleElem = document.createElement("p");
    // add t-title class to doom element
    titleElem.classList.add('t-title');

    // depend on the type add icon, you can add more icons if you want
    let iconType = "";
    if (type === "system") {
        iconType = '<span class="material-icons">build</span>';
    } else if (type === "success") {
        iconType = '<span class="material-icons">done</span>';
    } else if (type === "warning") {
        iconType = '<span class="material-icons">report_problem</span>';
    } else if (type === "bug") {
        iconType = '<span class="material-icons">bug_report</span>';
    }

    // append icon to title element with title text
    titleElem.innerHTML += iconType + title;
    toastElem.appendChild(titleElem);

    // create close element with t-close class for closing the toast message
    const closeElem = document.createElement("p");
    closeElem.classList.add('t-close');
    toastElem.appendChild(closeElem);

    // create text element with t-text class and append text to it
    const textElement = document.createElement("p");
    textElement.classList.add('t-text');
    textElement.innerHTML = text;
    toastElem.appendChild(textElement);

    // get toast-container element
    const toastContainer = document.querySelector(".toast-container");

    //append toast message to it
    toastContainer.appendChild(toastElem);

    // wait just a bit to add active class to the message to trigger animation
    setTimeout(function () {
        toastElem.classList.add('active');
    }, 1);

    setTimeout(function () {
        toastElem.classList.remove('active');
        setTimeout(function () {
            toastElem.remove();
        }, 5000);
    }, 5000);

}

document.addEventListener('DOMContentLoaded', (event) => {

    // get all elements with .toast-container class
    const toastContainer = document.querySelectorAll(".toast-container");
    // check if container already exist and add it if it doesn't
    if (toastContainer.length === 0) {
        // prepare toast-container element
        const toastContainerContent = '<div class="toast-container"></div>';
        // add it to the end of the body
        document.querySelector("body").innerHTML += toastContainerContent;
    }
});

document.addEventListener('click', function (e) {
    //check is the right element clicked
    if (!e.target.matches('.t-close')) return;
    else {
        //get toast element
        const toastElement = e.target.parentElement;
        // remove active class from it to trigger css animation with duration of 300ms
        toastElement.classList.remove('active');
        //wait for 350ms and then remove element
        setTimeout(function () {
            toastElement.remove();
        }, 350);
    }
});

//addEventListener on mouse click for standard closing of toast message on right top "x"
/**
 *
 * @param type
 * @param title
 * @param text
 */
function triggerToast(type, title, text) {
    const toastContainer = document.querySelectorAll(".toast-container");
    // check if container already exist and add it if it doesn't
    if (toastContainer.length === 0) {
        // prepare toast-container element
        const toastContainerContent = '<div class="toast-container"></div>';
        // add it to the end of the body
        document.querySelector("body").innerHTML += toastContainerContent;
    }
    //create toast message with data that is passed in as parameters
    createToast(type, title, text);
}