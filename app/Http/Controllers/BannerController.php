<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use App\Models\Banner;
use Yajra\DataTables\Facades\DataTables;

class BannerController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        
        $data = array(
            'title' =>"Banners List",
            'deleteAction' =>'',
            'statusChangeAction' =>'',
        );
        
        return view('banners.list',$data);
    }

    public function ajax_list(Request $request)
    {
        $bannerModel = new Banner();

        if ($request->ajax()){
        $bannersData= $bannerModel->all();
       return DataTables::of($bannersData)
            ->addIndexColumn()
            ->addColumn('image_name',function($bannersData){
                $image_name = '<a href="'.$bannersData->image_url.'" target="_blank"><img width="20%" height="20%" src="'.$bannersData->image_url.'" alt=""/></a>';
                return $image_name;
            })
            ->addColumn('action', function($bannersData){
                $btn = '<a href="'.route('banner.edit',$bannersData['banner_id']).'" class="btn btn-outline-primary btn-sm" title="Edit"><i class="bi bi-pen"></i></a> | <button type="button" data-bs-toggle="modal" data-bs-target="#isDeleteModal" onclick="deleteBanner('.$bannersData->banner_id.')" class="btn btn-outline-danger btn-sm" title="Delete"><i class="bi bi-trash"></i></button>';
                return $btn;
            })
            ->addColumn('is_online', function($bannersData){
                if($bannersData->is_online == 'No'){
                    $btn = '<div class="form-check form-switch">
                    <input class="form-check-input" name="is_online" data-bs-toggle="modal" data-bs-target="#isOnlineModal" type="checkbox" role="switch" onclick="isOnlineChange('.$bannersData->banner_id.',$(this).val())" id="flexSwitchCheckDefault" value="No" />
                    <label class="form-check-label" for="flexSwitchCheckDefault">No</label>
                    </div>';
                }else{
                    $btn = '<div class="form-check form-switch">
                    <input class="form-check-input" data-bs-toggle="modal"
                    data-bs-target="#isOnlineModal" onclick="isOnlineChange('.$bannersData->banner_id.',$(this).val())"  name="is_online" value="Yes" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                        checked="" />
                    <label class="form-check-label" for="flexSwitchCheckChecked">Yes</label>
                </div>';
                }
               
                return $btn;
            }) 
            ->rawColumns(['banner_name','image_name','is_online','action'])
            ->make(true);        
        }
    }

    public function add(Request $request){
        $data = array(
            'action' =>route('banner.add_action'),
            'heading' =>'Add Banner',
            'button' =>'Save',
            'banner_id' =>0,
            'banner_name'=>$request->input('banner_name'),
        );
        return view('banners.add',$data);

    }
    
    public function add_action(Request $request){
        $this->rules($request);
        $bannerModel = new Banner();
        if($request->all()){

            $filename = "No file";
            if($request->hasfile('image_name'))
            {
                $file = $request->file('image_name');
                $extenstion = $file->getClientOriginalExtension();
                $filename = time().'.'.$extenstion;
                $image_name = $file->move('uploads/banners',$filename);
                $bannerModel->image_name = $filename;
                $bannerModel->image_url = $image_name;
            }
            $bannerModel->banner_name = $request->input('banner_name');
            $bannerModel->save();
            $request->session()->flash('message', 'success');
            $request->session()->flash('content', 'Data created successfully!');
        }else{
            $request->session()->flash('message', 'danger');
            $request->session()->flash('content', 'Data not created.');
        }
        return redirect()->route('banner.list');
    }

    public function edit($banner_id,Request $request){
        $bannerModel = new Banner();
        $getBannerData = $bannerModel->where('banner_id',$banner_id)->first();
        // print_r($getBannerData);exit;
        if($getBannerData){
            $data = array(
                'action' =>route('banner.update_action'),
                'heading' =>'Update Banner',
                'button' =>'Update',
                      
                'banner_name'=>$getBannerData['banner_name'],                      
                'image_name'=>$getBannerData['image_name'],                      
                'image_url'=>$getBannerData['image_url'],                      
                'banner_id'=>$banner_id,                      
                // 'totalBrokerage'=>$editData['totalBrokerage'],                      
            );

         return view('banners.add',$data);

        }else{
            $request->session()->flash('message', 'danger');
            $request->session()->flash('content', 'Data not found.');
            return redirect()->route('banner.list');
        }
    }

    public function update_action(Request $request){
        
        $this->update_rules($request);
        $banner_name = $request->input('banner_name');
        $image_name = $request->input('image_name');
        $old_image_name = $request->input('old_image_name');
        $image_url = $request->input('old_image_url');
        $banner_id = $request->input('banner_id');
        $bannerModel  = Banner::find($banner_id);
        
        if ($request->hasFile('image_name')){
            $image_path = public_path($image_url);
            if (\File::exists($image_path)) {
                \File::delete($image_path);
            }
                $file = $request->file('image_name');
                $extenstion = $file->getClientOriginalExtension();
                $imgName = time().'.'.$extenstion;
                $image_name = $file->move('uploads/banners/',$imgName);
                $bannerModel->image_url = $image_name;
          } else {
            $imgName = $old_image_name;
          }
           
           
        $bannerModel->banner_name = $banner_name;
        $bannerModel->image_name = $imgName;
        $bannerModel->save();

        return redirect()->route('banner.list');
    }


    public function ChangeIsOnline(Request $request){

        $banner_id = $request->input('banner_id');
        $is_online = $request->input('is_online');
       
            if($is_online=="No"){
                $status ="Yes";
            }else{
                $status = "No";
            }
           
            $bannerModel = Banner::find($banner_id);
            $bannerModel->is_online = $status;
            $bannerModel->save();
            $data = array(
                'msg' => 'data saved successfully.',
                'status' => 200
            );

            return response($data, 200);
    }

    public function DeleteBanner(Request $request){

        $banner_id = $request->input('banner_id');
        $bannerModel = Banner::find($banner_id);
        $path = public_path($bannerModel['image_url']);
        // print_r($path);exit;
        if($bannerModel){
            if(\File::exists(public_path($bannerModel['image_url']))){
                \File::delete(public_path($bannerModel['image_url']));
                $bannerModel->delete();
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

    public function rules($request)
    {

      $this->validate($request, [
        'banner_name' => 'required',
        'image_name' => 'required',
        ],
        [
        'banner_name.required'    => 'Please enter banner name.',
        'image_name.required'    => 'Please select banner.',
        ]
    );
    }

    public function update_rules($request)
    {

      $this->validate($request, [
        'banner_name' => 'required',
        ],
        [
        'banner_name.required'    => 'Please enter banner name.',
        ]
    );
    }
}