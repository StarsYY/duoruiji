<?php


class ConfController extends BaseController
{
    /**
     * 名家讲堂
     */
    public function getIndex(){
        $start_video = Video::where('type', 'like', '0')->orderBy('start_time')->first();
        getQRCode($_SERVER['HTTP_HOST'], public_path() . "/upload/1.png");
        if (isset($start_video)){
            $expert = $start_video->experts()->first();
            return View::make('front.conf')->with('expert', $expert)->with('start_video', $start_video)->with('url', '/upload/1.png');
        }

        return View::make('front.conf')->with('url', '/upload/1.png');
    }

    /**
     * 更改直播类型
     */
    public function postChange(){
        $datas = Input::all();
        $id = $datas['id'];
        $video = Video::find($id);
        $video->type = 1;
        $video->update();

        return json_encode(array('success'=>true, 'msg'=>'成功了'));
    }
}