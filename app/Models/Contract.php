<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Contract extends Model
{
    use HasFactory;

    protected $table = 'contracts';
    protected $fillable = ['start_date', 'end_date', 'issue_date', 'anual_leave_days', 'running' ];


    public function Employee():BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
