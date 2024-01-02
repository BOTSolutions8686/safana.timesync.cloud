<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class AttendenceExport implements FromView
{
    protected $recordsattend;

    public function __construct(View $recordsattend)
    {
        $this->recordsattend = $recordsattend;
    }

    public function view(): View
    {
        return $this->recordsattend;
    }
}
