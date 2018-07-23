<?php

namespace App\Model;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function addItem($item, $id)
    {
        $price = $this->getPrice($item);
        $storedItem = [
            'item' => $item,
            'qty' => 0,
            'price' => $price,
        ];

        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $this->setCartItemDetails($storedItem, 1, $price, $id);        
    }

    public function removeItem($id)
    {
        $this->totalPrice -= $this->items[$id]['price'];
        $this->totalQty -= $this->items[$id]['qty'];
        unset($this->items[$id]);
    }
    
    public function addMultipleItem($item, $id, $qty)
    {
        $price = $this->getPrice($item);

        $storedItem = [
            'item' => $item,
            'qty' => 0,
            'price' => $price,
        ];

        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $this->setCartItemDetails($storedItem, $qty, $price, $id);  
    }

    protected function getPrice($price)
    {
        $retVal = ($price->last_price) ? filter_var($price->last_price, FILTER_SANITIZE_NUMBER_INT) : filter_var($price->price, FILTER_SANITIZE_NUMBER_INT);
        return $retVal/100;
    }

    protected function setCartItemDetails($storedItem, $qty, $price, $id)
    {
        $storedItem['qty'] += $qty;
        $storedItem['price'] = $price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty += $qty;
        $this->totalPrice += $price * $qty;
    }
}
