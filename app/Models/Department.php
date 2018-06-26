<?php

namespace App\Models;

use App\Models\Traits\AdminTrait;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use CrudTrait, AdminTrait;

    protected $primaryKey = 'id';
    protected $table = 'departments';
    public $timestamps = false;
    protected $fillable = ['name'];

    public function workers()
    {
        return $this->belongsToMany('App\Models\Worker');
    }
}
