<?php


class VideoTableSeeder extends Seeder
{
    public function run(){
        for ($i = 1; $i <= 10; $i++){
            $video = new Video();
            $video->title = "视频标题".$i;
            $video->url = "/images/video.mp4";
            $video->type = "1";
            $video->course = "课程简介";
            $video->start_time = "开始时间";
            $video->end_time = "结束时间";
            $video->cover = "/images/def.jpg";
            $video->save();
        }
    }
}