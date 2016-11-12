<?php
/**
 * Created by PhpStorm.
 * User: m7md
 * Date: 09/11/16
 * Time: 09:20
 */

namespace app;


class Category extends \Eloquent
{
    protected $fillable = array('name');
    public static $rules = array('name' => 'required|min:3');

    public function products()
    {
        return $this->hasMany('Product');
    }
}