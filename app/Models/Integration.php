<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\ScopedByUser;
use Database\Factories\IntegrationFactory;
use Eloquent;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string|null $bot_token
 * @property string|null $magento_base_url
 * @property string|null $store_code
 * @property string|null $jwe_secret
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
 * @method static Builder<static>|Integration whereTitle($value)
 * @method static IntegrationFactory factory($count = null, $state = [])
 * @method static Builder<static>|Integration ofUser(Authenticatable $user)
 *
 * @property string|null $deleted_at
 *
 * @method static Builder<static>|Integration whereDeletedAt($value)
 * @method static Builder<static>|Integration whereJweSecret($value)
 * @method static Builder<static>|Integration onlyTrashed()
 * @method static Builder<static>|Integration withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|Integration withoutTrashed()
 *
 * @mixin Eloquent
 */
class Integration extends Model
{
    use HasFactory;
    use ScopedByUser;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'bot_token',
        'magento_base_url',
        'store_code',
        'jwe_secret',
    ];

    protected function casts(): array
    {
        return [
            'jwe_secret' => 'encrypted',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
