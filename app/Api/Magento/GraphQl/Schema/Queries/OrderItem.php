<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

class OrderItem
{
    public protected(set) ?array $discounts = null;

    public protected(set) ?array $entered_options = null;

    public protected(set) ?GiftMessage $gift_message = null;

    public protected(set) ?string $id = null;

    public protected(set) ?OrderItemPrices $prices = null;

    public protected(set) ?ProductInterface $product = null; // Assuming ProductInterface is a class with fromArray

    public protected(set) ?string $product_name = null;

    public protected(set) ?Money $product_sale_price = null;

    public protected(set) ?string $product_sku = null;

    public protected(set) ?string $product_type = null;

    public protected(set) ?string $product_url_key = null;

    public protected(set) ?float $quantity_canceled = null;

    public protected(set) ?float $quantity_invoiced = null;

    public protected(set) ?float $quantity_ordered = null;

    public protected(set) ?float $quantity_refunded = null;

    public protected(set) ?float $quantity_returned = null;

    public protected(set) ?float $quantity_shipped = null;

    public protected(set) ?array $selected_options = null;

    public protected(set) ?string $status = null;

    public static function fromArray(array $data): self
    {
        $instance = new self;
        if (isset($data['discounts'])) {
            $instance->discounts = array_map(Discount::fromArray(...), $data['discounts']);
        }
        // Assuming OrderItemOption is a class with fromArray
        if (isset($data['entered_options'])) {
            $instance->entered_options = array_map(OrderItemOption::fromArray(...), $data['entered_options']);
        }
        if (isset($data['gift_message'])) {
            $instance->gift_message = GiftMessage::fromArray($data['gift_message']);
        }
        if (isset($data['id'])) {
            $instance->id = $data['id'];
        }
        if (isset($data['prices'])) {
            $instance->prices = OrderItemPrices::fromArray($data['prices']);
        }
        // Assuming ProductInterface is a class with fromArray
        if (isset($data['product'])) {
            $instance->product = ProductInterface::fromArray($data['product']);
        }
        if (isset($data['product_name'])) {
            $instance->product_name = $data['product_name'];
        }
        if (isset($data['product_sale_price'])) {
            $instance->product_sale_price = Money::fromArray($data['product_sale_price']);
        }
        if (isset($data['product_sku'])) {
            $instance->product_sku = $data['product_sku'];
        }
        if (isset($data['product_type'])) {
            $instance->product_type = $data['product_type'];
        }
        if (isset($data['product_url_key'])) {
            $instance->product_url_key = $data['product_url_key'];
        }
        if (isset($data['quantity_canceled'])) {
            $instance->quantity_canceled = $data['quantity_canceled'];
        }
        if (isset($data['quantity_invoiced'])) {
            $instance->quantity_invoiced = $data['quantity_invoiced'];
        }
        if (isset($data['quantity_ordered'])) {
            $instance->quantity_ordered = $data['quantity_ordered'];
        }
        if (isset($data['quantity_refunded'])) {
            $instance->quantity_refunded = $data['quantity_refunded'];
        }
        if (isset($data['quantity_returned'])) {
            $instance->quantity_returned = $data['quantity_returned'];
        }
        if (isset($data['quantity_shipped'])) {
            $instance->quantity_shipped = $data['quantity_shipped'];
        }
        // Assuming OrderItemOption is a class with fromArray
        if (isset($data['selected_options'])) {
            $instance->selected_options = array_map(OrderItemOption::fromArray(...), $data['selected_options']);
        }
        if (isset($data['status'])) {
            $instance->status = $data['status'];
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
        if ($this->discounts !== null) {
            $data['discounts'] = array_map(fn ($item) => $item->asArray(), $this->discounts);
        }
        if ($this->entered_options !== null) {
            $data['entered_options'] = array_map(fn ($item) => $item->asArray(), $this->entered_options);
        }
        if ($this->gift_message instanceof GiftMessage) {
            $data['gift_message'] = $this->gift_message->asArray();
        }
        if ($this->id !== null) {
            $data['id'] = $this->id;
        }
        if ($this->prices instanceof OrderItemPrices) {
            $data['prices'] = $this->prices->asArray();
        }
        if ($this->product instanceof ProductInterface) {
            $data['product'] = $this->product->asArray();
        }
        if ($this->product_name !== null) {
            $data['product_name'] = $this->product_name;
        }
        if ($this->product_sale_price instanceof Money) {
            $data['product_sale_price'] = $this->product_sale_price->asArray();
        }
        if ($this->product_sku !== null) {
            $data['product_sku'] = $this->product_sku;
        }
        if ($this->product_type !== null) {
            $data['product_type'] = $this->product_type;
        }
        if ($this->product_url_key !== null) {
            $data['product_url_key'] = $this->product_url_key;
        }
        if ($this->quantity_canceled !== null) {
            $data['quantity_canceled'] = $this->quantity_canceled;
        }
        if ($this->quantity_invoiced !== null) {
            $data['quantity_invoiced'] = $this->quantity_invoiced;
        }
        if ($this->quantity_ordered !== null) {
            $data['quantity_ordered'] = $this->quantity_ordered;
        }
        if ($this->quantity_refunded !== null) {
            $data['quantity_refunded'] = $this->quantity_refunded;
        }
        if ($this->quantity_returned !== null) {
            $data['quantity_returned'] = $this->quantity_returned;
        }
        if ($this->quantity_shipped !== null) {
            $data['quantity_shipped'] = $this->quantity_shipped;
        }
        if ($this->selected_options !== null) {
            $data['selected_options'] = array_map(fn ($item) => $item->asArray(), $this->selected_options);
        }
        if ($this->status !== null) {
            $data['status'] = $this->status;
        }

        return $data;
    }
}
