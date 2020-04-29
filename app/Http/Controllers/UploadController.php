<?php

namespace App\Http\Controllers;

use App\ImageUpload;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Intervention\Image\Facades\Image;

class UploadController extends Controller
{

    public function index(){
        $images = ImageUpload::latest()->get();
        return view('home',compact('images')); 
    }

    public function store()
    {

        if(!is_dir(public_path('/images'))){ //is_dir() checks if there is a directory naming that
            mkdir(public_path('/images'),0777);
        }

        $images = Collection::wrap(request()->file('file'));
        $images->each(function($image){
            $basename= Str::random();

            $original = $basename.'.'.$image->getClientOriginalExtension();//getClientOriginalExtention() function gives us the extension of the file
            $thumbnail = $basename.'_thumb.'.$image->getClientOriginalExtension();//getClientOriginalExtention() function gives us the extension of the file

            Image::make($image)->fit(250,250)->save(public_path('/images/'.$thumbnail));

            $image->move(public_path('/images'),$original);

            ImageUpload::create([
                'original'=>'/images/'.$original,
                'thumbnail'=>'/images/'.$thumbnail,
            ]);
        });
    }
}
