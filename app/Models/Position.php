<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

/**
 * App\Models\Position
 *
 * @property int $id
 * @property string $position
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Worker[] $workers
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position wherePosition($value)
 * @mixin \Eloquent
 */
class Position extends Model
{
    use CrudTrait;

    protected $primaryKey = 'id';
    protected $table = 'positions';
    protected $fillable = ['position'];
    public $timestamps = false;

    public function workers()
    {
        return $this->belongsToMany('App\Models\Worker');
    }
}
