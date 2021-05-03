<?php


class Video extends Eloquent
{
    public function experts(){
        return $this->belongsToMany('Expert', 'experts_videos');
    }
}