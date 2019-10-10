@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{route('AdminInsertImage')}}" method="post" enctype="multipart/form-data"  class="w-100">
    @csrf
    <div class="row ">
        
        <div class="col-md-3">
            @include('dashboard.sidebar')     
        </div><!-- / .col-md-4 -->
        
        <div class="col-md-9">
            <div class="card mb-4">
                <div class="card-header">{{ __('Add Image') }}</div>
                <div class="form py-4">
                    <div class="form-group row">
                        <label for="title" class="col-md-3 col-form-label text-md-right">{{ __('Title') }}</label>
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
                        <label for="alt" class="col-md-3 col-form-label text-md-right">{{ __('Alt') }}</label>
                        <div class="col-md-8">
                            <input id="alt" type="text" class="form-control @error('alt') is-invalid @enderror" name="alt" value="" required />
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="caption" class="col-md-3 col-form-label text-md-right">{{ __('Caption') }}</label>
                        <div class="col-md-8">
                            <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="" required />
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-md-3 col-form-label text-md-right">{{ __('Description') }}</label>
                        <div class="col-md-8">
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" ></textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="order" class="col-md-3 col-form-label text-md-right">{{ __('Order') }}</label>
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
                        <label for="order" class="col-md-3 col-form-label text-md-right">{{ __('Assign To Project') }}</label>
                        <div class="col-md-8">
                            <select class="form-control @error('post_id') is-invalid @enderror" name="post_id">
                                <option value="null">--- Select Project ----</option>
                                @foreach($posts as $post)
                                    <option value="{{$post->id}}">{{$post->title}}</option>
                                @endforeach
                            </select>
                             @error('post_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="tag" class="col-md-3 col-form-label text-md-right">{{ __('Image') }}</label>
                        <div class="col-md-8">
                            <input type="file" id="uploadFile"  name="uploadFile" />
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-10 text-right">
                            <button type="submit" class="btn btn-primary">{{ __('Insert Image') }}</button>
                        </div>
                    </div>
                    
                    
                </div>
            </div> <!-- / .card -->
                        
        </div> <!-- / .col-md-8 -->       

        

    </div> <!-- / .row -->
</form>

</div>
@endsection

