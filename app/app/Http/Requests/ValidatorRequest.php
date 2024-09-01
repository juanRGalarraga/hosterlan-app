<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;

trait ValidatorRequest {
    protected $validatorCheck = false;
    public function check($data){
        return $this->validatorCheck = Validator::make($data, $this->rules());
    }

    public function fails(){
        return $this->validatorCheck->fails();
    }

    public function errors(){
        return $this->validatorCheck->errors();
    }

}