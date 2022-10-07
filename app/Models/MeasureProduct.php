<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Class MeasureProduct
 * @package App\Http\Models
 * @property MorphMany images
 * @property BelongsTo company
 * @property int id
 * @property string description
 * @property string level
 * @property string status
 */
class MeasureProduct extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $table = 'measures_product';

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
        'price',
        'stock',
        'status',
        'measures_id',
        'products_id',
        'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'price' => 'integer',
        'stock' => 'string',
        'status' => 'string',
        'measures_id' => 'integer',
        'products_id' => 'integer',
        'users_id' => 'integer'
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
    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }
    public function measure()
    {
        return $this->belongsTo(Measure::class, 'measures_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    
}
