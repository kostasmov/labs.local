let dropdown = document.querySelector('.dropdown');
let dropdownContent = document.querySelector('.dropdown-content');

// Показать выпадающее меню
function showDropdownMenu() {
  dropdownContent.style.display = 'block';
}

// Скрыть выпадающее меню
function hideDropdownMenu() {
  dropdownContent.style.display = 'none';
}

// Обработчики событий наведения/снятия курсора
dropdown.addEventListener('mouseover', showDropdownMenu);
dropdown.addEventListener('mouseout', hideDropdownMenu);
