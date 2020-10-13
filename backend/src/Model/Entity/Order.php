<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property int $client_id
 * @property float $total
 * @property string $status
 * @property \Cake\I18n\FrozenDate|null $date_order
 * @property \Cake\I18n\FrozenTime $created_at
 * @property \Cake\I18n\FrozenTime $modified_at
 *
 * @property \App\Model\Entity\Client $client
 * @property \App\Model\Entity\OrderList[] $order_lists
 */
class Order extends Entity
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
        'client_id' => true,
        'total' => true,
        'status' => true,
        'date_order' => true,
        'created_at' => false,
        'modified_at' => false,
        'client' => true,
        'order_lists' => true,
    ];
}
