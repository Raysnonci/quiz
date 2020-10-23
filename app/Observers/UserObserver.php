<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    /**
     * @param Model $model
     */
    public function creating(Model $model)
    {
        $created_by = $model->getPrefixName()."_created_by";
        $updated_by = $model->getPrefixName()."_updated_by";
        
        if(Auth::user()){
            $model->$created_by = Auth::user()->id;
            $model->$updated_by = Auth::user()->id;
        }
    }

    /**
     * @param Model $model
     */
    public function updating(Model $model)
    {
        $model->updated_by = Auth::user()->id;
    }
}
