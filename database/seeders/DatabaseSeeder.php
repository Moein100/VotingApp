<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Idea;
use App\Models\Status;
use App\Models\Vote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(20)->create();
        Category::factory(4)->create();
        Status::factory()->create(['name' => 'Open' ]);
        Status::factory()->create(['name' => 'Considering']);
        Status::factory()->create(['name' => 'In Progress']);
        Status::factory()->create(['name' => 'Implemented']);
        Status::factory()->create(['name' => 'Closed']);
        Idea::factory(100)->create();


        //generate unique votes.Ensure idea_id and user_id are unique for each row

        foreach(range(1,20) as $user_id)
        {
            foreach(range(1,100) as $idea_id)
            {
                if($idea_id % 2 == 0)
                {
                    Vote::factory()->create(
                        [
                        'user_id' => $user_id,
                         'idea_id' => $idea_id
                        ]);
                }
            }
        }

        // generate comments for ideas
        foreach (Idea::all() as $idea)
        {
            Comment::factory(5)->existing()->create(['idea_id' => $idea->id]);
        }
    }
}