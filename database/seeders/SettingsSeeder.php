<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Company\Company;
use Illuminate\Database\Seeder;
use App\Models\coreApp\Setting\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            'company_name',
            'company_logo_backend',
            'company_logo_frontend',
            'company_icon',
            'android_url',
            'android_icon',
            'ios_url',
            'ios_icon',
            'language',
            'emailSettingsProvider',
            'emailSettings_from_name',
            'emailSettings_from_email',
            'site_under_maintenance',
            'company_description',
        ];
        $values = [
            'HRM',
            'public/uploads/settings/logo/logo-white.png',
            'public/uploads/settings/logo/logo-black.png',
            'public/uploads/settings/logo/favicon.png',
            'https://play.google.com/store/apps/details?id=com.worx24hour.hrm',
            'public/assets/favicon.png',
            'https://apps.apple.com/us/app/24hourworx/id1620313188',
            'public/assets/favicon.png',
            'en',
            'smtp',
            'hrm@onest.com',
            'hrm@onest.com',
            '0',
            'Onest Tech believes in painting the perfect picture of your idea while maintaining industry standards.',
        ];
        foreach ($array as $key => $item) {
            Setting::create([
                'name' => $item,
                'value' => $values[$key],
                'context' => 'app',
                'company_id' => 1,
            ]);
        }
    }
}
