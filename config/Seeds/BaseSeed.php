<?php

use Migrations\AbstractSeed;

/**
 * Base seed.
 */
class BaseSeed extends AbstractSeed
{
    private $now;
    private $tableContents = [
        'users' => [
            'aaa',
            'bbb',
            'ccc',
        ],
        'hobbies' => [
            'baseball',
            'soccer',
            'tennis',
            'basketball',
            'swimming',
        ],
    ];

    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $hasher = new \Cake\Auth\DefaultPasswordHasher();
        $this->now = \Cake\I18n\FrozenTime::now();
        foreach($this->tableContents as $tableName => $contents) {
            $data = [];
            $table = $this->table($tableName);
            foreach($contents as $content) {
                $data[] = [
                    'name' => $content,
                    'created' => $this->now,
                    'modified' => $this->now,
                    'deleted' => $this->now,
                ];
                if ($tableName == 'users') {
                    $data[] = ['password' => $hasher->hash($content)];
                }
            }
            $table->insert($data)->save();
        }

        $table = $this->table('users_hobbies');
        $data = [];
        for($i=0; $i<2; $i++) {
            for($j=2; $j<5; $j++) {
                $data[] = [
                    'user_id' => $i,
                    'hobby_id' => $i,
                    'created' => $this->now,
                    'modified' => $this->now,
                    'deleted' => $this->now,
                ];
            }
        }
        $table->insert($data)->save();
    }
}
