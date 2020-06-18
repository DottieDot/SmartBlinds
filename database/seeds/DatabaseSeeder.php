<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 50)->create()->each(function ($user) {
            factory(App\Home::class, rand(1,3))->make()->each(function ($home) use ($user) {
                $user->homes()->save($home);

                factory(App\Room::class, rand(1,5))->make()->each(function ($room) use ($home) {
                    $home->rooms()->save($room);

                    factory(App\System::class, rand(1, 5))->make()->each(function ($system) use ($room) {
                        $system->user_id = $room->user_id;
                        
                        $room->systems()->save($system);
                    });
                });
            });

            factory(App\Routine::class, rand(1,4))->make()->each(function ($routine) use ($user) {
                $user->routines()->save($routine);

                $routineActions = factory(App\RoutineAction::class, rand(1,4))->make()->each(function ($action) {
                    $action->room_id = App\Room::all()->random()->id;
                });

                $routine->actions()->saveMany($routineActions);
            });
        });
    }
}
