@extends('layouts.app')

@section('title')
    Edit customer details for {{$customer->name}}
@endsection

@section('content')
        
    <h1>Edit customer details for {{$customer->name}}</h1>
    
    <div class="row">
        <div class="col-12">
            <form action="{{route('customers.update',['customer'=>$customer])}} " method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @include('customers.form')
                
                <button type="submit" class="btn btn-primary">Save Customer</button>
            </form>
        </div>
    </div> 
   

@endsection