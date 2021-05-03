<?php


class FrontController extends BaseController
{
    /**
     * 前台首页
     */
    public function getIndex(){
        $videos = Video::where('type', 'like', '1')->orderBy('end_time', 'desc')->paginate(3);
        foreach ($videos as $v){
            $video = Video::find($v->id);
            $experts = $video->experts;
            foreach ($experts as $e){
                $v['name'] = $e->name;
                $v['expert_id'] = $e->id;
                break;
            }
        }

        $start_video = Video::where('type', 'like', '0')->orderBy('start_time')->first();
        $end_video = Video::where('type', 'like', '1')->orderBy('end_time', 'desc')->first();
        if (isset($start_video)){
            $experts = $start_video->experts()->paginate(2);
        } elseif (isset($end_video)){
            $experts = $end_video->experts()->paginate(2);
        }

        $count = Video::where('type', 'like', '0')->count();
        getQRCode($_SERVER['HTTP_HOST'], public_path() . "/upload/1.png");

        return View::make('index')->with('videos', $videos)->with('experts', $experts)->with('count', $count)->with('start_video', $start_video)->with('url', "/upload/1.png");
    }
}