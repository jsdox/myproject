<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       return "Laravel";
    }

    public function save(Request $request)
    {
        $input = $request->all();
        $object = new User($input);
        if ($object->save($input)) {
            return 'data_saved';
        }
        return $object->getErrors();
//         if ($object->save($input)) {
//                return 'data_savede';
//            }
//        if ($object->validate($input)){
//            if ($object->save()) {
//                return 'data_savede';
//            }
//        } else {
//          return $object->errors();
//        }
    }

    public function login()
    {
        return redirect()->route('dashboard');
    }
    
    public function dashboard()
    {
        return 'dashobard';
    }
}

