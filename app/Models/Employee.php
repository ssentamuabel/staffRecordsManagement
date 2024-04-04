<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Contact;
use App\Models\Referees;
use App\Models\Hobby;
use App\Models\Contract;
use App\Models\NextOfKin;
use App\Models\Leaves;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = [ 'sur_name', 'first_name',  'other_names', 'dob', 'gender', 'Married', 'email', 'nationality', 'nin_number'  ];


    public function contacts():HasMany
    {
        return $this->hasMany(Contact::class);
    }
    public function referees():HasMany
    {
        return $this->hasMany(Referees::class);
    }
    public function hobbies():BelongsToMany
    {
        return $this->belongsToMany(Hobby::class);
    }

    public function contracts():HasMany
    {
        return $this->hasMany(Contract::class);
    }

    public function next_of_kins():HasMany
    {
        return $this->hasMany(NextOfKin::class);
    }
    public function leaves():HasMany
    {
        return $this->hasMany(Leaves::class);
    }
}
