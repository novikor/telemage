<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $integration_id
 * @property int $chat_id
 * @property int $customer_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Integration $integration
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelegramUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelegramUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelegramUser query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelegramUser whereChatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelegramUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelegramUser whereCustomerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelegramUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelegramUser whereIntegrationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TelegramUser whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class TelegramUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'integration_id',
        'chat_id',
        'customer_id',
    ];

    protected function casts()
    {
        return [
            'chat_id' => 'integer',
            'customer_id' => 'integer',
        ];
    }

    public function integration(): BelongsTo
    {
        return $this->belongsTo(Integration::class);
    }
}
