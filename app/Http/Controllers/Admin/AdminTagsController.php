<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Tag;

class AdminTagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $tags = Tag::paginate(10);
        return view('dashboard.allTags',['tags'=>$tags]);
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('dashboard.createTag');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $tag = Tag::find($id);
        
        return view('dashboard.editTag')->with(['tag'=>$tag]);
;    }

    /**
    * Insert/Create the specified resource into storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function insert(Request $request){   
         // Form validation
         $request->validate([
            'title' =>  'required'
        ]);
        $tagID = $this->saveTag($request);
        if($tagID){
            return redirect()->route('AdminEditTag',['id' =>$tagID ])->with(['status' => 'Tag Created successfully.']);
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
            'title' =>  'required'
        ]);
        $tagID = $this->saveTag($request, $id);
        if($tagID){
            return redirect()->route('AdminEditTag',['id' =>$tagID ])->with(['status' => 'Tag Updated successfully.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id) {
        //find tag by id
        $tag = Tag::find($id);         
        //delete record from database
        Tag::destroy($id); 
        //redirect to dashboard all tags list
        return redirect()->route('adminDisplayTags')->with(['status' => 'Tag Deleted.']);
    }
    
    /**
     * Store resource in storage.
     *
     * @param $request object
     * @return $tag ID or False
     */
    public function saveTag($request, $id=NULL) { 
        if($id){
            $tag = Tag::find($id);
        }else{
            $tag = new Tag; 
        }       
        
        if($request->slug){
            $tag->slug = str_slug($request->slug);
        } else {
            $tag->slug = str_slug($request->title);
        } 
        $tag->title = $request->title;               
        $tag->order = $request->order;
        
        if($tag->save()){
            return $tag->id;
        }        
        return false;
    }
    
    /**
    * getAjaxTags 
    */    
    public function getAjaxTags(){
        $tags = Tag::all();        
        return response()->json($tags);
    }
}
