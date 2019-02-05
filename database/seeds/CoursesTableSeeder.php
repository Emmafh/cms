<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
        $faker = \Faker\Factory::create();
		App\Course::truncate();
        $courseArr = ['Math', 'Computer Science', 'Literature'];

        foreach ($courseArr as $k => $v) {
			App\Course::create([
                'name' => $v,
                'code' => $faker->text(45),
            ]);
		}
    }
}
