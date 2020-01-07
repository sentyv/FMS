<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

//use Spatie\Permission\Models\Role; 
//use Spatie\Permission\Models\Permission;


/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        //Role::create(['name'=>'pms']);
        //Permission::create(['name'=>'pms.view']);
         //Permission::create(['name'=>'pms.edit']);
        //auth()->user()->givePermissionTo('pms.view');
        //auth()->user()->givePermissionTo('pms.edit');
        //auth()->user()->assignRole('pms');
        //$role-givePermissionTo('pms.view');
        
        


        return view('frontend.index');
    }
}
