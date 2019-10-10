<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\UploadTrait;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

Use App\Image;
Use App\Post;

class AdminImagesController extends Controller
{
    use UploadTrait;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $images = Image::paginate(10);
        return view('dashboard.allImages',['images'=>$images]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $posts = Post::all();
        return view('dashboard.createImage')->with(['posts'=>$posts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image = Image::find($id);
        $posts = Post::all();
               
        return view('dashboard.editImage')->with(['image'=>$image, 'posts'=>$posts]);
    }
        
    /**
    * Insert/Create the specified resource into storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function insert(Request $request){
        // Form validation
        $request->validate([
            'title' =>  'required',
            'uploadFile'  =>  'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $imageID = $this->saveImage($request);
        if($imageID){
            return redirect()->route('AdminEditImage',['id' =>$imageID ])->with(['status' => 'Image Created successfully.']);
        }
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        // Form validation
        $request->validate([
            'title' =>  'required',
            'uploadFile'  =>  'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $imageID = $this->saveImage($request, $id);
        if($imageID){
            return redirect()->route('AdminEditImage',['id' =>$imageID ])->with(['status' => 'Image Updated successfully.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {
        $image = Image::find($id);        
        //delete image from server
        if($image->image){
            $isImageExists = Storage::disk('local')->exists("public".$image->image);
            if($isImageExists){            
                Storage::delete('public'.$image->image);
            } 
        } 
        //delete record from database
        Image::destroy($id);        
        return redirect()->route('adminDisplayImages')->with(['status' => 'Image Deleted.']);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param $request object
     * @return $image ID or False
     */
    public function saveImage($request, $id=NULL) { 
        if($id){
            $image = Image::find($id);
            $image->image = $image->image;
        }else{
            $image = new Image; 
            $image->image = "";
        }                           
        $image->post_id = $request->post_id;       
        $image->title = $request->title;
        $image->alt = $request->alt;
        $image->caption = $request->caption;
        $image->order = $request->order;
        $image->description = $request->description;        
        if($request->has('uploadFile')){ //Check if an image has been uploaded
            $imageName = $request->title;
            $uploadFolder = '/uploads/projects/';
            $imageFileObj = $request->file('uploadFile');
            //upload image
            $filePath = $this->uploadImage($imageName,$imageFileObj,$uploadFolder); 
            // Set image path in database to filePath
            $image->image = $filePath;
        }
        if($image->save()){
            return $image->id;
        }        
        return false;
    }
    
    /**
     * Upload image.
     *
     * @param  String $imageName
     * @param  String $uploadFolder
     * @param  FILE object $imageFileObj
     * @return $filepath string
     */
    public function uploadImage($imageName, $imageFileObj, $uploadFolder=NULL) {  
        if(!$uploadFolder){
            $uploadFolder = '/uploads/';
        }
        // Make a image name based on pos and current timestamp
        $imageName = str_slug($imageName).'_'.time();
        // Make a file path where image will be stored [ folder path + file name + file extension]
        $filePath = $uploadFolder . $imageName. '.' . $imageFileObj->getClientOriginalExtension();
        // Upload image
        $this->uploadOne($imageFileObj, $uploadFolder, 'public', $imageName);        
        
        return $filePath;
    }

}
