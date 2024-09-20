function showImageModal(src, alt) {
  let modal = document.createElement("div");
  modal.classList.add("modal");

  let img = document.createElement("img");
  modal.classList.add("modal-content");
  img.src = src;
  img.alt = alt;

  modal.appendChild(img);
  document.body.appendChild(modal);

  // Закрыть модальное окно по нажатию
  modal.addEventListener('click', function() {
      document.body.removeChild(modal);
  });
}
