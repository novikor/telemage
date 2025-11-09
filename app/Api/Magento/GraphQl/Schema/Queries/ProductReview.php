<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use Carbon\Carbon;

class ProductReview
{
    public protected(set) ?float $average_rating = null;

    public protected(set) ?Carbon $created_at = null;

    public protected(set) ?string $nickname = null;

    public protected(set) ?array $ratings_breakdown = null;

    public protected(set) ?string $summary = null;

    public protected(set) ?string $text = null;

    protected $product;

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['average_rating']) && $data['average_rating'] !== null) {
            $instance->average_rating = $data['average_rating'];
        }
        if (isset($data['created_at']) && $data['created_at'] !== null) {
            $instance->created_at = new Carbon($data['created_at']);
        }
        if (isset($data['nickname']) && $data['nickname'] !== null) {
            $instance->nickname = $data['nickname'];
        }
        if (isset($data['product']) && $data['product'] !== null) {
            $instance->product = $data['product'];
        }
        if (isset($data['ratings_breakdown']) && $data['ratings_breakdown'] !== null) {
            $instance->ratings_breakdown = array_map(ProductReviewRating::fromArray(...), $data['ratings_breakdown']);
        }
        if (isset($data['summary']) && $data['summary'] !== null) {
            $instance->summary = $data['summary'];
        }
        if (isset($data['text']) && $data['text'] !== null) {
            $instance->text = $data['text'];
        }

        return $instance;
    }

    public static function fromJson(string $json): self
    {
        $data = json_decode($json, true);
        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            throw new \InvalidArgumentException('Invalid JSON provided to fromJson method: '.json_last_error_msg());
        }

        return self::fromArray($data);
    }

    /**
     * Converts this object to an array.
     */
    public function asArray(): array
    {
        $data = [];
        if ($this->average_rating !== null) {
            $data['average_rating'] = $this->average_rating;
        }
        if ($this->created_at instanceof Carbon) {
            $data['created_at'] = $this->created_at->toIso8601String();
        }
        if ($this->nickname !== null) {
            $data['nickname'] = $this->nickname;
        }
        if ($this->product !== null) {
            $data['product'] = $this->product;
        }
        if ($this->ratings_breakdown !== null) {
            $data['ratings_breakdown'] = array_map(fn ($item) => $item->asArray(), $this->ratings_breakdown);
        }
        if ($this->summary !== null) {
            $data['summary'] = $this->summary;
        }
        if ($this->text !== null) {
            $data['text'] = $this->text;
        }

        return $data;
    }
}
