<?php
// src/Model/Table/AlbumsTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class AlbumsTable extends Table
{    
    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('name')
            ->requirePresence('name')
            ->notEmpty('tag')
            ->requirePresence('tag');

        return $validator;
    }
}