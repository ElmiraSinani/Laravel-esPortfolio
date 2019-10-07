@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{route('AdminInsertPost')}}" method="post" enctype="multipart/form-data"  class="w-100">
    @csrf
    <div class="row ">
        
        <div class="col-md-3">
            @include('dashboard.sidebar')     
        </div><!-- / .col-md-4 -->
        
        <div class="col-md-9">
            <div class="card mb-4">
                <div class="card-header">{{ __('Add Project') }}</div>
                <div class="form py-4">
                    <div class="form-group row">
                        <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Title') }}</label>
                        <div class="col-md-8">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="" required autofocus>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="slug" class="col-md-2 col-form-label text-md-right">{{ __('Slug') }}</label>
                        <div class="col-md-8">
                            <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="" required />
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="content" class="col-md-2 col-form-label text-md-right">{{ __('Description') }}</label>
                        <div class="col-md-8">
                            <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content" ></textarea>
                            @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="order" class="col-md-2 col-form-label text-md-right">{{ __('Order') }}</label>
                        <div class="col-md-8">
                            <input id="order" type="number" min="0" step="1" class="form-control @error('order') is-invalid @enderror" name="order" value="" />
                            @error('order')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="tag" class="col-md-2 col-form-label text-md-right">{{ __('Tags') }}</label>
                        <div class="col-md-8">
                            <input name="tags" type="text" class="input-tags  @error('tag') is-invalid @enderror"  id="input-tags" value="" />
                        </div>
                    </div>
                </div>
            </div> <!-- / .card -->
            
           <div class="card mb-4">
                <div class="card-header">
                    {{ __('Project Preview Links') }}
                </div>
               <div class="form mt-4">
                    <div class="form-group row">
                        <label for="sourcePreviewLink" class="col-md-2 col-form-label text-md-right">{{ __('Source Code') }}</label>
                        <div class="col-md-6">
                            <input id="sourcePreviewLink" type="text" class="form-control @error('sourcePreviewLink') is-invalid @enderror" name="sourcePreviewLink" value="" />
                            @error('sourcePreviewLink')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <label for="showSourcePreviewLink" class="col-md-2 col-form-label text-md-right">{{ __('Show/Hide') }}</label>
                        <div class="col-md-2 col-form-label">
                            <input type="checkbox" value="1" name="showSourcePreviewLink" />
                        </div>
                    </div>
               </div>
               <div class="form">
                    <div class="form-group row">
                        <label for="livePreviewLink" class="col-md-2 col-form-label text-md-right">{{ __('Live') }}</label>
                        <div class="col-md-6">
                            <input id="livePreviewLink" type="text" class="form-control @error('livePreviewLink') is-invalid @enderror" name="livePreviewLink" value="" />
                            @error('livePreviewLink')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <label for="showLivePreviewLink" class="col-md-2 col-form-label text-md-right">{{ __('Show/Hide') }}</label>
                        <div class="col-md-2 col-form-label"><input type="checkbox" value="1" name="showLivePreviewLink" /></div>
                    </div>
               </div>
                
            </div><!-- / .card -->  
            
            <div class="card mb-4 my-4">
                <div class="card-header">
                    {{ __('Project Images') }}
                </div>
                <div class="form-group py-4 text-center">
                    <div class="col-md-12">
                        <div class='col-md-12 font-weight-bold'>Add New Images</div>
                        <div class='col-md-12'>
                            <input type="file" id="uploadFile"  name="uploadFile[]" multiple/>
                        </div>
                        <hr/>
                        <div class="imageList" id="image_preview"></div>                        
                    </div>
                </div>
               
                
            </div><!-- / .card -->  
            
            <div class="card ">
                <div class="card-header">
                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </div>                
            </div> <!-- / .card -->
            
        </div> <!-- / .col-md-8 -->       

        

    </div> <!-- / .row -->
</form>

</div>
@endsection

