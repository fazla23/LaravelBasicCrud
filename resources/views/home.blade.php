@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <div class="new-class">
                       <my-button text="My new button" type="submit"></my-button>
                   </div>
                   <div>
                        <example-components> </example-components>
                        
                        <div class="row">
                            @foreach ($images as $image)
                            <div class="col-2 mb-4">
                                <a href="{{$image->thumbnail }}"><img src="{{$image->thumbnail }}" class="w-100"></a>
                            </div>
                                
                            @endforeach
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
