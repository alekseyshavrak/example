<?php

use Illuminate\Database\Seeder;

class PracticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = collect([
            [
                'title' => 'Разработка',
                'items' => ['Фронтенд', 'Бек/Архитектура', 'Мобильная', 'Десктоп', 'Девопс/Админ', 'QA', 'Проджект']
            ],
            [
                'title' => 'Дизайн',
                'items' => ['Дизайн продукта', 'UX/UI', 'Иллюстратор/Художник']
            ],
            [
                'title' => 'Инвестирование',
                'items' => ['Ангел инвестор']
            ],
            [
                'title' => 'Кадры/HR',
                'items' => ['HR-партнер', 'Поддержка клиентов']
            ],
            [
                'title' => 'Продажи',
                'items' => ['Биздев', 'События', 'Рекрутинг']
            ],
            [
                'title' => 'Маркетинг',
                'items' => ['PR', 'Закупка трафика', 'Организация событий', 'Контент', 'SEO']
            ],
            [
                'title' => 'Продукт',
                'items' => ['Поддержка пользователей', 'Прототипирование', 'Аналитика', 'Менеджмент продукта']
            ],
            [
                'title' => 'Фаундер',
                'items' => ['Технарь', 'Нетехнарь']
            ],
        ]);

        foreach($categories as $category) {

            $category = collect($category);

            # Create new practice category
            $practiceCategory = \App\Model\PracticeCategory::create([
                'title' => $category->get('title')
            ]);

            foreach ($category->get('items') as $item) {
                $practiceCategory->practices()->create(['title' => $item]);
            }
        }


    }
}
