// const photos = ["photos/1.webp", "photos/2.webp", "photos/3.webp", "photos/4.webp", "photos/5.webp",
//             "photos/6.webp", "photos/7.webp", "photos/8.webp", "photos/9.webp", "photos/10.webp",
//             "photos/11.webp", "photos/12.webp", "photos/13.webp", "photos/14.webp", "photos/15.webp",
//             "photos/16.webp", "photos/17.webp", "photos/18.webp"];
//
// const titles = ["Подпись 1", "Подпись 2", "Подпись 3", "Подпись 4", "Подпись 5", "Подпись 6",
//             "Подпись 7", "Подпись 8", "Подпись 9", "Подпись 10", "Подпись 11", "Подпись 12",
//             "Подпись 13", "Подпись 14", "Подпись 15", "Подпись 16", "Подпись 17", "Подпись 18"];
//
// const photoAlbum = document.getElementById("photo-album");
//
// // Заполнение фотоальбома
// for (let i = 0; i < photos.length; i += 6) {
//   let row = document.createElement("div");
//   row.classList.add("row");
//
//   // Заполнение строки фотоальбома
//   for (let j = i; j < i + 6 && j < photos.length; j++) {
//     // Изображение
//     let img = document.createElement("img");
//     img.src = photos[j];
//     img.alt = titles[j];
//     img.title = titles[j];
//
//     // Подпись
//     let caption = document.createElement("div");
//     caption.classList.add("caption");
//     caption.textContent = titles[j];
//
//     // Блок для изображения и подписи
//     let photoContainer = document.createElement("div");
//     photoContainer.classList.add("photo-container");
//     photoContainer.appendChild(img);
//     photoContainer.appendChild(caption);
//
//     // При наведении заменить вид курсора
//     img.addEventListener("mouseover", function() {
//         this.style.cursor = "pointer";
//     });
//
//     // При нажатии открыть увеличенное фото
//     img.addEventListener('click', function() {
//         showImageModal(this.src, this.alt);
//     });
//
//     row.appendChild(photoContainer);
//   }
//
//   photoAlbum.appendChild(row);
// }

// Открытие изображения в модальном окне
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
