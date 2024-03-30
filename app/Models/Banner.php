<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'tblbanners';
    protected $primaryKey = 'banner_id';
    public $incrementing = true;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    //Function to show banners on website from MainController
    public function getBannerImages(){
        $bannerModel = new Banner();
        $getBannerImages = $bannerModel->where('is_online','Yes')->get();
        $bannerImages = array();

        foreach($getBannerImages as $images){
            $data = array(
                'image_name'=>$images->image_name,
                'image_url'=>$images->image_url,
            );

             array_push($bannerImages,$data);

        }

        // print_r($bannerImages);exit;
        if($getBannerImages->isEmpty()){
            return false;
        }else{
            return $bannerImages;
        }
       

    }

}
