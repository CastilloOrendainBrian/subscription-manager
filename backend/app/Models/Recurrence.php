<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recurrence extends Model
{

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'recurrence';

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
        'start_date',
        'end_date',
        'quantity',
        'cat_time_unit_id',
        'cat_day_id',
        'cat_month_id',
        'date_month',
        'cat_week_month_id',
        'active',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'quantity' => 'integer',
        'cat_time_unit_id' => 'integer',
        'cat_day_id' => 'integer',
        'cat_month_id' => 'integer',
        'date_month' => 'integer',
        'cat_week_month_id' => 'integer',
        'active' => 'boolean',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @return array<string, string>
     */
    public function subscriptionsPlatform()
    {
        return $this->hasMany(SubscriptionPlatform::class, 'recurrence_id');
    }

    public function timeUnit()
    {
        return $this->belongsTo(\App\Models\Catalog\CatTimeUnit::class, 'cat_time_unit_id', 'id');
    }

    public function day()
    {
        return $this->belongsTo(\App\Models\Catalog\CatDay::class, 'cat_day_id', 'id');
    }

    public function month()
    {
        return $this->belongsTo(\App\Models\Catalog\CatMonth::class, 'cat_month_id', 'id');
    }

    public function weekMonth()
    {
        return $this->belongsTo(\App\Models\Catalog\CatWeekMonth::class, 'cat_week_month_id', 'id');
    }

}
