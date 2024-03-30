<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\VideosUrl;

class MainController
{
    public function index(){
        
        $bannerModel = new Banner();
        $getBannerImages = $bannerModel->getBannerImages();
        $urlModel = new VideosUrl();
        $getUrls = $urlModel->getUrls();

        
        $showBanners = array();
        if($getBannerImages!=false){
            $showBanners = $getBannerImages;
        }
        $showUrls = array();
        if($getUrls!=false){
            $showUrls = $getUrls;
        }
        $data = array(
            'showBanners'=>$showBanners,
            'showUrls'=>$showUrls
        );
        return view('site.home',$data);
    }

}
