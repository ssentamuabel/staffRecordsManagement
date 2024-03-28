<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Leaves extends Model
{
    use HasFactory;
    protected $table = 'leaves';
    protected $fillable = [
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
