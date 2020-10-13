<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderList Entity
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_code
 * @property int $quantity
 * @property float $unitary_value
 * @property float $amount
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $modified_at
 *
 * @property \App\Model\Entity\Order $order
 */
class OrderList extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'order_id' => true,
        'product_code' => true,
        'quantity' => true,
        'unitary_value' => true,
        'amount' => true,
        'created_at' => false,
        'modified_at' => false,
        'order' => true,
    ];
}
