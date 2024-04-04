<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Employee;

class Referees extends Model
{
    use HasFactory;
    protected $table = 'referees';
    protected $fillable = ['employee_id','names', 'title', 'relation', 'contact'];


    public function employee():BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}

