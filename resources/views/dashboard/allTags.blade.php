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
                    Tags
                    <a class="float-right" href="{{route('AdminCreateTag')}}">
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
                                <th width="">Title</th>
                                <th>Slug</th>                    
                                <th width="130">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tags as $tag)
                            <tr>
                                <td>{{$tag['id']}}</td>
                                <td>{{$tag['title']}}</td>
                                <td>{{$tag['slug']}}</td>                                                  
                                <td>
                                    <a href="{{route('AdminEditTag',['id' => $tag->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i>Edit</a>
                                    <a href="{{route('AdminDeleteTag',['id' => $tag->id])}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>Delete</a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{$tags->links()}}
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
