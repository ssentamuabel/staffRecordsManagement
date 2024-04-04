<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Employee;

class Contact extends Model
{
    use HasFactory;

    

    protected $table = 'contacts';
    protected $fillable = ['employee_id', 'contact', 'type'];

    public function employee():BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
