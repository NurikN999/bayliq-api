<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    private array $banks = [
        [
            'name' => 'Kaspi',
            'code' => 'kaspi',
            'logo' => 'https://upload.wikimedia.org/wikipedia/ru/a/aa/Logo_of_Kaspi_bank.png'
        ],
        [
            'name' => 'Народный банк',
            'code' => 'halyk',
            'logo' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAxDA1WOWjoCXQIVSuU4KOZEfSO9a0oVEbCw&s'
        ],
        [
            'name' => 'Банк Центр Кредит',
            'code' => 'bcc',
            'logo' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRJL50efJwcFky_2j-vltt9dTLV29qM_40_fg&s'
        ],
        [
            'name' => 'Alatau City Bank',
            'code' => 'jusan',
            'logo' => 'https://play-lh.googleusercontent.com/HdMEN9YZsSrYUGtzjz3XPEOzAj6tERw0sDhpiAa3gpliOLbIwMK9uwJtPxxrtPo8Cw'
        ],
        [
            'name' => 'Форте Банк',
            'code' => 'forte',
            'logo' => 'https://kz.kursiv.media/wp-content/uploads/2025/02/15-04-1280x1280.jpg'
        ],
        [
            'name' => 'Freedom Bank',
            'code' => 'freedom',
            'logo' => 'https://static.tildacdn.one/tild6638-3439-4961-b833-396233336564/Freedom_Pay_-_square.png'
        ]
    ];

    public function run(): void
    {
        foreach ($this->banks as $bank) {
            Bank::create($bank);
        }
    }
}
