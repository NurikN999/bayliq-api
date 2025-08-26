<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    protected array $categories = [
        [
            'name' => 'Развлечения',
            'icon' => '🎮'
        ],
        [
            'name' => 'Продукты',
            'icon' => '🛒'
        ],
        [
            'name' => 'Транспорт',
            'icon' => '🚗'
        ],
        [
            'name' => 'Кафе и рестораны',
            'icon' => '☕'
        ],
        [
            'name' => 'Подарки',
            'icon' => '🎁'
        ],
        [
            'name' => 'Подписки',
            'icon' => '📺'
        ],
        [
            'name' => 'Образование',
            'icon' => '🎓'
        ],
        [
            'name' => 'Аренда жилья',
            'icon' => '🏠'
        ]
    ];

    public function run(): void
    {
        foreach ($this->categories as $category) {
            Category::create($category);
        }
    }
}
