<?php

namespace App\Transformers;

class ProjectTransformer extends Transformer{

    public function transform($projects, $options = null){
        $data = [
            'success' => true,
            'data' => $projects,
            'message' => "Projects found successfully"
        ];

        return $data;

    }
}