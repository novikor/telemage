<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\ScopedByUser;
use App\Observers\IntegrationObserver;
use Database\Factories\IntegrationFactory;
use Eloquent;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
 * @property string|null $deleted_at
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
 * @method static Builder<static>|Integration whereDeletedAt($value)
 * @method static Builder<static>|Integration whereJweSecret($value)
 * @method static Builder<static>|Integration onlyTrashed()
 * @method static Builder<static>|Integration withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|Integration withoutTrashed()
 *
 * @property string|null $webhook_token
 * @property bool $webhook_is_configured
 *
 * @method static Builder<static>|Integration whereWebhookIsConfigured($value)
 * @method static Builder<static>|Integration whereWebhookToken($value)
 *
 * @property-read Collection<int, TelegramUser> $telegramUsers
 * @property-read int|null $telegram_users_count
 *
 * @mixin Eloquent
 */
#[ObservedBy(IntegrationObserver::class)]
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
        'webhook_is_configured',

    ];

    protected function casts(): array
    {
        return [
            'jwe_secret' => 'encrypted',
            'bot_token' => 'encrypted',
            'webhook_is_configured' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function telegramUsers(): HasMany
    {
        return $this->hasMany(TelegramUser::class);
    }
}
