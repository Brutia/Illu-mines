<?php
// src/Model/Table/ImagesTable.php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ImagesTable extends Table
{    
    public function validationDefault(Validator $validator)
    {
        return $validator;
    }
}