<?php

declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property string|null $bot_token
 * @property string|null $magento_base_url
 * @property string|null $store_code
 * @property string|null $jwe_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 *
 * @method static Builder|Integration newModelQuery()
 * @method static Builder|Integration newQuery()
 * @method static Builder|Integration query()
 * @method static Builder|Integration whereBotToken($value)
 * @method static Builder|Integration whereCreatedAt($value)
 * @method static Builder|Integration whereId($value)
 * @method static Builder|Integration whereJweToken($value)
 * @method static Builder|Integration whereMagentoBaseUrl($value)
 * @method static Builder|Integration whereUpdatedAt($value)
 * @method static Builder|Integration whereUserId($value)
 * @method static Builder<static>|Integration whereStoreCode($value)
 *
 * @mixin Eloquent
 */
class Integration extends Model
{
    protected $fillable = [
        'user_id',
        'bot_token',
        'magento_base_url',
        'store_code',
        'jwe_token',
    ];

    protected function casts(): array
    {
        return [
            'jwe_token' => 'encrypted',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
