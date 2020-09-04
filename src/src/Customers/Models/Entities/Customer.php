<?php
declare(strict_types=1);

namespace Smareco\Customers\Models\Entities;

use DateTimeInterface;
use Smareco\Customers\Models\ValueObjects\CustomerMailReceiveFlag;
use Smareco\Customers\Models\ValueObjects\CustomerSex;
use Smareco\Customers\Models\ValueObjects\CustomerStatus;

class Customer
{
    private string $id;
    private string $providerId;
    private string $contractId;
    private string $customerId;
    private string $code;
    private string $rank;
    private string $name;
    private string $kana;
    private string $email;
    private CustomerSex $sex;
    private ?DateTimeInterface $birthday;
    private string $storeId;
    private CustomerMailReceiveFlag $mailReceiveFlag;
    private CustomerStatus $customerStatus;

    /**
     * Customer constructor.
     *
     * @param string $id
     * @param string $providerId
     * @param string $contractId
     * @param string $customerId
     * @param string $code
     * @param string $rank
     * @param string $name
     * @param string $kana
     * @param string $email
     * @param CustomerSex $sex
     * @param DateTimeInterface|null $birthday
     * @param string $storeId
     * @param CustomerMailReceiveFlag $mailReceiveFlag
     * @param CustomerStatus $customerStatus
     */
    public function __construct(
        string $id,
        string $providerId,
        string $contractId,
        string $customerId,
        string $code,
        string $rank,
        string $name,
        string $kana,
        string $email,
        CustomerSex $sex,
        ?DateTimeInterface $birthday,
        string $storeId,
        CustomerMailReceiveFlag $mailReceiveFlag,
        CustomerStatus $customerStatus
    ) {
        $this->id = $id;
        $this->providerId = $providerId;
        $this->contractId = $contractId;
        $this->customerId = $customerId;
        $this->code = $code;
        $this->rank = $rank;
        $this->name = $name;
        $this->kana = $kana;
        $this->email = $email;
        $this->sex = $sex;
        $this->birthday = $birthday;
        $this->storeId = $storeId;
        $this->mailReceiveFlag = $mailReceiveFlag;
        $this->customerStatus = $customerStatus;
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
     * @return string
     */
    public function customerId(): string
    {
        return $this->customerId;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function birthday(): ?DateTimeInterface
    {
        return $this->birthday;
    }

    /**
     * @return string
     */
    public function code(): string
    {
        return $this->code;
    }

    /**
     * @return CustomerStatus
     */
    public function customerStatus(): CustomerStatus
    {
        return $this->customerStatus;
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function kana(): string
    {
        return $this->kana;
    }

    /**
     * @return CustomerMailReceiveFlag
     */
    public function mailReceiveFlag(): CustomerMailReceiveFlag
    {
        return $this->mailReceiveFlag;
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
    public function rank(): string
    {
        return $this->rank;
    }

    /**
     * @return CustomerSex
     */
    public function sex(): CustomerSex
    {
        return $this->sex;
    }

    /**
     * @return string
     */
    public function storeId(): string
    {
        return $this->storeId;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'provider_id' => $this->providerId,
            'contract_id' => $this->contractId,
            'customer_id' => $this->customerId,
            'code' => $this->code,
            'rank' => $this->rank,
            'name' => $this->name,
            'kana' => $this->kana,
            'email' => $this->email,
            'sex' => $this->sex->toInt(),
            'birthday' => $this->birthday->format('Y/m/d H:i:s'),
            'store_id' => $this->storeId,
            'mail_receive_flag' => $this->mailReceiveFlag->toInt(),
            'status' => $this->customerStatus->toInt(),
        ];
    }
}
