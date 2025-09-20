<?php
namespace App\Http\Controllers\ForgotPassword;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Helper\SendMail;
 
class ForgotPasswordController extends Controller
{
    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
       
        return view('email.forgot-password');
    }
 
    public function sendResetLinkEmail(Request $request)
    {
        $rand_id = rand(100000, 999999);
        
        $emailAddress = $request->email;

        $userEmail = User::where('email', $emailAddress)->get();
        $cc = "";

        
        if(isset($userEmail[0])){
            
            DB::table('users')  
                ->where(['email'=>$emailAddress])
                ->update(['is_forgot_password'=>1,'is_flag'=>$rand_id]);
 
            Mail::to($emailAddress)->send(new ContactMail($rand_id));
			//SendMail::sendMail(new ContactMail($rand_id), 'Forget Password', $emailAddress, 'noreply@mybluethink.in', $cc);
            return response()->json(['status'=>'success','msg'=>'Please check your email to update your password. You will receive a reset link.']);
        }else{
            return response()->json(['status'=>'error','msg'=>'The email address is not registered.']);
        }
    }
    public function reset(Request $request,$id)
    {
        $result=DB::table('users')  
            ->where(['is_flag'=>$id])
            ->where(['is_forgot_password'=>1])
            ->get();
            if(isset($result[0])){
                $request->session()->put('FORGOT_PASSWORD_USER_ID',$result[0]->user_id);
             
             return view('email.reset');
               
            }else{
                return redirect()->route('login')->with('success', 'Your password has been updated using the provided link');
               
            }
    }
    public function forgot_password_change_process(Request $request)
    {
        DB::table('users')  
        ->where(['user_id'=>$request->session()->get('FORGOT_PASSWORD_USER_ID')])
        ->update(
            [
                'is_forgot_password'=>0,
                'password'=>Hash::make($request->new_password),
                'is_flag'=>''
            ]
        );
        return redirect()->route('login')->with('success', 'Password successfully changed.');
    }
 
}
