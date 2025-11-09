<?php

declare(strict_types=1);

namespace App\Api\Magento\GraphQl\Schema\Queries;

use GraphQL\SchemaObject\InputObject;

class OrderInformationInputInputObject extends InputObject
{
    protected $email;

    protected $lastname;

    protected $number;

    public function setEmail($email): static
    {
        $this->email = $email;

        return $this;
    }

    public function setLastname($lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function setNumber($number): static
    {
        $this->number = $number;

        return $this;
    }
}
