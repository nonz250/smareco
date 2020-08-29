<?php
declare(strict_types=1);

namespace Smareco\Customers\Models\ValueObjects;

use DateTimeInterface;

class Customer
{
    private string $id;
    private string $code;
    private string $rank;
    private string $name;
    private string $kana;
    private string $email;
    private string $sex;
    private ?DateTimeInterface $birthday;
    private string $storeId;
    private string $mailReceiveFlag;

    /**
     * Customer constructor.
     *
     * @param string $id
     * @param string $code
     * @param string $rank
     * @param string $name
     * @param string $kana
     * @param string $email
     * @param string $sex
     * @param DateTimeInterface|null $birthday
     * @param string $storeId
     * @param string $mailReceiveFlag
     */
    public function __construct(
        string $id,
        string $code,
        string $rank,
        string $name,
        string $kana,
        string $email,
        string $sex,
        ?DateTimeInterface $birthday,
        string $storeId,
        string $mailReceiveFlag
    ) {
        $this->id = $id;
        $this->code = $code;
        $this->rank = $rank;
        $this->name = $name;
        $this->kana = $kana;
        $this->email = $email;
        $this->sex = $sex;
        $this->birthday = $birthday;
        $this->storeId = $storeId;
        $this->mailReceiveFlag = $mailReceiveFlag;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'rank' => $this->rank,
            'name' => $this->name,
            'kana' => $this->kana,
            'email' => $this->email,
            'sex' => $this->sex,
            'birthday' => $this->birthday->format('Y/m/d H:i:s'),
            'store_id' => $this->storeId,
            'mail_receive_flag' => $this->mailReceiveFlag,
        ];
    }
}
