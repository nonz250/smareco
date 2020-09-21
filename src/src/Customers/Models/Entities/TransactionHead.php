<?php
declare(strict_types=1);

namespace Smareco\Customers\Models\Entities;

use DateTimeInterface;
use Smareco\Customers\Models\Collection\TransactionDetailCollection;
use Smareco\Shared\Models\ValueObjects\CancelDivision;

class TransactionHead
{
    private string $id;
    private string $providerId;
    private string $contractId;
    private string $transactionHeadId;
    private DateTimeInterface $transactionDatetime;
    /**
     * @var CancelDivision
     */
    private CancelDivision $cancelDivision;
    private int $total;
    private int $pointDiscount;
    private int $amount;
    private string $storeId;
    private string $customerId;
    private string $customerCode;
    /**
     * @var TransactionDetailCollection
     */
    private TransactionDetailCollection $details;

    /**
     * TransactionHead constructor.
     *
     * @param string $id
     * @param string $providerId
     * @param string $contractId
     * @param string $transactionHeadId
     * @param DateTimeInterface $transactionDatetime
     * @param CancelDivision $cancelDivision
     * @param int $total
     * @param int $pointDiscount
     * @param int $amount
     * @param string $storeId
     * @param string $customerId
     * @param string $customerCode
     * @param TransactionDetailCollection $details
     */
    public function __construct(
        string $id,
        string $providerId,
        string $contractId,
        string $transactionHeadId,
        DateTimeInterface $transactionDatetime,
        CancelDivision $cancelDivision,
        int $total,
        int $pointDiscount,
        int $amount,
        string $storeId,
        string $customerId,
        string $customerCode,
        TransactionDetailCollection $details
    ) {
        $this->id = $id;
        $this->providerId = $providerId;
        $this->contractId = $contractId;
        $this->transactionHeadId = $transactionHeadId;
        $this->transactionDatetime = $transactionDatetime;
        $this->cancelDivision = $cancelDivision;
        $this->total = $total;
        $this->pointDiscount = $pointDiscount;
        $this->amount = $amount;
        $this->storeId = $storeId;
        $this->customerId = $customerId;
        $this->customerCode = $customerCode;
        $this->details = $details;
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
    public function id(): string
    {
        return $this->id;
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
    public function amount(): int
    {
        return $this->amount;
    }

    /**
     * @return CancelDivision
     */
    public function cancelDivision(): CancelDivision
    {
        return $this->cancelDivision;
    }

    /**
     * @return string
     */
    public function customerCode(): string
    {
        return $this->customerCode;
    }

    /**
     * @return string
     */
    public function customerId(): string
    {
        return $this->customerId;
    }

    /**
     * @return TransactionDetailCollection
     */
    public function details(): TransactionDetailCollection
    {
        return $this->details;
    }

    /**
     * @return int
     */
    public function pointDiscount(): int
    {
        return $this->pointDiscount;
    }

    /**
     * @return string
     */
    public function storeId(): string
    {
        return $this->storeId;
    }

    /**
     * @return int
     */
    public function total(): int
    {
        return $this->total;
    }

    /**
     * @return DateTimeInterface
     */
    public function transactionDatetime(): DateTimeInterface
    {
        return $this->transactionDatetime;
    }

    /**
     * @return string
     */
    public function transactionHeadId(): string
    {
        return $this->transactionHeadId;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'provider_id' => $this->providerId,
            'contract_id' => $this->contractId,
            'transaction_datetime' => $this->transactionDatetime->format('Y/m/d H:i:s'),
            'cancel_division' => $this->cancelDivision->toInt(),
            'total' => $this->total,
            'point_discount' => $this->pointDiscount,
            'amount' => $this->amount,
            'store_id' => $this->storeId,
            'customer_id' => $this->customerId,
            'customer_code' => $this->customerCode,
            'details' => $this->details->toArray(),
        ];
    }
}
