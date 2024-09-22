function showImageModal(src, alt) {
  let modal = document.createElement("div");
  modal.classList.add("modal");

  let img = document.createElement("img");
  // img.classList.add("modal-content");
  img.src = src;
  img.alt = alt;

  modal.appendChild(img);
  document.body.appendChild(modal);

  modal.addEventListener('click', function() {
      document.body.removeChild(modal);
  });
}

window.showImageModal = showImageModal;

