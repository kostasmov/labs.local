<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    const photos = ["photos/1.webp", "photos/2.webp", "photos/3.webp", "photos/4.webp", "photos/5.webp",
        "photos/6.webp", "photos/7.webp", "photos/8.webp", "photos/9.webp", "photos/10.webp",
        "photos/11.webp", "photos/12.webp", "photos/13.webp", "photos/14.webp", "photos/15.webp",
        "photos/16.webp", "photos/17.webp", "photos/18.webp"];

    const titles = ["Подпись 1", "Подпись 2", "Подпись 3", "Подпись 4", "Подпись 5", "Подпись 6",
        "Подпись 7", "Подпись 8", "Подпись 9", "Подпись 10", "Подпись 11", "Подпись 12",
        "Подпись 13", "Подпись 14", "Подпись 15", "Подпись 16", "Подпись 17", "Подпись 18"];
}
