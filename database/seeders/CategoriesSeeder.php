<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $travels = new Category();
        $travels->name = 'Путешествия';
        $travels->save();
        
        $car = new Category();
        $car->name = 'Авто';
        $car->save();

        $sport = new Category();
        $sport->name = 'Спорт';
        $sport->save();

        $eat = new Category();
        $eat->name = 'Еда';
        $eat->save();

        $other = new Category();
        $other->name = 'Другое';
        $other->save();
    }
}
