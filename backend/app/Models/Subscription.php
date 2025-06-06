<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subscription';

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
        'number_members_paying',
        'active',
        'user_id',
        'subscription_platform_id',
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
            'number_members_paying' => 'integer',
            'active' => 'boolean',
            'user_id' => 'integer',
            'subscription_platform_id' => 'integer',
        ];
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @return array<string, string>
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subscriptionPlatform()
    {
        return $this->belongsTo(SubscriptionPlatform::class, 'subscription_platform_id');
    }

}
