function checkTestForm() {
    const form = document.getElementById("testForm");

    form.addEventListener('submit', function(event) {
        let nameInput = document.getElementById('full_name');
        let answerInput = document.getElementById('quest3');

        nameInput.classList.remove("red-border");
        answerInput.classList.remove("red-border");

        if (!nameInput.value || !answerInput.value) {
            event.preventDefault();
            alert('Пожалуйста, заполните все поля формы.');

            if (!nameInput.value) {
                nameInput.focus();
                nameInput.classList.add("red-border");
                return;
            } else {
                answerInput.focus();
                answerInput.classList.add("red-border");
                return;
            }
        }

        validateForm(event, nameInput, answerInput);
    });
}

function validateForm(event, nameInput, messageInput) {
    if (!validateName(nameInput.value)) {
        event.preventDefault();
        alert("Ошибка: Неверно введено ФИО");
        nameInput.focus();
        nameInput.classList.add("red-border");
        return;
    }

    // if (!validateMessage(messageInput.value)) {
    //     event.preventDefault();
    //     alert("Ошибка: В ответе менее 20 слов");
    //     messageInput.focus();
    //     messageInput.classList.add("red-border");
    // }
}

function validateName(name) {
    let namePattern = /^[А-я]+\s[А-я]+\s[А-я]+$/;
    return namePattern.test(name);
}

// function validateMessage(textarea) {
//     let words = textarea.trim().split(" ");
//     return words.length >= 20
// }
