<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;


class Shared extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $table = 'shared';

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
        'name',
        'meeting_point',
        'date',
        'hour',
        'status',
        'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'meeting_point' => 'string',
        'date' => 'string',
        'hour' => 'string',
        'status' => 'string',
        'users_id' => 'text',
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
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
