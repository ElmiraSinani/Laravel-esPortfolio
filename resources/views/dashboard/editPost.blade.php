@extends('layouts.app')

@section('content')
<div class="container">
    <form id="formWithUploadImages" action="{{route('AdminUpdatePost', ['id'=>$post->id])}}" method="post" enctype="multipart/form-data"  class="w-100">
        @csrf
        <div class="row ">

            <div class="col-md-3">
                @include('dashboard.sidebar')     
            </div><!-- / .col-md-4 -->

            <div class="col-md-9">
                <div class="card mb-4">
                    <div class="card-header">{{ __('Edit Project') }}</div>
                    <div class="form py-4">
                        <div class="form-group row">
                            <label for="title" class="col-md-2 col-form-label text-md-right">{{ __('Title') }}</label>
                            <div class="col-md-8">
                                <input id="title" name="title" value="{{$post->title}}" type="text" class="form-control @error('title') is-invalid @enderror" required />
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
                                <input id="slug"  name="slug"  value="{{$post->slug}}" type="text" class="form-control @error('slug') is-invalid @enderror" required />
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
                                <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content" >{{$post->content}}</textarea>
                                @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tag" class="col-md-2 col-form-label text-md-right">{{ __('Tags') }}</label>
                            <div class="col-md-8">
                                <input name="tags" type="text" class="input-tags  @error('tag') is-invalid @enderror"  id="input-tags" value="{{$selectedTagIds}}" />
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
                                <input id="sourcePreviewLink" type="text" class="form-control @error('sourcePreviewLink') is-invalid @enderror" name="sourcePreviewLink" value="{{$post->sourcePreviewLink}}" />
                                @error('sourcePreviewLink')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="showSourcePreviewLink" class="col-md-2 col-form-label text-md-right">{{ __('Show/Hide') }}</label>
                            <div class="col-md-2 col-form-label">
                                <input type="checkbox" value="1" name="showSourcePreviewLink" {{ old('showSourcePreviewLink', $post->showSourcePreviewLink) === '1' ? 'checked' : '' }} />
                            </div>
                        </div>
                    </div>
                    <div class="form">
                        <div class="form-group row">
                            <label for="livePreviewLink" class="col-md-2 col-form-label text-md-right">{{ __('Live') }}</label>
                            <div class="col-md-6">
                                <input id="livePreviewLink" type="text" class="form-control @error('livePreviewLink') is-invalid @enderror" name="livePreviewLink" value="{{$post->livePreviewLink}}" />
                                @error('livePreviewLink')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="showLivePreviewLink" class="col-md-2 col-form-label text-md-right">{{ __('Show/Hide') }}</label>
                            <div class="col-md-2 col-form-label">
                                <input type="checkbox" value="1" name="showLivePreviewLink" {{ old('showLivePreviewLink', $post->showLivePreviewLink) === '1' ? 'checked' : '' }} />
                            </div>
                        </div>
                    </div>

                </div><!-- / .card -->  

                <div class="card mb-4">
                    <div class="card-header">
                        {{ __('Project Images') }}
                    </div>
                    <div class="form-group py-4">
                        <div class="col-md-12">
                            <div class='row form-group text-center'>
                                <div class='col-md-12 font-weight-bold'>Add New Images</div>
                                <div class='col-md-12'>
                                    <input type="file" id="uploadFile"  name="uploadFile[]" multiple/>
                                </div>
                            </div>
                            <div class="imageList" id="image_preview"></div>

                            <hr/>
                            <h3>Attached Images</h3>
                            <div class="imageList">
                                <div class="images">
                                    @foreach($post->images as $image)
                                    <div class='row form-group'>
                                        <div class='col-md-2'><img src='{{asset ('storage')}}/{{$image->image}}'></div>
                                        <input type='hidden' name='projectImages["+i+"][name]' value='"+imageName+"' />
                                        <div class='inputBlock col-md-8'>
                                            <div class='form-group row'>
                                                <div class='col-md-6'><input name='projectImages[{{$image->id}}][title]' class='title form-control' type='text' placeholder='Title'/></div>
                                                <div class='col-md-6'><input name='projectImages[{{$image->id}}][alt]' class='alt form-control' type='text' placeholder='Alt' /></div>
                                            </div>
                                            <div class='form-group row'>
                                                <div class='col-md-9'><input name='projectImages[{{$image->id}}][caption]' class='caption form-control' type='text' placeholder='Caption' /></div>
                                                <div class='col-md-3'><input name='projectImages["+i+"][order]' class='order form-control' type='number' min='1' step='1' placeholder='Order' value='"+(i+1)+"' /></div>
                                            </div>
                                            <div class='form-group row'>
                                                <div class='col-md-12'><textarea name='projectImages[{{$image->id}}][description]' class='form-control' placeholder='Description'></textarea></div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                            <a href="#" class="btn btn-danger btn-sm">Unlink</a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                </div><!-- / .card -->  

                <div class="card ">
                    <div class="card-header">
                        <button type="submit" class="btn btn-primary">{{ __('Update Project') }}</button>
                        <a href="#" class="btn btn-danger float-right">{{ __('Delete') }}</a>
                        <a href="#" class="btn btn-secondary float-right mr-3">{{ __('Archive') }}</a>
                    </div> <!-- / .card -->

                </div> <!-- / .col-md-8 --> 
            </div> <!-- / .row -->
    </form>

</div>
@endsection
