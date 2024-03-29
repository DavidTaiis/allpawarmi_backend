<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;



class GeolocationMa extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $table = 'transport_geolocation';

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
        'name',
        'lat',
        'lng',
        'type',
        'description',
        'status',
        'busesLine_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'busesLine_id' => 'integer',
        'name' => 'string',
        'lat' => 'string',
        'lng' => 'string',
        'type' => 'text',
        'description' => 'text',
        'status' => 'string'
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
    public function busesLine()
    {
        return $this->belongsTo(BusesLine::class, 'busesLine_id');
    }
}
