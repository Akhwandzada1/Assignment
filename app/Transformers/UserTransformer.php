<?php
namespace App\Transformers;

class UserTransformer extends Transformer
{

    public function transform($user, $options = null)
    {
        $data = [
            'success' => true,
            'email' => $user->email,
            'name' => $user->name,
            'message' => "Login Successful"
        ];

        if(isset($options['withToken']) && $options['withToken']){
            $data['access_token'] = $options['withToken'];
        }

        return $data;
    }
}