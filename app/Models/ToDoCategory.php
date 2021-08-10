<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDoCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name','status'];  

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    protected $table = 'to_do_categories';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public function todo()
    {
        return $this->hasMany('App\Models\ToDo');
    }

}
