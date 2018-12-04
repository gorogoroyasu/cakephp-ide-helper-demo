<?php

use Migrations\AbstractMigration;

class Base extends AbstractMigration
{
    private $tableStructures = [
        'users' => [
          'name' => 'string',
          'password' => 'string',
        ],
        'hobbies' => [
          'name' => 'string'
        ],
        'users_hobbies' => [
            'user_id' => 'integer',
            'hobby_id' => 'integer',
        ],
    ];

    private function setColumn($table, $name, $type)
    {
        $table->addColumn($name, $type, [
            'null' => true,
            'default' => null,
        ]);
    }
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function up()
    {
        $dates = [
            'created' => 'timestamp',
            'modified' => 'timestamp',
            'deleted' => 'timestamp',
        ];
        $t = $this->tableStructures;
        foreach ($t as $tableName => $contents) {
            $table = $this->table($tableName);
            foreach(array_merge($contents, $dates) as $name => $type) {
                $this->setColumn($table, $name, $type);
            }
            $table->save();
        }
    }

    public function down()
    {
        $t = array_keys($this->tableStructures);
        foreach($t as $tableName) {
            $table = $this->table($tableName);
            $table->drop()->save();
        }
    }
}
