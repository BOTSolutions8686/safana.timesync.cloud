<?php

namespace App\Models\Hrm\Attendance;

use App\Models\coreApp\Traits\Relationship\StatusRelationTrait;
use App\Models\Traits\BranchTrait;
use App\Models\Traits\CompanyTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Weekend extends Model
{
    
    use HasFactory, StatusRelationTrait, LogsActivity, CompanyTrait,BranchTrait;

    protected $fillable = [
        'company_id', 'name', 'is_weekend', 'status_id'
    ];

    protected static $logAttributes = [
        'company_id', 'name', 'is_weekend', 'status_id'
    ];
}
