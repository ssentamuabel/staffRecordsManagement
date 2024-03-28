<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Employeee;

class Hobby extends Model
{
    use HasFactory;

    protected $table = 'hobbies';
    protected $fillable = ['name'];

    public function Employees():BelongsToMany
    {
        return $this->belongsToMany(Employee::class);
    }
}
