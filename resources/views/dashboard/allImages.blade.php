@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('dashboard.sidebar')
        
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Images</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
