<?php
   
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Holidays;
use App\Models\Employees;
use App\Models\User;
use App\Models\Department;
use App\Models\Attendance;
use App\Models\Candidates;
use App\Models\Events;
use App\Models\Recruitments;
use DB;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $data['no_of_employees'] = User::whereIn('type', [2,3])->count();
        $data['no_of_holidays'] = Holidays::count();
        $data['no_of_department'] = Department::count();
        return view('super_admin.dashboard', compact('data'));
    } 
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function admin_dashboard()
    {
        return view('admin.dashboard');
    }
    
    public function ca_dashboard()
    {
        return view('ca.dashboard');
    }
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function hr_dashboard(){
        $data['no_of_department'] = Department::count();
        $data['no_of_attendance'] = Attendance::where('login_date','=', date('Y-m-d'))->count();
        $data['no_of_assets'] =  DB::table('assets')->count();
        $attendance = Attendance::query()->where('login_date', '=', date('Y-m-d'))->paginate(25);
        $recruitments = Recruitments::query()->paginate(25);
        $candidates = Candidates::query()->paginate(25);
        $data['leaves_applied'] = DB::table('apply_leave')->where('leave_status', '!=', ['NULL'])->count();
        $data['no_of_employees'] = User::whereIn('type', [3])->count();
        // $upcoming_birthdays = Employees::select('*')->whereMonth( 'date_of_birth', Carbon::now()->month)->get();
        $upcoming_birthdays = Employees::where('date_of_birth', '>=', date('Y-m-d'))->limit(50)->get();
        $today_events = Events::where('event_date','>=', date('Y-m-d'))->whereBetween('event_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $working_anniversary = Employees::whereYear('date_of_joining','>=', Carbon::now()->addYear())->whereMonth('date_of_joining', Carbon::now()->month)->get();
        $data['no_of_employees_male'] = Employees::where('gender', '=', 'Male')->count();
        $data['no_of_employees_female'] = Employees::where('gender','=','Female')->count();
         $data['openings'] = DB::table('recruitment')->where('recruitment_status','open')->count();
        $holidays = Holidays::where('holiday_date', '>=', date('Y-m-d'))->limit(5)->get();
        $notice_boards = DB::table('notice_boards')->select('notice_heading','notice_details','created_at')->where('created_at','>=',date('Y-m-d')) ->get();
        return view('hr.dashboard', compact('data','notice_boards','attendance','recruitments','candidates','upcoming_birthdays','working_anniversary','holidays','today_events'));
    }

    public function employeer_dashboard(){
        $holidays = Holidays::where('holiday_date', '>=', date('Y-m-d'))->limit(5)->get();
        $available = DB::table('leave_balance')->where('emp_id',auth()->user()->emp_id)->sum('leave_balance');
        $used_leave = DB::table('apply_leave')->where('emp_id',auth()->user()->emp_id)->sum('leave_balance');
        $emp_date_of_birth = DB::table('employees_primary_details')->select('display_name','date_of_birth','profile_pic')->where('date_of_birth', '>=', date('Y-m-d'))->limit(5)->get();
        return view('employee.dashboard', compact('holidays','emp_date_of_birth','available','used_leave'));
    }
}