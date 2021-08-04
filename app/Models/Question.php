<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;
    use VotableTrait;
    protected $fillable = ['title','body'];

    public function user(){

      return  $this->belongsTo(User::class);   // one to many relation ship (user can have many questions)

    }

    public function answers(){

      return $this->hasMany(Answer::class)->orderBy('vote_count','DESC');

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
      return clean($this->_bodyHtml());
    }

    public function acceptBestAnswer(Answer $answer)
    {
      $this->best_answer_id = $answer->id;
      $this->save();
    }
    
    public function favourites()
    {
      return $this->belongsToMany(User::class,'favourites')->withTimestamps();
    }

    public function isFavourited()
    {
     return $this->favourites()->where('user_id',auth()->id())->count() > 0;
    }

    public function getIsFavouritedAttribute()
    {
      return $this->isFavourited();
    }

    public function getFavouritedCountAttribute()
    {
      return $this->favourites->count();
    }

    public function getExcerptAttribute()
    {
      return $this->excerpt(250);
    }

    public function excerpt($length){

      return Str::limit(strip_tags($this->_bodyHtml()),$length);
      
    }

    private function _bodyHtml()
    {
      return \Parsedown::instance()->text($this->body);
    }

    // public function setBodyAttribute($value)
    // {
    //   // $this->attribute['body'] = clean($value);
    // }
}
