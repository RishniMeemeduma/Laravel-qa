<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function questions(){

        return $this->hasMany(Question::class);

    }

    public function getUrlAttribute()
    {
        return '#';
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function getAvatarAttribute()
    {
        $email = $this->email;
        $size = 32;

        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
    }

    public function favourites()
    {
        return $this->belongsToMany(Question::class,'favourites')->withTimestamps();
    }

    public function voteQuestions(){
        return $this->morphedByMany(Question::class,'votable');
    }

    public function voteAnswers()
    {
        return $this->morphedByMany(Answer::class,'votable');
    }

    public function voteQuestion(Question $question,$vote)
    {
        $voteQuestions = $this->voteQuestions();
        
        $this->__vote($voteQuestions,$question,$vote);
       
    }

    public function voteAnswer(Answer $answer,$vote)
    {
        $voteAnswer = $this->voteAnswers();
        
        $this->__vote($voteAnswer,$answer,$vote);
    }

    private function __vote($relationship,$model,$vote)
    {
        if($relationship->where('votable_id',$model->id)->exists()){
            $relationship->updateExistingPivot($model->id,['likes'=>$vote]);
        }else{
            $relationship->attach($model,['likes'=>$vote]);
        }

        $model->load('votes');
        $down_votes = (int) $model->voteUp()->sum('likes');
        $up_votes = (int) $model->voteDown()->sum('likes');

        if($model == '$question'){
            $model->vote_count =$up_votes + $down_votes;
        }else{
            $model->vote_count = $up_votes + $down_votes;
        }
        $model->save();
    }


}
