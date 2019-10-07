@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-3">
            @include('dashboard.sidebar')     
        </div><!-- / .col-md-4 -->
        
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    Projects
                    <a class="float-right" href="{{route('AdminCreatePost')}}">
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
                                <th width="150">Tags</th>                        
                                <th width="130">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td>{{$post['id']}}</td>
                                <td>
                                @if($post['image'])
                                    <img src="{{asset ('storage')}}/" alt="" style="max-height:37px" >
                                @endif
                                </td>
                                <td>{{$post['title']}}</td>
                                <td>
                                @foreach($post->tags as $tag)
                                    <a href='#'>{{$tag->title}}</a>
                                @endforeach
                                </td>                     
                                <td>
                                    <a href="{{route('AdminEditPost',['id' => $post->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i>Edit</a>
                                    <a href="{{route('AdminDeletePost',['id' => $post->id])}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Delete</a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$posts->links()}}
                    </div>
                    
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
