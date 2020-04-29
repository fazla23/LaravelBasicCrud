@extends('layouts.app')

@section('title','Contact Us')
    

@section('content')

<h1>Contact Us</h1>

    @if( !session()->has('message'))
        <form action="{{route('contact.store')}}" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" value="{{old('name') }}" class="form-control">
            </div>
            <div>
                {{ $errors->first('name') }}
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" name="email" value="{{old('email')}}"  class="form-control">
            </div>
            <div>
                {{ $errors->first('email') }}
            </div>

            <div class="form-group">
                <label for="message">Message:</label>
            <textarea name="message" id="message" cols="30" rows="10" class="form-control">{{old('message')}}</textarea>
            </div>
            <div>
                {{ $errors->first('message') }}
            </div>
            <button type="submit" class="btn btn-success">Send Message</button>
            @csrf
    </form>
    @endif
    
@endsection