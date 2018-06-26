<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

// класс для работы с таблицей услуг (services)
/**
 * App\Models\Service
 *
 * @property int $id
 * @property string $service
 * @property int $price
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Service extends Model
{
    // используем предопределенный Трейт из пакета
    // Backpack для Laravel, хранящий универсальные методы
    // для любого CRUD
    use CrudTrait;
    // указываем первичный ключ таблицы
    protected $primaryKey = 'id';
    // указываем таблицу которой соответствует модель
    protected $table = 'services';
    // указываем столбы из таблицы, которые можно массово заполнять
    // необходимо для быстрой генерации CRUD'ов
    protected $fillable = [
        'service', 'price', 'created_at', 'updated_at'
    ];
    // сохраняем ли мы временные метки типа
    // создан: дата, измененен: дата
    public $timestamps = true;

}
