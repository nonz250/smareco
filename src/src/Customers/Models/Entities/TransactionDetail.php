<?php
declare(strict_types=1);

namespace Smareco\Customers\Models\Entities;

class TransactionDetail
{
    private string $productId;
    private string $productCode;
    private string $productName;
    private int $price;
    private int $quantity;

    /**
     * TransactionDetail constructor.
     *
     * @param string $productId
     * @param string $productCode
     * @param string $productName
     * @param int $price
     * @param int $quantity
     */
    public function __construct(
        string $productId,
        string $productCode,
        string $productName,
        int $price,
        int $quantity
    ) {
        $this->productId = $productId;
        $this->productCode = $productCode;
        $this->productName = $productName;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function price(): int
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function productCode(): string
    {
        return $this->productCode;
    }

    /**
     * @return string
     */
    public function productId(): string
    {
        return $this->productId;
    }

    /**
     * @return string
     */
    public function productName(): string
    {
        return $this->productName;
    }

    /**
     * @return int
     */
    public function quantity(): int
    {
        return $this->quantity;
    }

    public function toArray(): array
    {
        return [
            'product_id' => $this->productId,
            'product_code' => $this->productCode,
            'product_name' => $this->productName,
            'price' => $this->price,
            'quantity' => $this->quantity,
        ];
    }
}
