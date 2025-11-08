<?php
   
namespace App\Http\Controllers\Auth;
   
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User_login_history;
use App\Models\Allowip;
use Illuminate\Http\Request;
   
class LoginController extends Controller
{

    
  
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
   
    use AuthenticatesUsers;
   
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
  
    public function login(Request $request){   
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
         //$restrictedIp = Allowip::pluck('allowips')->toArray();
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'], 'active' => 1))){
            $user_login_history = new User_login_history();
            $user_login_history->user_id = auth()->user()->id;
            $user_login_history->ip = request()->ip();
            $user_login_history->online_staus = 1;
            $user_login_history->login_date = date('d-m-y');
            $user_login_history->login_time = date('h:i:s');
            $user_login_history->save();
            if (auth()->user()->type == 'super_admin') {
                return redirect()->route('super-admin-dashboard');
            }else if (auth()->user()->type == 'admin') {
                return redirect()->route('admin-dashboard');
            }else if (auth()->user()->type == 'hr') {
                return redirect()->route('hr-dashboard');
            }else if (auth()->user()->type == 'employee'){
                    return redirect()->route('employee-dashboard');  
            }else if(auth()->user()->type == 'ca'){
                 return redirect()->route('ca-dashboard');  
              
            }
        }else{
            return redirect()->route('login')->with('error','Email-Address And Password Are Wrong.');
        }
         
    }
   

    
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/login';
    }


    function logout(Request $request){
        //$update_arr = array('logout_time' =>    date('h:i:s'), 'online_staus' => 0);
        //$affectedRows = User_login_history::where("user_id", auth()->user()->id)->where('logout_time',NULL)->where('login_date',date('d-m-y'))->update($update_arr);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}