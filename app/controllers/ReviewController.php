<?php


class ReviewController extends BaseController
{
    /**
     * 往期视频
     */
    public function getIndex(){
        $videos = Video::where('type', 'like', '1')->orderBy('end_time', 'desc')->paginate(9);
        foreach ($videos as $v){
            $video = Video::find($v->id);
            $experts = $video->experts;
            foreach ($experts as $e){
                $v['name'] = $e->name;
                $v['expert_id'] = $e->id;
                break;
            }
        }
        return View::make('front.review')->with('videos', $videos);
    }

    /**
     * 往期视频详情
     */
    public function getReviewInfo($id){
        $video = Video::find($id);
        $experts = $video->experts;
        $expert_id = $video->experts()->first();
        if(isset($expert_id)){
            $expert = Expert::find($expert_id->id);
            $videos = $expert->videos()->where('type', 'like', '1')->orderBy('end_time', 'desc')->first();
            return View::make('front.reviewinfo')->with('video', $video)->with('experts', $experts)->with('videos', $videos);
        }
        return View::make('front.reviewinfo')->with('video', $video)->with('experts', $experts);
    }
}