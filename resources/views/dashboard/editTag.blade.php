@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{route('AdminUpdateTag', ['id'=>$tag->id])}}" method="post" class="w-100">
    @csrf
    <div class="row ">
        
        <div class="col-md-3">
            @include('dashboard.sidebar')     
        </div><!-- / .col-md-4 -->
        
        <div class="col-md-9">
            <div class="card mb-4">
                <div class="card-header">{{ __('Add Tag') }}</div>
                <div class="form py-4">
                    <div class="form-group row">
                        <label for="title" class="col-md-3 col-form-label text-md-right">{{ __('Title') }}</label>
                        <div class="col-md-8">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$tag->title}}" required />
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="slug" class="col-md-3 col-form-label text-md-right">{{ __('Slug') }}</label>
                        <div class="col-md-8">
                            <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{$tag->slug}}" />
                            @error('slug')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="order" class="col-md-3 col-form-label text-md-right">{{ __('Order') }}</label>
                        <div class="col-md-8">
                            <input id="order" type="number" min="0" step="1" class="form-control @error('order') is-invalid @enderror" name="order" value="{{$tag->order}}" />
                            @error('order')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>                    
                    
                    <div class="row">
                        <label for="order" class="col-md-3"></label>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary">{{ __('Update Tag') }}</button>
                        </div>
                    </div>
                    
                    
                </div>
            </div> <!-- / .card -->
                        
        </div> <!-- / .col-md-8 -->       

        

    </div> <!-- / .row -->
</form>

</div>
@endsection

