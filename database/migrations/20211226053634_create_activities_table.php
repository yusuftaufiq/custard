<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateActivitiesTable extends AbstractMigration
{
    final public function change(): void
    {
        $this->table('activities')
            ->addColumn('email', 'string', [
                'null' => true,
            ])
            ->addColumn('title', 'string')
            // ->addColumn('created_at', 'timestamp', [
            //     'default' => 'CURRENT_TIMESTAMP',
            // ])
            // ->addColumn('updated_at', 'timestamp', [
            //     'default' => 'CURRENT_TIMESTAMP',
            //     'update' => 'CURRENT_TIMESTAMP',
            // ])
            // ->addColumn('deleted_at', 'timestamp', [
            //     'null' => true,
            // ])
            ->create();
    }
}
