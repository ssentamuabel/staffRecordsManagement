<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models;
class NextOfKin extends Model
{
    use HasFactory;

    protected $table = 'next_of_kins';
    protected $fillable = ['employee_id', 'name',  'contact',  'relationship'];


    public function Employee():BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
