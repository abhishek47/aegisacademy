<?php

namespace App\Http\Controllers;

 use Softon\Indipay\Facades\Indipay;  
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function acheivements()
    {
        return view('profile.acheivements');
    }

    public function security()
    {
        return view('profile.security');
    }

    public function downgrade()
    {
        auth()->user()->is_premium = 0;
        auth()->user()->save();

        return back();
    }

    public function upgrade()
    {
        $uid = uniqid();
         $parameters = [
            'tid' => '1001' . $uid,
            'order_id' => $uid,
            'purpose' => 'Premium Subscription',
            'amount' => 10.0,
            'buyer_name' => \Auth::user()->name,
            'email' => \Auth::user()->email,
            'phone' => '9560755823',
          ];


          $purchaseOrder = Indipay::prepare($parameters);

          return Indipay::process($purchaseOrder); 

           // auth()->user()->is_premium = 1;
           // auth()->user()->save();

           // return back();
    }

    public function upgradeSuccess(Request $request)
    {
       $response = Indipay::response($request);
       if(isset($response->status) && $response->status == 'Credit')
        {
            auth()->user()->is_premium = 1;
            auth()->user()->save();
          return redirect('/profile');
        } 
        if ($request->payment_status != 'Failed'){
            auth()->user()->is_premium = 1;
            auth()->user()->save();
          return redirect('/profile');
          
        } else {
          return redirect('/profile');
        }

    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, ['name' => 'required', 'email' => 'required']);

        auth()->user()->update($request->all());

        // flash('Your Profile was updated successfully')->success();


        return back();

    }

    public function updatePassword(Request $request)
    {
          $this->validate($request, [
              'old_password' => 'required',
              'password' => 'required|string|min:6|confirmed'
            ]);

          $old_password = $request->get('old_password');
          $password = $request->get('password');

          if(!\Hash::check($old_password, auth()->user()->password))
          {
            // flash('Please enter your current password correct!')->success();

              return back();
          }

          auth()->user()->password = bcrypt($password);
          auth()->user()->save();

           // flash('Your password was successfully updated!')->success();

          return back();
    }
}
