<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected  $table = 'likes';

    protected $primarykey = 'id';

    protected $fillable = [
        'post_id',
        'user_id',
    ];

    public $timestamps = true;

    public function post(){
        return $this->belongsTo('App\Models\Post');
    }

    public function user(){
        return $this->belongsTo('App\Model\USer');
    }
}
