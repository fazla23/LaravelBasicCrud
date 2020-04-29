<?php

namespace App\Http\Controllers;

use App\Company;
use App\Customer;
use App\Mail\WecomeUserMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use App\Events\NewCustomerHasRegisteredEvent;

class CustomerController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
        //$this->middleware('auth')->except(['index']);  //this locks up everything except the index page
    }

    public function index(){
        
        //$customers = Customer::all();
        //$customers = Customer::with('company')->get(); //the live above does lazy loading so we replaced that with this line
        $customers = Customer::with('company')->paginate(15);//Above line using pagination

        $activeCustomers = Customer::active()->get();
        $inactiveCustomers = Customer::inactive()->get();
        $companies = Company::all();

        // $activeCustomers = Customer::where('active',1)->get();  //without using scope
        // $inactiveCustomers = Customer::where('active',0)->get();
        
        return view('customers.index',compact('customers','activeCustomers','inactiveCustomers','companies'));
    
    //  return view('internals.customers',[
    //      'activeCustomers' => $activeCustomers,    //passing the data through array is done by compact() function shown above
    //      'inactiveCustomers'=>$inactiveCustomers
    //      ]);

    //     $customers = Customer::all(); //for returning all data from customer table
    //  return view('internals.customers',['customers' => $customers]);
    }


    public function create(){
        $companies = Company::all();
        $customer = new Customer();
        return view('customers.create',compact('companies','customer'));
    }
    
    public function store(){

        $this->authorize('create',Customer::class);
        
        // $data = request()->validate([   //this whole validate is done by the private method validate request which is called in line-49
        //     'name'=>'required|min:3',
        //     'email'=>'required|email',
        //     'active'=>'required',
        //     //'random'=>'' ---> If I keep a field empty then like random the field it will be added to the data array 
        //     'company_id'=>'required', 
        // ]);

        $customer = Customer::create($this->validateRequest());  //this is called mass assignment and for this we have add fillable or guarded in the Customer model
        
        $this->storeImage($customer);

        event(new NewCustomerHasRegisteredEvent($customer));
        
        // the part below is replaced by the line above called mass assignment
        // $customer = new Customer();
        // $customer->name = request('name');
        // $customer->email = request('email');
        // $customer->active = request('active');
        // $customer->save();

        return redirect('customers');
    }

    public function show(Customer $customer){  //Route model binding --->Instead of writing the code below simply write Customer before $customer which will do all the stuff for us down below.
        // $customer = Customer::where('id',$customer)->firstOrFail(); // Instead of where('id',$customer)->firstOrFail we can use find($customer)
         //But it will give us an error if the id is not found in the database      
        
         return view('customers.show',compact('customer'));
    }

    public function edit(Customer $customer){
        $companies = Company::all();
        return view('customers.edit',compact('customer','companies'));
    }

    public function update(Customer $customer){
    
        $customer->update($this->validateRequest());
        $this->storeImage($customer);
        return redirect('customers/'.$customer->id);
    }

     public function destroy(Customer $customer){

        $this->authorize('delete', $customer); //$customer means the customer model...this line authorizes the authorized user

        $customer->delete();
        return redirect('customers');
        
    }

    private function validateRequest(){
        
        
        return request()->validate([ 
            'name'=>'required|min:3',
            'email'=>'required|email',
            'active'=>'required',
            'company_id'=>'required',
            'image'=>'sometimes|file|image|max:5000', //sometimes is used for the field which is optional
        ]);

    }

    public function storeImage($customer){
        if(request()->has('image')){
            $customer->update([
                'image'=>request()->image->store('uploads','public'),
            ]);

            $image = Image::make(public_path('storage/'.$customer->image))->fit(300,300);
            $image->save();  //save() funvtion will fit or crop the image and will overwrite the original one .
        }
    }

    
}
