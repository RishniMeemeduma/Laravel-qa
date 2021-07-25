<?php

namespace App\Models;

use Parsedown;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Answer extends Model
{
    use HasFactory;

    public function question(){

        return $this->belongsTo(Question::class);

    }

    public function user(){

        return $this->belongsTo(User::class);

    }

    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }
}
