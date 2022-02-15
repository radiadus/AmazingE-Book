<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AccountController extends Controller
{
    public function showProfile(){
        $id = Auth::user()->account_id;

        $show = DB::table('accounts')
                ->join('roles', 'accounts.role_id', 'roles.role_id')
                ->select('accounts.*', 'roles.role_desc')
                ->where('account_id', $id)
                ->first();

        return view('profile', compact('show'));
    }

    function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/logoutsuccess');
    }

    public function updateProfile(Request $request){

        if($request->email == Auth()->user()->email){
            $validator = Validator::make($request->all(),[
                'first_name' => ['required', 'string', 'max:25', 'alpha_dash'],
                'middle_name' => ['nullable', 'alpha_dash', 'max:25'],
                'last_name' => ['required', 'string', 'max:25', 'alpha_dash'],
                'gender_id' => ['required'],
                'password' => ['required', 'string', Password::min(8)->numbers()],
                'display_picture_link' => ['image', 'mimes:jpeg,jpg,png']]);
        }
        else{
            $validator = Validator::make($request->all(),[
                'first_name' => ['required', 'string', 'max:25', 'alpha_dash'],
                'middle_name' => ['nullable', 'alpha_dash', 'max:25'],
                'last_name' => ['required', 'string', 'max:25', 'alpha_dash'],
                'gender_id' => ['required'],
                'email' => ['required', 'string', 'email', 'unique:accounts'],
                'password' => ['required', 'string', Password::min(8)->numbers()],
                'display_picture_link' => ['image', 'mimes:jpeg,jpg,png']]);
        }


        if($validator->fails()){
            return back()->withErrors($validator);
        }

        if($request->display_picture_link==null){
            DB::table('accounts')->where('accounts.account_id', Auth()->user()->account_id)
                                ->update(['first_name' => $request->first_name,
                                'middle_name' => $request->middle_name,
                                'last_name' => $request->last_name,
                                'gender_id'=>$request->gender_id,
                                'email'=>$request->email,
                                'password'=>Hash::make($request->password)]);
        }else{
            $extension = request()->file('display_picture_link')->getClientOriginalExtension();
            $newfilename = time() . '.' . $extension;
            $path = request()->file('display_picture_link')->storeAs('public/images', $newfilename);

            DB::table('accounts')->where('accounts.account_id', Auth()->user()->account_id)
                                ->update(['first_name' => $request->first_name,
                                'middle_name' => $request->middle_name,
                                'last_name' => $request->last_name,
                                'gender_id'=>$request->gender_id,
                                'email'=>$request->email,
                                'password'=>Hash::make($request->password),
                                'display_picture_link'=>$newfilename]);
        }


        return redirect('/saved');

    }

    public function showProfileMaintenance(){

        $show = DB::table('accounts')
                ->join('roles', 'accounts.role_id', 'roles.role_id')
                ->select('accounts.*', 'roles.role_desc')
                ->where('delete_flag', null)
                ->get();

        return view('maintenance', compact('show'));
    }

    public function deleteAccount($id){
        Account::where('account_id', $id)
        ->update([
            'delete_flag'=>1,
            'modified_at'=>Carbon::now(),
            'modified_by'=>Auth()->user()->account_id,
        ]);

        return redirect('/maintenance');
    }

    public function updateRole($id){
        $account = Account::where('account_id', $id)->first();

        return view('updaterole', compact('account'));
    }

    public function savingRole(Request $request, $id){
        Account::where('account_id', $id)
        ->update([
            'role_id'=>$request->role_id,
            'modified_at'=>Carbon::now(),
            'modified_by'=>Auth()->user()->account_id,
        ]);

        return redirect('/home');
    }

}
