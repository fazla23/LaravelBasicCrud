@extends('layouts.app')

@section('title')
    Customer List
@endsection

@section('content')
        
    
    <h1>Customers</h1>

    @can('create',App\Customer::class)
    <a href="customers/create">Create Customer</a>
    @endcan
    
    @foreach ($customers as $customer)
    <div class="row">
         
        <div class="col-2">{{$customer->id}}</div>
        <div class="col-4">
                @can('view',$customer)
                <a href="/customers/{{$customer->id}}"> {{$customer->name}} </a>
                @endcan
    
                @cannot('view', $customer)
                {{$customer->name}}
                @endcannot
        </div>
        <div class="col-4">{{$customer->company->name}}</div>
        <div class="col-2">{{$customer->active}}</div>
        
    </div>
    @endforeach
    <div class="pt-5">
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{$customers->links()}}
        </div>
    </div>
    </div>

    {{-- <div class="row">
        <div class="col-12">
            <hr>
            <h2>List of companies:</h2>
            @foreach ($companies as $company)
            <h3>{{$company->name}}</h3>
                 <ul>
                     @foreach ($company->customers as $customer)
                    <li>{{$customer->name}}</li>
                     @endforeach
                </ul>
                  
            @endforeach
        </div>
    </div> --}}
    

@endsection