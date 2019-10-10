@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('dashboard.sidebar')
        </div>
        
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    Images
                    <a class="float-right" href="{{route('AdminCreateImage')}}">
                        <i class="fa fa-plus-circle"></i> Add New
                    </a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th width="">Image</th>
                                <th>Title</th>
                                <th width="150">Order</th>  
                                <th width="150">Action</th>  
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($images as $image)
                            <tr>
                                <td>{{$image['id']}}</td>
                                <td>
                                @if($image['image'])
                                    <img src="{{asset ('storage')}}/{{$image['image']}}" alt="" style="max-height:37px" >
                                @endif
                                </td>
                                <td>{{$image['title']}}</td> 
                                <td>{{$image['order']}}</td>                    
                                <td>
                                    <a href="{{route('AdminEditImage',['id' => $image->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i>Edit</a>
                                    <a href="{{route('AdminDeleteImage',['id' => $image->id])}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Delete</a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$images->links()}}
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
