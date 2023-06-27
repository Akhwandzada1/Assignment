<?php
namespace App\Transformers;

class EmployeeTransformer extends Transformer{

    public function transform($companies, $options = null){

        return $companies;
    }
}