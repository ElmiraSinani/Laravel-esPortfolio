<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

use App\Post;
use App\Tag;
use App\Image;


class AdminPostsController extends Controller {
    
    use UploadTrait;  
    
    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return view('dashboard.allPosts',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
       return view('dashboard.createPost');
    }
    
     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $post = Post::find($id);
        
        $selectedTagIDs = '';
        foreach($post->tags as $k=>$tag){      
            $selectedTagIDs .= $tag->id.',';
        }
        $selectedTagIDs = rtrim($selectedTagIDs, ',');
        
               
        
        return view('dashboard.editPost')->with(['post'=>$post, 'selectedTagIds'=> $selectedTagIDs]);
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
            'image'  =>  'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $showSourceLink = $request->input('showSourcePreviewLink');
        $showLiveLink = $request->input('showLivePreviewLink');
        $post = new Post;
        $post->title = $request->input('title');
        $post->slug = str_slug($request->input('slug'));
        $post->content = $request->input('content');
        $post->sourcePreviewLink = $request->input('sourcePreviewLink');
        $post->showSourcePreviewLink = (isset($showSourceLink)&&$showSourceLink!=NULL) ? $showSourceLink : "0";
        $post->livePreviewLink = $request->input('livePreviewLink');
        $post->showLivePreviewLink = (isset($showLiveLink)&&$showLiveLink!=NULL) ? $showLiveLink : "0";
        $post->order = $request->input('order') ? $request->input('order') : "0";
        
        if($post->save()) {
            
            //Save Tags
            if($request->input('tags')!= NULL){
                $tagsStr = $request->input('tags');
                $tags = explode( ',', $tagsStr);
                $post->tags()->sync($tags);
            }
            
            //upload and save images
            // Check if an image has been uploaded
            if ($request->has('uploadFile')) {
                // Get image file
                $galleryImages = $request->file('uploadFile');
                $imagesInfo = $request->images;

                foreach ($galleryImages as $key => $thisImage){
                    // Make a image name based on pos and current timestamp
                    $name = str_slug($request->input('title')).'_'.time();
                    // Define folder path
                    $folder = '/uploads/projects/';
                    // Make a file path where image will be stored [ folder path + file name + file extension]
                    $filePath = $folder . $name. '.' . $thisImage->getClientOriginalExtension();
                    // Upload image
                    $this->uploadOne($thisImage, $folder, 'public', $name);
                    // Set user profile image path in database to filePath
                    
                    $imageRequestInfo = $request->input('images');
                    //create new image
                    $image = new Image;
                    
                    $image->post_id = $post->id;
                    $image->image = $filePath;
                    $image->title = $imageRequestInfo[$key]['title'];
                    $image->alt = $imageRequestInfo[$key]['alt'];
                    $image->caption = $imageRequestInfo[$key]['caption'];
                    $image->order = $imageRequestInfo[$key]['order'];
                    $image->description = $imageRequestInfo[$key]['description'];
                    $image->save();

                }
            }

            return redirect()->route('AdminEditPost',['id' =>$post->id ])->with(['status' => 'Post Created successfully.']);
        } 
        
        
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id){
        
        // Form validation
        $request->validate([
           'title' =>  'required',
           'image'  =>  'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $showSourceLink = $request->input('showSourcePreviewLink');
        $showLiveLink = $request->input('showLivePreviewLink');
        
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->content = $request->input('content');
        $post->sourcePreviewLink = $request->input('sourcePreviewLink');
        $post->showSourcePreviewLink = (isset($showSourceLink)&&$showSourceLink!=NULL) ? $showSourceLink : "0";
        $post->livePreviewLink = $request->input('livePreviewLink');
        $post->showLivePreviewLink = (isset($showLiveLink)&&$showLiveLink!=NULL) ? $showLiveLink : "0";
        $post->order = $request->input('order') ? $request->input('order') : "0";
        
        
        
        
        
        if($post->save()) {
            //Save Tags
            if($request->input('tags')!= NULL){
                $tagsStr = $request->input('tags');
                $tags = explode( ',', $tagsStr);
                $post->tags()->sync($tags);
            }
            //upload and save images
            // Check if an image has been uploaded
            if ($request->has('uploadFile')) {
                // Get image file
                $galleryImages = $request->file('uploadFile');
                $imagesInfo = $request->images;

                foreach ($galleryImages as $key => $image){
                    // Make a image name based on pos and current timestamp
                    $name = str_slug($request->input('title')).'_'.time();
                    // Define folder path
                    $folder = '/uploads/projectImages/';
                    // Make a file path where image will be stored [ folder path + file name + file extension]
                    $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
                    // Upload image
                    $this->uploadOne($image, $folder, 'public', $name);
                    // Set user profile image path in database to filePath
                    
                    

                }
            }

            return redirect()->route('AdminEditPost',['id' =>$post->id ])->with(['status' => 'Post Updated successfully.']);
        }       
        
    }
    
    
    
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id){

        $post = Post::find($id);
        
        //delete image from server
        if($post->image){
            $isImageExists = Storage::disk('local')->exists("public".$post->image);
            if($isImageExists){            
                Storage::delete('public'.$post->image);
            } 
        }
 
        //delete record from database
        Post::destroy($id);
        
        return redirect()->route('adminDisplayPosts')->with(['status' => 'Post Deleted.']);
    }
}
