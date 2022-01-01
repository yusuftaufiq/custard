<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateTodoListsTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    final public function change(): void
    {
        $this->table('todos', ['engine' => 'MyISAM'])
            ->addColumn('activity_group_id', 'integer')
            ->addForeignKey('activity_group_id', 'activities', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION',
            ])
            ->addColumn('title', 'string')
            ->addColumn('is_active', 'enum', [
                'default' => true,
                'values' => [
                    true,
                    false,
                ],
            ])
            ->addColumn('priority', 'enum', [
                'default' => 'very-high',
                'values' => [
                    'very-low',
                    'low',
                    'high',
                    'very-high',
                ],
            ])
            ->addColumn('created_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
            ])
            ->addColumn('updated_at', 'timestamp', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP',
            ])
            ->addColumn('deleted_at', 'timestamp', [
                'null' => true,
            ])
            ->create();
    }
}
