const monthNames = [
    "января", "февраля", "марта", "апреля", "мая", "июня",
    "июля", "августа", "сентября", "октября", "ноября", "декабря"
];

function updateDateTime() {
    let now = new Date();

    let hours = now.getHours();
    let minutes = now.getMinutes();
    let seconds = now.getSeconds();
    let day = now.getDate();
    let month = monthNames[now.getMonth()];
    let year = now.getFullYear();

    let dateTimeString = hours + ':' + ('0' + minutes).slice(-2) + ':';
    dateTimeString += ('0' + seconds).slice(-2) + ' ' + day + ' ' + month + ' ' + year;

    let dateTimeElement = document.getElementById('currentDateTime');
    if (dateTimeElement) {
        dateTimeElement.textContent = dateTimeString;
    }
}

window.updateDateTime = updateDateTime;
