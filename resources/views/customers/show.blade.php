@extends('layouts.app')

@section('title','Details for '.$customer->name)
    

@section('content')
        
    <h1>Details for {{$customer->name}}</h1>
    <a href="/customers/{{$customer->id}}/edit">Edit</a>
    <form action="/customers/{{$customer->id}}" method="POST">
    
        @method('delete')
        @csrf
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    
    <div class="row">
        <div class="col-12">
        <p><strong>Name:</strong>{{$customer->name}}</p>
        <p><strong>Email:</strong>{{$customer->email}}</p>
        <p><strong>Status:</strong>{{$customer->active}}</p>
        <p><strong>Company:</strong>{{$customer->company->name}}</p>
        </div>
    </div> 
   @if($customer->image)
       <div class="row">
            <div class="col-12">
                <img src="{{asset('storage/'.$customer->image)}}" alt="profile-pic" class="img-thumbnail">
            </div>
       </div>
   @endif

@endsection