<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideosUrl extends Model
{
    use HasFactory;
    protected $table = 'videos_url';
    protected $primaryKey = 'url_id';
    public $incrementing = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    //Function to show url on website from MainController
    public function getUrls(){
        $urlModel = new VideosUrl();
        $getUrls = $urlModel->where('is_online','Yes')->get();
        $urls = array();

        foreach($getUrls as $url){
            $data = array(
                'url'=>$url->url,
            );

             array_push($urls,$data);

        }

        // print_r($urls);exit;
        if($getUrls->isEmpty()){
            return false;
        }else{
            return $urls;
        }
       

    }
}
