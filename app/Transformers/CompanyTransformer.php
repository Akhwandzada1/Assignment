<?php
namespace App\Transformers;

class CompanyTransformer extends Transformer{

    public function transform($companies, $options = null){
        $data = [
            'success' => true,
            'data' => $companies,
            'message' => "Companies Found successfully"
        ];

        return $data;
    }
}