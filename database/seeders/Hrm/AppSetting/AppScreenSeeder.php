<?php

namespace Database\Seeders\Hrm\AppSetting;

use App\Models\Hrm\AppSetting\AppScreen;
use Illuminate\Database\Seeder;

class AppScreenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            'support', 'attendance', 'notice', 'expense', 'leave', 'approval', 'phonebook', 'visit', 'appointments', 'break','report','daily-leave' 
        ];
        foreach ($menus as $key => $menu) {
            $iconName = $menu . '.svg';
            AppScreen::create([
                'name' => plain_text($menu),
                'slug' => $menu,
                'position' => $key + 1,
                'icon' => "public/uploads/appSettings/icon/{$iconName}",
                'status_id' => 1
            ]);
        }
    }
}
