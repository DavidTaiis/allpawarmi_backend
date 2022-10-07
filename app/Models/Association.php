<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Class Association
 * @package App\Http\Models
 * @property MorphMany images
 * @property BelongsTo company
 * @property int id
 * @property string description
 * @property string level
 * @property string status
 */
class Association extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $table = 'association';

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
        'user_id',
        'name',
        'lat',
        'lng',
        'advantages',
        'rules',
        'status',
        'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'users_id' => 'integer',
        'name' => 'string',
        'lat' => 'string',
        'lng' => 'string',
        'advantages' => 'text',
        'rules' => 'text',
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
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
