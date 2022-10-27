<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Class Order
 * @package App\Http\Models
 * @property MorphMany images
 * @property BelongsTo company
 * @property int id
 * @property string description
 * @property string level
 * @property string status
 */
class Order extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $table = 'order';

    protected $guarded = [];
    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_INACTIVE = 'INACTIVE';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_client',
        'id_seller',
        'total',
        'deliver_date',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'string',
        'id_client' => 'integer',
        'id_seller' => 'integer',
        'total' => 'decimal:2',
        'place_delivery' => 'string',
        'deliver_date' => 'datatime',
        'status' => 'status',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'id_seller');
    }

    public function userClient()
    {
        return $this->belongsTo(user::class, 'id_client');
    }
     /**
     * @return HasMany
     */
    public function measureProductos()
    {
        return $this->hasMany(ProductOrder::class, 'order_id');
    }

}
