<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\{User, Building, AccessType};

class AccessList extends Model
{
    protected $fillable = [
        'user_id', 'building_id', 'access_type_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function building(){
        return $this->belongsTo(Building::class);
    }

    public function accessType(){
        return $this->belongsTo(AccessType::class);
    }
}
