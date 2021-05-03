<?php


class ExpertsController extends BaseController
{
    /**
     * 名家风采
     */
    public function getIndex(){
        $experts = Expert::orderBy('created_at', 'desc')->paginate(9);
        return View::make('front.expert')->with('experts', $experts);
    }

    /**
     * 名家风采详情    最近一次的直播或刚刚结束的直播
     */
    public function getExpertInfo($id){
        $expert = Expert::find($id);
        $start_video = $expert->videos()->where('type', 'like', '0')->orderBy('start_time')->first();
        $end_video = $expert->videos()->where('type', 'like', '1')->orderBy('end_time', 'desc')->first();
        $video_id = '-1';
        if (isset($start_video)){
            $course = $start_video->course;
            $video_id = $start_video->id;
        } elseif (isset($end_video)){
            $course = $end_video->course;
            $video_id = $end_video->id;
        }
        if ($video_id > 0){
            $video = Video::find($video_id);
            $experts = $video->experts;
            return View::make('front.expertinfo')->with('expert', $expert)->with('course', $course)->with('experts', $experts);
        }
        return View::make('front.expertinfo')->with('expert', $expert);
    }
}