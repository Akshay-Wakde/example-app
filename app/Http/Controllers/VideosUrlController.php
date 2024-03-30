<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Models\VideosUrl;
use Yajra\DataTables\Facades\DataTables;

class VideosUrlController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        $data = array(
            'title' =>"Videos Urls",
            'add_route' =>route('url.add'),
            'statusChangeAction' =>'',
        );
        return view('videos_url.list',$data);
    }

    public function ajax_list(Request $request){
        $VideoUrlModel = new VideosUrl();
        if ($request->ajax()){
        $urlsData = $VideoUrlModel->all();
       return DataTables::of($urlsData)
            ->addIndexColumn()
            ->addColumn('action', function($urlsData){
                $btn = '<a href="'.route('url.edit',$urlsData['url_id']).'" class="btn btn-outline-primary btn-sm" title="Edit"><i class="bi bi-pen"></i></a> | <button type="button" data-bs-toggle="modal" data-bs-target="#isDeleteModal" onclick="deleteUrl('.$urlsData->url_id.')" class="btn btn-outline-danger btn-sm" title="Delete"><i class="bi bi-trash"></i></button>';
                return $btn;
            })
            ->addColumn('is_online', function($urlsData){
                if($urlsData->is_online == 'No'){
                    $btn = '<div class="form-check form-switch">
                    <input class="form-check-input" name="is_online" data-bs-toggle="modal" data-bs-target="#isOnlineModal" type="checkbox" role="switch" onclick="isOnlineChange('.$urlsData->url_id.',$(this).val())" id="flexSwitchCheckDefault" value="No" />
                    <label class="form-check-label" for="flexSwitchCheckDefault">No</label>
                    </div>';
                }else{
                    $btn = '<div class="form-check form-switch">
                    <input class="form-check-input" data-bs-toggle="modal"
                    data-bs-target="#isOnlineModal" onclick="isOnlineChange('.$urlsData->url_id.',$(this).val())"  name="is_online" value="Yes" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                        checked="" />
                    <label class="form-check-label" for="flexSwitchCheckChecked">Yes</label>
                </div>';
                }
                return $btn;
            }) 
            ->rawColumns(['url','is_online','action'])
            ->make(true);        
        }
    }

    public function add(Request $request){
        $data = array(
            'action' =>route('url.add_action'),
            'heading' =>'Add URL',
            'button' =>'Save',
            'url_id' =>0,
            'url'=>$request->input('url_name'),
        );
        return view('videos_url.add',$data);
    }

    public function add_action(Request $request){
        $this->rules($request);
        $VideoUrlModel = new VideosUrl();
        if($request->all()){
            $VideoUrlModel->url = $request->input('url');
            $VideoUrlModel->save();
            $request->session()->flash('message', 'success');
            $request->session()->flash('content', 'Data created successfully!');
        }else{
            $request->session()->flash('message', 'danger');
            $request->session()->flash('content', 'Data not created.');
        }
        return redirect()->route('url.list');
    }

    public function rules($request){
        $this->validate($request, 
        ['url' => 'required'],
        [
            'url.required'    => 'Please enter url.',
            // 'url.url'    => 'Please enter valid url.',
        ]
        );
    }

    public function edit($url_id,Request $request){
        $UrlModel = new VideosUrl();
        $getUrlData = $UrlModel->where('url_id',$url_id)->first();
        if($getUrlData){
            $data = array(
                'action' =>route('url.update_action'),
                'heading' =>'Update URL',
                'button' =>'Update',
                'url'=>$getUrlData['url'],                   
                'url_id'=>$url_id,                      
            );

         return view('videos_url.add',$data);

        }else{
            $request->session()->flash('message', 'danger');
            $request->session()->flash('content', 'Data not found.');
            return redirect()->route('url.list');
        }
    }

    public function update_action(Request $request){
        $this->rules($request);
        $url = $request->input('url');
        $url_id = $request->input('url_id');
        $UrlModel  = VideosUrl::find($url_id);        
        $UrlModel->url = $url;
        $UrlModel->save();
        return redirect()->route('url.list');
    }

    public function ChangeIsOnline(Request $request){

        $url_id = $request->input('url_id');
        $is_online = $request->input('is_online');
       
            if($is_online=="No"){
                $status ="Yes";
            }else{
                $status = "No";
            }
           
            $UrlModel = VideosUrl::find($url_id);
            $UrlModel->is_online = $status;
            $UrlModel->save();
            $data = array(
                'msg' => 'data saved successfully.',
                'status' => 200
            );

            return response($data, 200);
    }

    public function DeleteUrl(Request $request){
        $url_id = $request->input('url_id');
        $UrlModel = VideosUrl::find($url_id);
        if($UrlModel){
            if($UrlModel->delete()){
                $msg='data deleted successfully.';
            }else{
               $msg = 'File Does not exists';
            }
        }
        $data = array(
            'msg' =>$msg,
            'status' => 200
        );
        return response($data, 200);
    }


}
