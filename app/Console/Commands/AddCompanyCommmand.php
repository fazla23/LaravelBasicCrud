<?php

namespace App\Console\Commands;

use App\Company;
use Illuminate\Console\Command;

class AddCompanyCommmand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'contact:company{name} {phone=N/A}'; //We're setting a default value for phone number if it's not given
    protected $signature = 'contact:company'; 
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new company';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->ask('What is the comapny name?');
        $phone = $this->ask('What is the comapny\'s phone number?');

        if($this->confirm('Are you ready to insert "'.$name.'"?'))
        {
            $company=Company::create([
            'name'=>$name,
            'phone'=>$phone,
            ]);
            return $this->info('Added: '.$company->name);
        }
        $this->info('No new company was added');

    }
}
