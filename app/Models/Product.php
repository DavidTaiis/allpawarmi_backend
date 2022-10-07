<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Class Products
 * @package App\Http\Models
 * @property MorphMany images
 * @property BelongsTo company
 * @property int id
 * @property string description
 * @property string level
 * @property string status
 */
class Product extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    public $table = 'products';

    protected $guarded = [];
    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_INACTIVE = 'INACTIVE';
    const TYPE_PRODUCT = 'PRODUCT';
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
        'description',
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
        'description' => 'string',
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
    public function measures()
    {
        return $this->belongsToMany(Measure::class, 'measures_product',
            'products_id', 'measures_id');
    }
    public function measureProduct()
    {
        return $this->belongsTo(MeasureProduct::class, 'users_id');
    }

}
