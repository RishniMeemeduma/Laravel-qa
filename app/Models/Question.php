<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['title','body'];

    public function user(){

      return  $this->belongsTo(User::class);   // one to many relation ship (user can have many questions)

    }

    public function answers(){

      return $this->hasMany(Answer::class);

    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getUrlAttribute()
    {
      return route('questions.show',$this->slug);
    }

    public function getCreatedDateAttribute()
    {
      return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
      if($this->answers_count > 0){
        if($this->best_answer_id){
          return "answer-accepted";
        }
        return 'answered';
      }

      return "unanswered";
    }

    public function getBodyHtmlAttribute()
    {
      return \Parsedown::instance()->text($this->body);
    }
    
}
