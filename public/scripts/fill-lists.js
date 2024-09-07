const films = [
    "Нефть (2007)",
    "Чужой (1979)",
    "Кролик Джоджо (2019)",
    "Аллея кошмаров (2021)",
    "Варвар (2022)",
    "Не смотрите наверх (2021)"
];

const albums = [
    "Crystal Castles - III (2012)",
    "Noisecream - Murder Story (2018)",
    "Электрофорез - 505 (2021)",
    "Machine Age - Point of Departure (2019)",
    "Carpenter Brut - TRILOGY (2017)",
    "Kavinsky - OutRun (2013)"
];

function fillFilms() {
    document.write("<ul>");
    for (let i = 0; i < films.length; i++) {
        document.write("<li>" + films[i] + "</li>");
    }
    document.write("</ul>");
}

function fillAlbums() {
    document.write("<ul>");
    for (let i = 0; i < albums.length; i++) {
        document.write("<li>" + albums[i] + "</li>");
    }
    document.write("</ul>");
}
