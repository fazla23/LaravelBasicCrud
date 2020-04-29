@extends('layouts.app')

@section('title')
    Add customer
@endsection

@section('content')
        
    <h1>Add New Customers</h1>
    
    <div class="row">
        <div class="col-12">
            <form action="{{route('customers.store')}}" method="POST" enctype="multipart/form-data">
                @include('customers.form')
                
                <button type="submit" class="btn btn-primary">Add Customer</button>
            </form>
        </div>
    </div> 
   

@endsection