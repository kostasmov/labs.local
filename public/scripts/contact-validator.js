// const form = document.getElementById('contactForm');
// const submitButton = document.getElementById('submit');
//
// validateForm();
//
// // Проверка наличия заполнения поля
// function validateRequiredField(field) {
//   return field.value.trim() !== "";
// }
//
// // Проверка корректности ввода имени
// function validateName(name) {
//   let namePattern = /^[А-я]+\s[А-я]+\s[А-я]+$/;
//   return namePattern.test(name);
// }
//
// // Проверка корректности ввода номера телефона
// function validatePhone(phone) {
//   let phonePattern = /^(\+7|\+3)\d{9,11}$/;
//   return phonePattern.test(phone);
// }
//
// // Скрыть сообщение об ошибке
// function hideError(errorElement) {
//   errorElement.style.display = "none";
// }
//
// // Отобразить сообщение об ошибке
// function showError(errorElement, errorMessage) {
//   errorElement.textContent = errorMessage;
//   errorElement.style.display = "block";
//   errorElement.style.color = "red";
// }
//
// // Проверка корректности заполнения поля
// function validateField(field) {
//   let errorElement = document.getElementById(field.id + "-error");
//
//   if (!validateRequiredField(field)) {
//     field.classList.remove("valid-input");
//     field.classList.add("error-input");
//     showError(errorElement, "Поле не может быть пустым");
//   }
//   else if (field.id === "full_name" && !validateName(field.value)) {
//     field.classList.remove("valid-input");
//     field.classList.add("error-input");
//     showError(errorElement, "Введите полное имя (Фамилия Имя Отчество)");
//   }
//   else if (field.id === "phone" && !validatePhone(field.value)) {
//     field.classList.remove("valid-input");
//     field.classList.add("error-input");
//     showError(errorElement, "Введите корректный номер телефона");
//   }
//   else if (field.id === "mail" && !field.validity.valid) {
//     field.classList.remove("valid-input");
//     field.classList.add("error-input");
//     showError(errorElement, "Введите корректный адрес почты");
//   }
//   else {
//     field.classList.remove("error-input");
//     field.classList.add("valid-input");
//     hideError(errorElement);
//   }
//
//   validateForm();
// }
//
// // Функция для проверки корректности заполнения всей формы
// function validateForm() {
//     let fullNameInput = document.getElementById("full_name");
//     let birthdayInput = document.getElementById("birthday");
//     let emailInput = document.getElementById("mail");
//     let phoneInput = document.getElementById("phone");
//     let messageInput = document.getElementById("message");
//     let genderInput = document.querySelector('input[name="sex"]:checked');
//     let ageSelect = document.getElementById("age");
//
//     let isFullNameValid = validateRequiredField(fullNameInput) && validateName(fullNameInput.value);
//     let isBirthdayValid = validateRequiredField(birthdayInput);
//     let isEmailValid = validateRequiredField(emailInput) && emailInput.validity.valid;
//     let isPhoneValid = validateRequiredField(phoneInput) && validatePhone(phoneInput.value);
//     let isMessageValid = validateRequiredField(messageInput);
//     let isGenderValid = (genderInput != null);
//     let isAgeValid = validateRequiredField(ageSelect);
//
//   submitButton.disabled = !(isFullNameValid && isBirthdayValid && isEmailValid && isPhoneValid
//       && isMessageValid && isGenderValid && isAgeValid);
// }
//
// // Проверка заполнения формы при снятии фокуса с её полей
// document.getElementById("full_name").addEventListener("blur", function() {
//   validateField(this);
// });
//
// document.getElementById("birthday").addEventListener("blur", function() {
//   validateField(this);
// });
//
// document.getElementById("mail").addEventListener("blur", function() {
//   validateField(this);
// });
//
// document.getElementById("phone").addEventListener("blur", function() {
//   validateField(this);
// });
//
// document.getElementById("message").addEventListener("blur", function() {
//   validateField(this);
// });
//
// // Особые случаи (пол, возраст)
// document.querySelectorAll('input[name="sex"]').forEach(function(radio) {
//   radio.addEventListener("change", function() {
//     validateForm(this);
//   });
// });
//
// document.getElementById("age").addEventListener("change", function() {
//   validateField(this);
// });
//
// document.getElementById("age").addEventListener("blur", function() {
//   validateField(this);
// });
