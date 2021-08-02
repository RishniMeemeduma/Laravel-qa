<?php
namespace App\Models;

trait VotableTrait
{
    public function votes()
    {
      return $this->morphToMany(User::class,'votable');
    }

    public function voteDown()
    {
      return $this->votes()->wherePivot('likes',-1);
    }
    public function voteUp()
    {
      return $this->votes()->wherePivot('likes',1);
    }
}