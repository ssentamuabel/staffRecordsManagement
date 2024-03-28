<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models;
class NextOfKin extends Model
{
    use HasFactory;

    protected $table = 'next_of_kins';
    protected $fillable = ['name',  'contact',  'relationship'];


    public function Employee():BelongsTo
    {
        return $this->belongsTO(Employee::class);
    }
}
