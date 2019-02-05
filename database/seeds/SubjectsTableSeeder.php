<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
		App\Subject::truncate();
        $subjectArr = [
            ['Advanced mathematics', 'Linear algebra', 'probability theory'],
            ['operating system', 'ata structure', 'Algorithms'],
            ['contemporary literature', 'Ancient literature'],
        ];

        for ($i = 0; $i < 3; $i++) {
            foreach ($subjectArr[$i] as $v) {
                App\Subject::create([
                    'course_id' => $i+1,
                    'name' => $v,
                    'code' => $faker->text(45),
                    'description' => $faker->sentence,
                    'hidden' => 1,
                ]);
            }
        }

    }
}
