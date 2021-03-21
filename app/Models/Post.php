<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    //Table Name
    protected $table = 'posts';

    // Primary key
    protected $primarykey = 'id';

    protected $fillable = [
        'title',
        'body'
    ];

    //Timestamps
    public $timestamps = true;
    
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    
    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }
    
}
