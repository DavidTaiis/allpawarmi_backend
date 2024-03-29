<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;


class RouteTransport extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $table = 'routes_transport';

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
        'id',
        'status',
        'transport_geolocation_id',
        'routes_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'transport_geolocation_id' => 'integer',
        'routes_id' => 'integer',
        'status' => 'string',
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

    
    /**
     * @return BelongsTo
     */
    public function transportGeolocation()
    {
        return $this->belongsTo(TransportGeolocation::class, 'transport_geolocation_id');
    }
    public function routes()
    {
        return $this->belongsTo(Route::class, 'routes_id');
    }
    
}

