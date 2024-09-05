function setupCalendar() {
    const $dateInput = document.querySelector("#birthday");
    let $monthSelect;
    let $yearSelect;

    const months = [
        "Январь",
        "Февраль",
        "Март",
        "Апрель",
        "Май",
        "Июнь",
        "Июль",
        "Август",
        "Сентябрь",
        "Октябрь",
        "Ноябрь",
        "Декабрь",
    ];

    function getDaysInMonth(inputDate) {
        const date = new Date(inputDate);
        date.setMonth(date.getMonth() + 1);
        date.setDate(0);
        return date.getDate();
    }

    function getFirstDay(inputDate) {
        const date = new Date(inputDate);
        date.setDate(1);
        const dayOfWeek = date.getDay();
        return dayOfWeek === 0 ? 6 : dayOfWeek - 1;
    }

    function getFreeDates(inputDate) {
        let res = "";
        for (let i = 0; i < getFirstDay(inputDate); i++) {
            res += `<div class="calendar__date calendar__date--empty"></div>`;
        }
        return res;
    }

    function getDates(month, year) {
        if (year <= 0) return "";
        const date = new Date();
        date.setMonth(month);
        date.setFullYear(year);
        const free = getFreeDates(date);
        let remain = "";
        for (let i = 1; i <= getDaysInMonth(date); i++) {
            remain += `<div class="calendar__date">${i}</div>`;
        }
        return free + remain;
    }

    function getMonths() {
        return `${months.map((item) => {
            return `<option>${item}</option>`;
        })}`;
    }

    const $calendar = document.createElement("div");
    document.body.appendChild($calendar);
    $calendar.className = "calendar";

    $calendar.innerHTML = `
        <header class="calendar__header">
            <select id="month-select">
                ${getMonths()}
            </select >
            <input id="year-select" type="text" placeholder="Год" maxlength="4"/>
        </header>
        <div class="calendar__body">
            <div class="calendar__days">
                <div class="calendar__day">Пн</div>
                <div class="calendar__day">Вт</div>
                <div class="calendar__day">Ср</div>
                <div class="calendar__day">Чт</div>
                <div class="calendar__day">Пт</div>
                <div class="calendar__day">Сб</div>
                <div class="calendar__day">Вс</div>
            </div>
            <div class="calendar__dates">
                ${getDates(new Date().getMonth(), new Date().getFullYear())}
            </div>
        </div>
    `;

    const $dates = $calendar.querySelector(".calendar__dates");
    $monthSelect = $calendar.querySelector("#month-select");
    $yearSelect = $calendar.querySelector("#year-select");

    const renderDates = (month, year) => {
        if (year > 0) {
            $dates.innerHTML = getDates(month, year);
        } else {
            $dates.innerHTML = "";
        }
    };

    const handleSelect = () => {
        const month = months.indexOf($monthSelect.value);
        const year = parseInt($yearSelect.value, 10);
        if (!isNaN(year)) {
            renderDates(month, year);
        } else {
            $dates.innerHTML = "";
        }
    };

    const resetSelects = () => {
        const date = new Date();
        const month = months[date.getMonth()];
        const year = date.getFullYear();
        $yearSelect.value = year;
        $monthSelect.value = month;
        handleSelect();
    };

    // Обработчик для поля года, разрешающий только цифры
    $yearSelect.addEventListener("input", (e) => {
        // Удаление всех нецифровых символов
        $yearSelect.value = $yearSelect.value.replace(/[^0-9]/g, '');
        handleSelect();
    });

    $dateInput.addEventListener("focus", (e) => {
        $calendar.classList.add("calendar--active");
        const MARGIN = 10;
        const inputHeight = e.target.getBoundingClientRect().height;
        const x = e.target.offsetLeft;
        const y = e.target.offsetTop + inputHeight + MARGIN;
        $calendar.style.left = x + "px";
        $calendar.style.top = y + "px";
    });

    const close = () => {
        $calendar.classList.remove("calendar--active");
    };

    const handleBlur = () => {
        if (clickedSelect) {
            clickedSelect = false;
            return;
        }
        close();
    };

    const handleClickDocument = (e) => {
        if (
            e.target === $dateInput ||
            e.target === $calendar ||
            $calendar.contains(e.target)
        ) {
            return;
        }
        close();
    };

    const setValue = (date) => {
        const month = months.indexOf($monthSelect.value) + 1;
        const year = $yearSelect.value;
        $dateInput.value = `${date < 10 ? `0${date}` : date}.${
            month < 10 ? `0${month}` : month
        }.${year}`;
    };

    document.addEventListener("mousedown", handleClickDocument);
    $dateInput.addEventListener("blur", handleBlur);

    $monthSelect.addEventListener("change", handleSelect);
    $yearSelect.addEventListener("input", handleSelect);

    let clickedSelect = false;

    $calendar.addEventListener("mousedown", (e) => {
        if (e.target === $yearSelect || e.target === $monthSelect) {
            clickedSelect = true;
        } else {
            e.preventDefault();
        }
        if (
            e.target.classList.contains("calendar__date") &&
            !e.target.classList.contains("calendar__date--empty")
        ) {
            setValue(e.target.textContent);
            $dateInput.blur();
            close();
            return;
        }
        e.stopPropagation();
    });

    resetSelects();
    return $calendar;
}

const $calendar = setupCalendar();
