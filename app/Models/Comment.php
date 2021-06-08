<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $primarykey = 'id';

    protected $fillable = [
        'post_id',
        'user_id' ,
        'commenttext',
    ];

    public $timestamps = true;

    public function post(){
        return $this->belongsTo('App\Models\Post');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
