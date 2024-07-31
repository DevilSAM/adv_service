<?php

namespace Database\Seeders;

use App\Models\Advert;
use Illuminate\Database\Seeder;

class AdvertSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => 'Продам гараж',
                'description' => 'Большой кирпичный гараж',
                'images' => json_encode([
                    'https://img.freepik.com/free-photo/3d-view-house_23-2150150828.jpg',
                    'https://img.freepik.com/free-photo/house-3d-rendering-design_23-2150505800.jpg'

                    ]),
                'price' => 100000
            ],
            [
                'title' => 'Продаются котята',
                'description' => 'Пушистые и красивые! Сделаны с помощью нейросетей, но всё равно от этого они не становятся менее красивыми :)',
                'images' => json_encode([
                    'https://img.freepik.com/premium-photo/a-cat-wearing-a-pink-jacket-sits-in-the-grass-with-a-pink-jacket_1255871-1425.jpg',
                    'https://img.freepik.com/premium-photo/a-3d-cartoon-of-a-cute-and-adorable-fluffy-cat_720722-22688.jpg?',
                    'https://img.freepik.com/premium-photo/a-cat-with-a-green-eyes-and-a-black-background_413105-301.jpg'
                ]),
                'price' => 200
            ],
        ];
        Advert::upsert($data, ['title'], ['title', 'description', 'images', 'price']);
    }

}
