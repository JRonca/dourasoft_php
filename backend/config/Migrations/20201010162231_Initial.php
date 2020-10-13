<?php
use Migrations\AbstractMigration;

class Initial extends AbstractMigration
{
    public function up()
    {

        $this->table('clients')
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('phone', 'string', [
                'default' => null,
                'limit' => 15,
                'null' => false,
            ])
            ->addColumn('address', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'now()',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified_at', 'timestamp', [
                'default' => 'now()',
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('order_lists')
            ->addColumn('order_id', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('product_code', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('quantity', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('unitary_value', 'float', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('amount', 'float', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'now()',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified_at', 'timestamp', [
                'default' => 'now()',
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'order_id',
                ]
            )
            ->addIndex(
                [
                    'product_code',
                ]
            )
            ->create();

        $this->table('orders')
            ->addColumn('client_id', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('total', 'float', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('status', 'string', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('date_order', 'date', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'now()',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified_at', 'timestamp', [
                'default' => 'now()',
                'limit' => null,
                'null' => false,
            ])
            ->addIndex(
                [
                    'client_id',
                ]
            )
            ->create();

        $this->table('products', ['id' => false, 'primary_key' => ['code']])
            ->addColumn('code', 'integer', [
                'default' => null,
                'limit' => 10,
                'null' => false,
            ])
            ->addColumn('name', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('description', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('price', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'now()',
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('modified_at', 'timestamp', [
                'default' => 'now()',
                'limit' => null,
                'null' => false,
            ])
            ->create();

        $this->table('order_lists')
            ->addForeignKey(
                'order_id',
                'orders',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->addForeignKey(
                'product_code',
                'products',
                'code',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();

        $this->table('orders')
            ->addForeignKey(
                'client_id',
                'clients',
                'id',
                [
                    'update' => 'NO_ACTION',
                    'delete' => 'NO_ACTION'
                ]
            )
            ->update();
    }

    public function down()
    {
        $this->table('order_lists')
            ->dropForeignKey(
                'order_id'
            )
            ->dropForeignKey(
                'product_code'
            )->save();

        $this->table('orders')
            ->dropForeignKey(
                'client_id'
            )->save();

        $this->table('clients')->drop()->save();
        $this->table('order_lists')->drop()->save();
        $this->table('orders')->drop()->save();
        $this->table('products')->drop()->save();
    }
}
