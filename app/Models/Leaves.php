<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Employee;

class Leaves extends Model
{
    use HasFactory;
    protected $table = 'leaves';
    protected $fillable = [
        'employee_id',
        'leave_date',
        'return_date',
        'status',
        'year'
    ];


    public function employee():BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
