<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class Contact extends Model
{
    use HasFactory;

    

    protected $table = 'contacts';
    protected $fillable = ['contact', 'type'];

    public function employee():BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
