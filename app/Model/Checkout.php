<?php

namespace App\Model;


class Checkout
{
    public $address = null;
    public $payment = null;

    public function __construct($oldCheckout)
    {
        if ($oldCheckout) {
            $this->address = $oldCheckout->address;
            $this->payment = $oldCheckout->payment;
        }
    }

    public function addAddress($data)
    {
        $storedData = [
            "first_name" => $data->shipping_first_name,
            "last_name" => $data->shipping_last_name,
            "email" => $data->shipping_email,
            "address" => $data->shipping_address,
            "state" => $data->shipping_state,
            "phone" => $data->shipping_phone_number
        ];
        $this->address = $storedData;
    }
}
