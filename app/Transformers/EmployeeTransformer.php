<?php
namespace App\Transformers;

class EmployeeTransformer extends Transformer{

    public function transform($companies, $options = null){
        $data = [
            'success' => true,
            'data' => $companies,
            'message' => "Employees Found successfully"
        ];

        return $data;
    }
}