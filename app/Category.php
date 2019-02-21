<?php

namespace App;
use App\Model;

class Category extends Model
{
    /**
     * 关联到模型的数据表
     * @var string
     */
    protected $table = 'categorys';

    /**
     * 表明模型是否应该被打上时间戳
     * @var bool
     */
    public $timestamps = false;

    public function index()
    {

    }

}