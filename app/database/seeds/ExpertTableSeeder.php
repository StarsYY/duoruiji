<?php


class ExpertTableSeeder extends Seeder
{
    public function run(){
        for ($i = 1; $i <= 10; $i++){
            $expert = new Expert();
            $expert->name = "lee".$i;
            $expert->portrait = "/images/head.jpg";
            $expert->department = "科室";
            $expert->title = "职称";
            $expert->position = "职务";
            $expert->hospital = "医院";
            $expert->introduction = "简介";
            $expert->edu = "接受教育";
            $expert->save();
        }
    }
}