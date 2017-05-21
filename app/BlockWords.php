<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlockWords extends Model
{
    protected $fillable = ['word', 'author'];

    public function getAuthor()
    {
        return $this->belongsTo('App\User', 'author');
    }
}
