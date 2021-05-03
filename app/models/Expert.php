<?php


class Expert extends Eloquent
{
    public function videos(){
        return $this->belongsToMany('Video', 'experts_videos');
    }
}