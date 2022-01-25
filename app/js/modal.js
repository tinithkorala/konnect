function createModal(title, text, confirmAction){
    //creating the container for the content
    const modalContainer = document.createElement("div");
    modalContainer.classList.add("modal-container");

    //creating the header
    const modalHeaderContainer = document.createElement("div");
    modalHeaderContainer.classList.add("modal-header-container");

    //header text
    const modalHeader = document.createElement("h3");
    modalHeader.classList.add("modal-header-text");
    modalHeader.innerHTML += title;

    //close button on header
    const closeButton = document.createElement("button");
    closeButton.classList.add("modal-close-button");
    closeButton.setAttribute("id", "modal-close");
    const closeIcon = document.createElement("span");
    closeIcon.classList.add("material-icons-outlined", "modal-close-icon");
    closeIcon.innerHTML += "close";
    closeIcon.onclick = function (e){
        closeModal();
    };

    //adding the modal header text and the close icon to the header container
    modalHeaderContainer.appendChild(modalHeader);
    modalHeaderContainer.appendChild(closeIcon);

    //adding the header container to the container
    modalContainer.appendChild(modalHeaderContainer);

    //create the modal body container
    const modalBodyContainer = document.createElement("div");
    modalBodyContainer.classList.add("modal-body-container");

    //create the modal body text
    const modalBody = document.createElement("p");
    modalBody.classList.add("modal-body-text");
    modalBody.innerHTML += text;

    //add the text to the modal body and add the modal body to the container
    modalBodyContainer.appendChild(modalBody);
    modalContainer.appendChild(modalBodyContainer);

    //create the modal footer
    const modalFooterContainer = document.createElement("div");
    modalFooterContainer.classList.add("modal-footer-container");

    //create the confirm button
    const confirmButtonLink = document.createElement("a");
    confirmButtonLink.setAttribute("href", confirmAction);
    const confirmButton = document.createElement("button");
    confirmButton.classList.add("modal-confirm");
    confirmButton.innerHTML += "Confirm";
    confirmButtonLink.appendChild(confirmButton);

    //create the cancel button
    const cancelButton = document.createElement("button");
    cancelButton.classList.add("modal-cancel");
    cancelButton.innerHTML += "Cancel";
    cancelButton.onclick = function (e){
        closeModal();
    };

    modalFooterContainer.appendChild(confirmButtonLink);
    modalFooterContainer.appendChild(cancelButton);
    modalContainer.appendChild(modalFooterContainer);

    const mainModalContainer = document.querySelector(".main-modal");
    mainModalContainer.appendChild(modalContainer);
    mainModalContainer.classList.remove("hidden");
    mainModalContainer.classList.add("block");
}

function triggerModal(title, text, confirmAction){
    const modalContainer = document.querySelectorAll(".main-modal");
    if(modalContainer.length === 0){
        const modalContainerContent = document.createElement("div");
        modalContainerContent.classList.add("main-modal");
        modalContainerContent.setAttribute("id", "main-modal");
        document.querySelector("body").appendChild(modalContainerContent);
    }
    createModal(title, text, confirmAction);
}

function closeModal(){
    const modalContainerDiv = document.getElementById("main-modal");
    modalContainerDiv.classList.remove("block");
    modalContainerDiv.classList.add("hidden");
    modalContainerDiv.innerHTML = "";
}