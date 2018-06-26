<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

// класс для работы с таблицей сотрудников (workers)

/**
 * App\Models\Worker
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property int $salary
 * @property int $position_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Position $position
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker wherePositionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Worker whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Worker extends Model
{
    use CrudTrait;

    // указываем какой первичный ключ у таблица workers
    protected $primaryKey = 'id';
    // указываем таблицу в бд
    protected $table = 'workers';
    // указываем какие столбы в таблице могут массово заполняться (это нужно для быстрого написания круда)
    protected $fillable = [
        'name', 'surname', 'salary', 'position_id', 'created_at', 'updated_at', 'department_id'
    ];
    // нужные ли временные метки в таблице
    public $timestamps = true;


    // функция которая определяет отношение между таблицами workers и positions
    public function position()
    {
        // отношение 1 к 1 к таблице должностей (positions)
        // position_id из таблицы workers является первичным ключем
        // таблицы должностей (positions)
        return $this->hasOne('App\Models\Position', 'id', 'position_id');
    }

    public function department()
    {
        return $this->hasOne('App\Models\Department', 'id', 'department_id');
    }
}
