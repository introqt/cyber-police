<?php

namespace App\Models;

use App\Models\Traits\AdminTrait;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $client_id
 * @property int $service_id
 * @property int|null $worker_id
 * @property int $status
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\Client $client
 * @property-read \App\Models\Service $service
 * @property-read \App\Models\Worker|null $worker
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereWorkerId($value)
 * @mixin \Eloquent
 */
class Order extends Model
{
    use CrudTrait, AdminTrait;

    protected $primaryKey = 'id';
    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = [
        'client_id', 'service_id', 'worker_id',
        'status', 'created_at', 'updated_at'
    ];

    /**
     * @return string
     */
    public function getWorkerLink(): string
    {
        if ($this->worker) {
            return "<a href='/admin/worker/{$this->worker_id}'>{$this->worker->surname}</a>";
        }
        return 'Не выбран';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
