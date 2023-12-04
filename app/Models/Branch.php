<?php

namespace App\Models;

use App\Models\coreApp\Traits\Relationship\StatusRelationTrait;
use App\Models\Hrm\Attendance\Weekend;
use App\Models\Traits\CompanyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use StatusRelationTrait, CompanyTrait, SoftDeletes, HasFactory;

    //boot function
    protected static function boot()
    {
        parent::boot();

        //get this class instance
        if (auth()->check()) {
            static::creating(function ($model) {

                $weekdays = [
                    'saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday',
                ];

                foreach ($weekdays as $day) {
                    $isWeekend = 'no';
                    if ($day == 'friday') {
                        $isWeekend = 'yes';
                    }
                    Weekend::create([
                        'name' => $day,
                        'is_weekend' => $isWeekend,
                        'status_id' => 1,
                        // 'company_id' => $company->id,
                        'branch_id' => $model->id,
                    ]);
                }

                $crated_company_id = auth()->check() ? auth()->user()->company_id : 1;

                //Company Config data clone
                $default_company_configs = CompanyConfig::where('company_id', $crated_company_id)->get();
                foreach ($default_company_configs as $key => $config) {

                    $company_config = new CompanyConfig;
                    $company_config->key = $config->key;
                    $company_config->value = $config->value;
                    $company_config->save();

                    $company_config->company_id = $crated_company_id;
                    $company_config->update();
                }
            });
        }
    }
}
