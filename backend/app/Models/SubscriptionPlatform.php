<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionPlatform extends Model
{

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subscription_platform';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'type',
        'members',
        'price',
        'active',
        'cat_currency_id',
        'recurrence_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'name' => 'string',
            'type' => 'string',
            'members' => 'integer',
            'price' => 'decimal:2',
            'active' => 'boolean',
            'cat_currency_id' => 'integer',
            'recurrence_id' => 'integer',
        ];
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @return array<string, string>
     */
    public function subscription()
    {
        return $this->hasMany(Subscription::class, 'subscription_platform_id');
    }

    public function currency()
    {
        return $this->belongsTo(CatCurrency::class, 'cat_currency_id', 'id');
    }

    public function recurrence()
    {
        return $this->belongsTo(Recurrence::class, 'recurrence_id', 'id');
    }

}
