<?php
declare(strict_types=1);

namespace Smareco\Customers\Models\Entities;

use Smareco\Customers\Models\ValueObjects\TaxDivision;

class Product
{
    private string $id;
    private string $providerId;
    private string $contractId;
    private int $productId;
    private int $categoryId;
    private string $code;
    private string $name;
    private string $kana;
    /**
     * @var TaxDivision
     */
    private TaxDivision $taxDivision;
    private int $price;
    private int $customerPrice;
    private int $cost;
    private string $description;

    /**
     * Product constructor.
     *
     * @param string $id
     * @param string $providerId
     * @param string $contractId
     * @param int $productId
     * @param int $categoryId
     * @param string $code
     * @param string $name
     * @param string $kana
     * @param TaxDivision $taxDivision
     * @param int $price
     * @param int $customerPrice
     * @param int $cost
     * @param string $description
     */
    public function __construct(
        string $id,
        string $providerId,
        string $contractId,
        int $productId,
        int $categoryId,
        string $code,
        string $name,
        string $kana,
        TaxDivision $taxDivision,
        int $price,
        int $customerPrice,
        int $cost,
        string $description
    ) {
        $this->id = $id;
        $this->providerId = $providerId;
        $this->contractId = $contractId;
        $this->productId = $productId;
        $this->categoryId = $categoryId;
        $this->code = $code;
        $this->name = $name;
        $this->kana = $kana;
        $this->taxDivision = $taxDivision;
        $this->price = $price;
        $this->customerPrice = $customerPrice;
        $this->cost = $cost;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function providerId(): string
    {
        return $this->providerId;
    }

    /**
     * @return string
     */
    public function contractId(): string
    {
        return $this->contractId;
    }

    /**
     * @return int
     */
    public function productId(): int
    {
        return $this->productId;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function kana(): string
    {
        return $this->kana;
    }

    /**
     * @return int
     */
    public function categoryId(): int
    {
        return $this->categoryId;
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
    public function code(): string
    {
        return $this->code;
    }

    /**
     * @return int
     */
    public function cost(): int
    {
        return $this->cost;
    }

    /**
     * @return int
     */
    public function customerPrice(): int
    {
        return $this->customerPrice;
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return $this->description;
    }

    /**
     * @return TaxDivision
     */
    public function taxDivision(): TaxDivision
    {
        return $this->taxDivision;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'provider_id' => $this->providerId,
            'contract_id' => $this->contractId,
            'product_id' => $this->productId,
            'category_id' => $this->categoryId,
            'code' => $this->code,
            'name' => $this->name,
            'kana' => $this->kana,
            'tax_division' => $this->taxDivision,
            'price' => $this->price,
            'customer_price' => $this->customerPrice,
            'cost' => $this->cost,
            'description' => $this->description,
        ];
    }
}
