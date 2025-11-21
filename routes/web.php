<?php
  
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\super_admin\SettingController;
use App\Http\Controllers\common\DepartmentController;
use App\Http\Controllers\common\RecruitmentsController;
use App\Http\Controllers\common\HolidayController;
use App\Http\Controllers\profile\ProfileController;
use App\Http\Controllers\common\DesignationController;
use App\Http\Controllers\common\EventsController;
use App\Http\Controllers\common\LeavesController;
use App\Http\Controllers\hr\EmployeesController;
use App\Http\Controllers\hr\AttendanceController;
use App\Http\Controllers\LeadsController;
use App\Http\Controllers\NoticeBoardController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PormotionController;
use App\Http\Controllers\AssetTypeController;
use App\Http\Controllers\AllowipController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\PDFController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/     

  
Route::get('/', function() { return redirect()->route('login');});

Route::get('/login', function () { return redirect('auth.login')->name('login');});

Route::get('forget-password', [ForgotPasswordController::class, 'ForgetPassword'])->name('ForgetPasswordGet');
Route::post('forget-password', [ForgotPasswordController::class, 'ForgetPasswordStore'])->name('ForgetPasswordPost');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'ResetPassword'])->name('ResetPasswordGet');
Route::post('reset-password', [ForgotPasswordController::class, 'ResetPasswordStore'])->name('ResetPasswordPost');

Auth::routes();
//Route::get('/logout', function (){ auth()->logout(); Session()->flush(); return Redirect::to('/');})->name('logout');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
/*------------------------------------------
--------------------------------------------
All  Super Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::group(['prefix' => 'super-admin', 'middleware' => ['auth', 'user-access:super_admin']], function(){
Route::get('/dashboard', [HomeController::class, 'index'])->name('super-admin-dashboard');
Route::get('/cache/clear', function() { Artisan::call('cache:clear'); Artisan::call('config:clear'); Artisan::call('route:clear'); Artisan::call('view:clear');
return redirect()->back();
})->name('super.admin.cache.clear');
 Route::match(['get','post'],'/organization-information', [SettingController::class, 'index'])->name('super-admin-settings');
 Route::match(['get','post'],'/department', [DepartmentController::class, 'index'])->name('super-admin-department');
 Route::match(['get','post'],'/profile', [ProfileController::class, 'index'])->name('profile');
 Route::match(['get','post'],'/change_password', [ProfileController::class, 'change_password'])->name('user-change_password');

 Route::get('/allow-ip-list', [AllowipController::class, 'index'])->name('allow-ip-list');
 Route::match(['get','post'],'/allow-ip-add', [AllowipController::class, 'create'])->name('allow-ip-add');
 Route::match(['get','post'],'/allow-ip-edit/{id?}', [AllowipController::class, 'edit'])->name('allow-ip-edit');
 Route::delete('/allow-ip-destroy/{id?}', [AllowipController::class, 'destroy'])->name('allow-ip-destroy');
});

/*------------------------------------------
--------------------------------------------
All  Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'user-access:admin']], function(){
    Route::get('/dashboard', [HomeController::class, 'admin_dashboard'])->name('admin-dashboard');
    Route::match(['get','post'],'/profile', [ProfileController::class, 'index'])->name('profile');
    Route::match(['get','post'],'/change_password', [ProfileController::class, 'change_password'])->name('user-change_password');
});
  
 Route::group(['prefix' => 'ca', 'middleware' => ['auth', 'user-access:ca']], function(){
    Route::get('/dashboard', [HomeController::class, 'ca_dashboard'])->name('ca-dashboard');
    Route::match(['get','post'],'/profile', [ProfileController::class, 'index'])->name('profile');
    Route::match(['get','post'],'/change_password', [ProfileController::class, 'change_password'])->name('user-change_password');
});
/*------------------------------------------
--------------------------------------------
All HR Routes List
--------------------------------------------
--------------------------------------------*/
Route::group(['prefix' => 'hr', 'middleware' => ['auth', 'user-access:hr']], function(){

    Route::get('/dashboard', [HomeController::class, 'hr_dashboard'])->name('hr-dashboard');
      /* ---- All Employees ---  */
     Route::get('/employees-list', [EmployeesController::class, 'index'])->name('employees-list');
      Route::get('/employees-add', [EmployeesController::class, 'create'])->name('employees-add');
      Route::post('/employees-store', [EmployeesController::class, 'store'])->name('employees-store');
      Route::match(['get','post'],'/employees-edit/{id?}', [EmployeesController::class, 'edit'])->name('employees-edit');
      Route::delete('/destroy/{id?}', [EmployeesController::class, 'destroy'])->name('destroy');
      Route::match(['get','post'],'/employees-viewprofile/{id?}', [EmployeesController::class, 'viewprofile'])->name('employees-viewprofile');
      
      /* ---- End Department ---  */
   /* ---- All Experience ---  */
      Route::get('/employees-experience', [EmployeesController::class, 'employees_experience_list'])->name('employees-experience');
      Route::match(['get','post'],'/employees-experience-add', [EmployeesController::class, 'employees_experience_create'])->name('employees-experience-add');
      Route::match(['get','post'],'/employees-experience-edit/{id?}', [EmployeesController::class, 'employees_experience_edit'])->name('employees-experience-edit');
      Route::delete('/employees_experience_destroy/{id?}', [EmployeesController::class, 'employees_experience_destroy'])->name('employees_experience_destroy');

      /* ---- End Experience ---  */

       /* ---- All Bank Details ---  */
        Route::get('/employees-bank-details-list', [EmployeesController::class, 'employees_bank_details'])->name('employees-bank-details-list');
        Route::match(['get','post'],'/employees-bank-details-add', [EmployeesController::class, 'employees_bank_details_create'])->name('employees-bank-details-add');
        Route::match(['get','post'],'/employees-bank-details-edit/{id?}', [EmployeesController::class, 'employees_bank_details_edit'])->name('employees-bank-details-edit');
        Route::delete('/employees-bank-details-destroy/{id?}', [EmployeesController::class, 'employees_bank_details_destroy'])->name('employees-bank-details-destroy');
        /* ---- End Bank Details ---  */
        
        
        

            /* ---- All Employee Relations Details ---  */
            Route::get('/employees-relations-details-list', [EmployeesController::class, 'employees_relations_details'])->name('employees-relations-details-list');
            Route::match(['get','post'],'/employees-relations-details-add', [EmployeesController::class, 'employees_relations_details_create'])->name('employees-relations-details-add');
            Route::match(['get','post'],'/employees-relations-details-edit/{id?}', [EmployeesController::class, 'employees_relations_details_edit'])->name('employees-relations-details-edit');
            Route::delete('/employees-relations-details-destroy/{id?}', [EmployeesController::class, 'employees_relations_details_destroy'])->name('employees-relations-details-destroy');
            /* ---- End Employee Relations Details ---  */
        
         /* ---- All Employee PF Details ---  */
        Route::get('/employees-pf-details-list', [EmployeesController::class, 'employees_pf_details'])->name('employees-pf-details-list');
        Route::match(['get','post'],'/employees-pf-details-add', [EmployeesController::class, 'employees_pf_details_create'])->name('employees-pf-details-add');
        Route::match(['get','post'],'/employees-pf-details-edit/{id?}', [EmployeesController::class, 'employees_pf_details_edit'])->name('employees-pf-details-edit');
        Route::delete('/employees-pf-details-destroy/{id?}', [EmployeesController::class, 'employees_pf_details_destroy'])->name('employees-pf-details-destroy');
        /* ---- End Employee Relations Details ---  */


      /* ---- All Experience ---  */
      Route::get('/employees-education', [EmployeesController::class, 'employees_education_list'])->name('employees-education');
      Route::match(['get','post'],'/employees-education-add', [EmployeesController::class, 'employees_education_create'])->name('employees-education-add');
      Route::match(['get','post'],'/employees-education-edit/{id?}', [EmployeesController::class, 'employees_education_edit'])->name('employees-education-edit');
      Route::delete('/employees_education_destroy/{id?}', [EmployeesController::class, 'employees_education_destroy'])->name('employees_education_destroy');
      /* ---- End Experience ---  */

      //   /* ---- All Employees Offer Letter ---  */
      //   Route::get('/employees-offer-letter', [EmployeesController::class, 'employees_offer_letter'])->name('employees-offer-letter');
      //   Route::match(['get','post'],'/employees-education-add', [EmployeesController::class, 'employees_education_create'])->name('employees-education-add');
      //   Route::match(['get','post'],'/employees-education-edit/{id?}', [EmployeesController::class, 'employees_education_edit'])->name('employees-education-edit');
      //   Route::delete('/employees_education_destroy/{id?}', [EmployeesController::class, 'employees_education_destroy'])->name('employees_education_destroy');
      //  /* ---- End Employees Offer Letter ---  */
       
      //   /* ---- All Employees Offer Letter ---  */
      //   Route::get('/employees-offere-letter', [EmployeesController::class, 'employees_offere_letter'])->name('employees-offere-letter');
      //   Route::match(['get','post'],'/employees-education-add', [EmployeesController::class, 'employees_education_create'])->name('employees-education-add');
      //   Route::match(['get','post'],'/employees-education-edit/{id?}', [EmployeesController::class, 'employees_education_edit'])->name('employees-education-edit');
      //   Route::delete('/employees_education_destroy/{id?}', [EmployeesController::class, 'employees_education_destroy'])->name('employees_education_destroy');
      //  /* ---- End Employees Offer Letter ---  */
        /* handled by PDFController later; removed duplicate EmployeesController route */
       /* ---- End Employees Offer Letter ---  */

      // Offer Letter Preview (PDF stream)
      Route::get('/employees-offer-letter-preview/{id}', [PDFController::class, 'offer_letter_preview'])->name('employees-offer-letter-preview');
       
    /* ---- All Department ---  */
    Route::get('/department', [DepartmentController::class, 'index'])->name('hr-department');
    Route::match(['get','post'],'/department-post', [DepartmentController::class, 'add'])->name('department-post');
    Route::match(['get','post'],'/department-edit/{id?}', [DepartmentController::class, 'edit'])->name('department-edit');
    Route::delete('/department/delete/{id}', [DepartmentController::class, 'destroy'])->name('hr-department-delete');
    /* ---- End Department ---  */
    /* ---- All Holiday ---  */
    Route::get('/holidays', [HolidayController::class, 'index'])->name('hr-holiday');
    Route::match(['get','post'],'/holidays-post', [HolidayController::class, 'add'])->name('holiday-post');
    Route::match(['get','post'],'/holidays-edit/{id?}', [HolidayController::class, 'edit'])->name('edit-holidays');
    Route::delete('/holidays/delete/{id}', [HolidayController::class, 'destroy'])->name('hr-holidays-delete');
    /* ---- End Holiday ---  */

    Route::match(['get','post'],'/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/change_password', [ProfileController::class, 'change_password'])->name('user-change_password');

      /* ---- All Designation ---  */
    Route::get('/designation', [DesignationController::class, 'index'])->name('designation');
    Route::match(['get','post'],'/designation-post', [DesignationController::class, 'add'])->name('designation-post');
    Route::delete('/designation/delete/{id?}', [DesignationController::class, 'destroy'])->name('designation-delete');
    Route::match(['get','post'],'edit/designation/{id?}', [DesignationController::class, 'edit'])->name('designation-edit');
    /* ---- End Designation ---  */

     /* ---- All Recruitments ---  */
    Route::get('/recruitment', [RecruitmentsController::class, 'index'])->name('recruitments');
    Route::match(['get','post'],'/recruitment-post', [RecruitmentsController::class, 'add'])->name('recruitment-post');
    Route::match(['get','post'],'/edit-recruitment/{id?}',[RecruitmentsController::class, 'edit'])->name('edit-recruitment');
    Route::delete('/recruitments/delete/{id?}', [RecruitmentsController::class, 'destroy'])->name('recruitments.delete');
    

    Route::get('/candidates-list', [RecruitmentsController::class, 'candidates_list'])->name('candidates-list');
    Route::match(['get','post'],'/candidates-add', [RecruitmentsController::class, 'candidates_add'])->name('candidates-add');
    Route::match(['get','post'],'candidates-edit/{id?}', [RecruitmentsController::class, 'candidates_edit'])->name('candidates-edit');
    Route::delete('/candidates-destroy/{id?}', [RecruitmentsController::class, 'candidates_destroy'])->name('candidates-destroy');
    Route::get('/shortlisted-list', [RecruitmentsController::class, 'shortlisted_list'])->name('shortlisted-list');
    Route::get('/rejected-candidates', [RecruitmentsController::class, 'rejected_candidates'])->name('rejected-candidates');
    Route::match(['get','post'],'update-shortlisted-list/{id?}', [RecruitmentsController::class,'update_shortlisted_list'])->name('update_shortlisted_list');

    Route::get('/interviews-list', [RecruitmentsController::class, 'interviews_list'])->name('interviews-list');
    Route::match(['get','post'],'/interviews-add', [RecruitmentsController::class, 'interviews_add'])->name('interviews-add');
    Route::match(['get','post'],'interviews-edit/{id?}', [RecruitmentsController::class, 'interviews_edit'])->name('interviews-edit');
    Route::delete('/interviews-destroy/{id?}', [RecruitmentsController::class, 'interviews_destroy'])->name('interviews-destroy');
    /* ---- End Recruitments ---  */

    /* ---- All Events ---  */
    Route::match(['get','post'],'/events', [EventsController::class, 'index'])->name('events');
    Route::post('/events-post', [EventsController::class, 'add'])->name('events-post');
    Route::post('/delete-events', [EventsController::class,'delete_events'])->name('delete-events');
     /* ---- End Events ---  */

     /* ---- All Leaves ---  */
    Route::get('/leaves', [LeavesController::class, 'index'])->name('leaves');
    Route::match(['get','post'],'/add-leaves',[LeavesController::class, 'add'])->name('add-leaves');
    Route::match(['get','post'],'/edit-leaves/{id?}',[LeavesController::class, 'edit'])->name('edit-leaves');
    Route::get('/leave-balance', [LeavesController::class, 'leave_balance'])->name('leave-balance');
    Route::delete('/leaves/delete/{id?}', [LeavesController::class, 'destroy'])->name('leaves.delete');
    /* ---- End Leaves ---  */

     /* ---- All Attendance ---  */
 Route::get('/attendance-list', [AttendanceController::class, 'index'])->name('attendance-list');
    Route::match(['get','post'],'/employees-attendance-report', [AttendanceController::class, 'employees_attendance_list'])->name('employees-attendance-list');
    Route::match(['get','post'],'/attendance', [AttendanceController::class, 'employeer_attendance'])->name('attendance');
    Route::match(['get','post'],'/attendance-edit', [AttendanceController::class, 'employeer_attendance_edit'])->name('attendance-edit');
    Route::match(['get','post'],'/employees-attendance-edit/{id?}', [AttendanceController::class, 'attendance_edit_hr'])->name('employees-attendance-edit');
    Route::delete('/destroy_attendance/{id?}', [AttendanceController::class, 'destroy_attendance'])->name('destroy_attendance');
    Route::match(['get','post'],'/add-attendance', [AttendanceController::class, 'add_attendance'])->name('add-attendance');
    /* ---- End Attendance ---  */
    
    /* ---- All Leads List ---  */
    Route::get('/leads-list', [LeadsController::class, 'index'])->name('leads');
    /* ---- End Leads List ---  */

    /* ---- All Notice Board List ---  */
    Route::get('/notice-board-list', [NoticeBoardController::class, 'index'])->name('notice-board');
    Route::match(['get','post'],'/notice-board-add', [NoticeBoardController::class, 'create'])->name('notice-board-add');
    Route::match(['get','post'],'/notice-board-edit/{id?}', [NoticeBoardController::class, 'edit'])->name('notice-board-edit');
    Route::delete('/notice-board-destroy/{id?}', [NoticeBoardController::class, 'destroy'])->name('notice-board-destroy');
    /* ---- End Notice Board List ---  */

     /* ---- All Award ---  */
    Route::get('/award-list', [AwardController::class, 'index'])->name('award-list');
    Route::match(['get','post'],'/award-add', [AwardController::class, 'create'])->name('award-add');
    Route::match(['get','post'],'/award-edit/{id?}', [AwardController::class, 'edit'])->name('award-edit');
    Route::delete('/award-destroy/{id?}', [AwardController::class, 'destroy'])->name('award-destroy');
    /* ---- End Award  ---  */
    
    /* ---- All Pormotion ---  */
    Route::get('/pormotion-list', [PormotionController::class, 'index'])->name('pormotion-list');
    Route::match(['get','post'],'/pormotion-add', [PormotionController::class, 'create'])->name('pormotion-add');
    Route::match(['get','post'],'/pormotion-edit/{id?}', [PormotionController::class, 'edit'])->name('pormotion-edit');
    Route::delete('/pormotion-destroy/{id?}', [PormotionController::class, 'destroy'])->name('pormotion-destroy');
    /* ---- End Pormotion  ---  */
    /* ---- All Assets Type ---  */
    Route::get('/asset-type-list', [AssetTypeController::class, 'index'])->name('asset-type-list');
    Route::match(['get','post'],'/asset-type-add', [AssetTypeController::class, 'create'])->name('asset-type-add');
    Route::match(['get','post'],'/asset-type-edit/{id?}', [AssetTypeController::class, 'edit'])->name('asset-type-edit');
    Route::delete('/asset-type-destroy/{id?}', [AssetTypeController::class, 'destroy'])->name('asset-type-destroy');
    /* ---- End Assets Type  ---  */

    /* ---- All Assets  ---  */
    Route::get('/assets-list', [AssetsController::class, 'index'])->name('assets-list');
    Route::match(['get','post'],'/assets-add', [AssetsController::class, 'create'])->name('assets-add');
    Route::match(['get','post'],'/assets-edit/{id?}', [AssetsController::class, 'edit'])->name('assets-edit');
    Route::delete('/assets-destroy/{id?}', [AssetsController::class, 'destroy'])->name('assets-destroy');
    /* ---- End Assets   ---  */
    
     /* ---- All Assets Allocate ---  */
    Route::get('/assets-allocate-to-list', [AssetsController::class, 'assets_allocate_list'])->name('assets-allocate-to-list');
    Route::match(['get','post'],'/assets-allocate-to-add', [AssetsController::class, 'assets_allocate_add'])->name('assets-allocate-to-add');
    Route::match(['get','post'],'/assets-allocate-to-edit/{id?}', [AssetsController::class, 'assets_allocate_edit'])->name('assets-allocate-to-edit');
    Route::delete('/assets-allocate-to-destroy/{id?}', [AssetsController::class, 'assets_allocate_destroy'])->name('assets-allocate-to-destroy');
    /* ---- End Assets Allocate ---  */

   
    /* ---- All Document Management ---  */
    Route::get('/document-management-list', [DocumentController::class, 'index'])->name('document-management-list');
    Route::match(['get','post'],'/document-management-add', [DocumentController::class, 'create'])->name('document-management-add');
    Route::match(['get','post'],'/document-management-edit/{id?}', [DocumentController::class, 'edit'])->name('document-management-edit');
    Route::delete('/document-management-destroy/{id?}', [DocumentController::class, 'destroy'])->name('document-management-destroy');
    /* ---- End Document Management ---  */

    /* ---- All Employees Salary Package Salary Package---  */
 Route::get('/employees-salary-package-list', [EmployeesController::class, 'salary_package_list'])->name('employees-salary-package-list');
 Route::match(['get','post'],'/employees-salary-package-add', [EmployeesController::class, 'salary_package_add'])->name('employees-salary-package-add');
 Route::match(['get','post'],'/employees-salary-package-edit/{id?}', [EmployeesController::class, 'salary_package_edit'])->name('employees-salary-package-edit');
 Route::delete('/employees-salary-package-destroy/{id?}', [EmployeesController::class, 'salary_package_destroy'])->name('employees-salary-package-destroy');
 /* ---- End Department Salary Package ---  */
 
 
  Route::get('/apply-leaves', [LeavesController::class, 'apply_leaves'])->name('apply-leaves-list');
    Route::post('/apply-leaves-post', [LeavesController::class, 'apply_leaves_post'])->name('apply-leaves-post');
    Route::get('/apply-leaves-list', [LeavesController::class, 'apply_leaves_list'])->name('apply-leaves-get');
     Route::get('/employees-apply-leaves-get', [LeavesController::class, 'employees_apply_leaves_list'])->name('employees-apply-leaves-get');
    Route::match(['get','post'],'/edit-apply-leaves/{id?}', [LeavesController::class, 'employees_apply_leaves_edit'])->name('edit-apply-leaves');
    
    
    /* ---- All Payroll ---  */
 Route::get('/payroll-list', [PayrollController::class, 'index'])->name('payroll-list');
     Route::match(['get','post'],'/payroll-edit/{id?}', [PayrollController::class, 'create'])->name('payroll-add');
     Route::get('/all-payroll-list', [PayrollController::class, 'all_payroll_list'])->name('all-payroll-list');
     Route::get('/all-expenses-list', [PayrollController::class, 'all_expenses_list'])->name('all-expenses-list');
 /* ---- End Payroll ---  */


  Route::match(['get','post'],'/employees-reliving-letter', [PDFController::class, 'relieving_letter'])->name('employees-reliving-letter');
  Route::match(['get','post'],'/employees-reliving-letter-edit/{id?}', [PDFController::class, 'relieving_letter_edit'])->name('employees-reliving-letter-edit');
  Route::delete('/employees-reliving-letter-destroy/{id?}', [PDFController::class, 'relieving_letter_destroy'])->name('employees-reliving-letter-destroy');
  // preview
  Route::get('/employees-reliving-letter-preview/{id}', [PDFController::class, 'relieving_letter_preview'])->name('employees-reliving-letter-preview');
  
  Route::match(['get','post'],'/employees-letter-of-intent', [PDFController::class, 'letter_of_intent'])->name('employees-letter-of-intent');
  Route::match(['get','post'],'/employees-letter-of-intent-edit/{id?}', [PDFController::class, 'letter_of_intent_edit'])->name('employees-letter-of-intent-edit');
  Route::delete('/employees-letter-of-intent-destroy/{id?}', [PDFController::class, 'letter_of_intent_destroy'])->name('employees-letter-of-intent-destroy');
    /* --new-- */
  Route::get('/employees-letter-of-intent-preview/{id}', [PDFController::class, 'letter_of_intent_preview'])->name('employees-letter-of-intent-preview');
  
  Route::match(['get','post'],'/employees-offer-letter', [PDFController::class, 'offer_letter'])->name('employees-offer-letter');
  Route::match(['get','post'],'/employees-offer-letter-edit/{id?}', [PDFController::class, 'offer_letter_edit'])->name('employees-offer-letter-edit');
  Route::delete('/employees-offer-letter-destroy/{id?}', [PDFController::class, 'offer_letter_destroy'])->name('employees-offer-letter-destroy');
  
  Route::match(['get','post'],'/employees-payslip-list', [PDFController::class, 'employees_payslip_list'])->name('employees-payslip-list');
  Route::match(['get','post'],'/employees-payslip-edit/{id?}', [PDFController::class, 'employees_payslip_edit'])->name('employees-payslip-edit');
Route::match(['get','post'],'/view-payslip-list/{id?}', [PDFController::class, 'view_payslip_list'])->name('view-payslip-list');
Route::get('/download-payslip/{id}', [PDFController::class, 'download_payslip'])->name('download-payslip');
Route::delete('/employees-payslip-destroy/{id?}', [PDFController::class, 'payslip_destroy'])->name('employees-payslip-destroy');
  
  Route::get('/download-employees-list', [PDFController::class, 'download_employees_list'])->name('download-employees-list');
  Route::match(['get','post'],'/employee-bank-details-send/{id?}', [EmployeesController::class, 'employees_bank_details_send'])->name('employee-bank-details-send');
  
  
  /* --- new offer letter --- */
   Route::match(['get','post'],'/employees-offere-letter', [PDFController::class, 'offere_letter'])->name('employees-offere-letter');
  Route::match(['get','post'],'/employees-offere-letter-edit/{id?}', [PDFController::class, 'offere_letter_edit'])->name('employees-offere-letter-edit');
  Route::delete('/employees-offere-letter-destroy/{id?}', [PDFController::class, 'offere_letter_destroy'])->name('employees-offere-letter-destroy');
  // preview
  Route::get('/employees-offere-letter-preview/{id}', [PDFController::class, 'offere_letter_preview'])->name('employees-offere-letter-preview');
  /* -- end -- */
});

Route::get('/expenses-list', [ExpensesController::class, 'index'])->name('hr-expenses-list');
Route::match(['get','post'],'/expenses-add', [ExpensesController::class, 'create'])->name('hr-expenses-add');
Route::match(['get','post'],'/expenses-edit/{id?}', [ExpensesController::class, 'edit'])->name('hr-expenses-edit');
Route::delete('/expenses-destroy/{id?}', [ExpensesController::class, 'destroy'])->name('hr-expenses-destroy');

/*------------------------------------------
--------------------------------------------
All Employee Routes List
--------------------------------------------
--------------------------------------------*/
Route::group(['prefix' => 'employee', 'middleware' => ['auth', 'user-access:employee']], function(){
    
    Route::get('/dashboard', [HomeController::class, 'employeer_dashboard'])->name('employee-dashboard');
    Route::get('/apply-leaves', [LeavesController::class, 'apply_leaves'])->name('employee-apply-leaves');
    Route::post('/apply-leaves-post', [LeavesController::class, 'apply_leaves_post'])->name('employee-apply-leaves-post');
    Route::get('/apply-leaves-list', [LeavesController::class, 'apply_leaves_list'])->name('employee-apply-leaves-list');
    Route::get('/holidays-list', [HolidayController::class, 'index'])->name('holiday-list');
    Route::get('/leads-list', [LeadsController::class, 'index'])->name('leads-list');
    Route::get('/notice-board-list', [NoticeBoardController::class, 'index'])->name('notice-board-list');

      Route::match(['get','post'],'/attendance', [AttendanceController::class, 'employeer_attendance'])->name('employee-attendance');
    Route::match(['get','post'],'/attendance-edit', [AttendanceController::class, 'employeer_attendance_edit'])->name('employee-attendance-edit');
    
    Route::post('/change_password', [ProfileController::class, 'change_password'])->name('change_password');
      /* ---- All Expenses ---  */
    Route::get('/expenses-list', [ExpensesController::class, 'index'])->name('expenses-list');
    Route::match(['get','post'],'/expenses-add', [ExpensesController::class, 'create'])->name('expenses-add');
        Route::match(['get','post'],'/expenses-edit/{id?}', [ExpensesController::class, 'edit'])->name('expenses-edit');
    Route::delete('/expenses-destroy/{id?}', [ExpensesController::class, 'destroy'])->name('expenses-destroy');
    /* ---- End Expenses ---  */
    
     /* ---- All Bank Details ---  */
        Route::get('/employee-bank-details-list', [EmployeesController::class, 'employees_bank_details_view'])->name('employee-bank-details-list');
        Route::match(['get','post'],'/employee-bank-details-edit/{id?}', [EmployeesController::class, 'employees_bank_details_update'])->name('employee-bank-details-update');
        
        Route::match(['get','post'],'/employee-bank-details-send-request/{id?}', [EmployeesController::class, 'employees_bank_details_send_request'])->name('employee-bank-details-send-request');
        
        
        /* ---- End Bank Details ---  */
        
         /* ---- All Employee Relations Details ---  */
        Route::get('/relations-details-list', [EmployeesController::class, 'employees_relations_details'])->name('relations-details-list');
        Route::match(['get','post'],'/relations-details-add', [EmployeesController::class, 'employees_relations_details_create'])->name('relations-details-add');
        Route::match(['get','post'],'/relations-details-edit/{id?}', [EmployeesController::class, 'employees_relations_details_edit'])->name('relations-details-edit');
        Route::delete('/relations-details-destroy/{id?}', [EmployeesController::class, 'employees_relations_details_destroy'])->name('relations-details-destroy');
        /* ---- End Employee Relations Details ---  */
        
        /* ---- All Experience ---  */
      Route::get('/experience', [EmployeesController::class, 'employees_experience_list'])->name('experience');
      Route::match(['get','post'],'/experience-add', [EmployeesController::class, 'employees_experience_create'])->name('experience-add');
      Route::match(['get','post'],'/experience-edit/{id?}', [EmployeesController::class, 'employees_experience_edit'])->name('experience-edit');
      Route::delete('/experience_destroy/{id?}', [EmployeesController::class, 'employees_experience_destroy'])->name('experience_destroy');

      /* ---- End Experience ---  */
      
      
        /* ---- All Experience ---  */
      Route::get('/education', [EmployeesController::class, 'employees_education_list'])->name('education');
      Route::match(['get','post'],'/education-add', [EmployeesController::class, 'employees_education_create'])->name('education-add');
      Route::match(['get','post'],'/education-edit/{id?}', [EmployeesController::class, 'employees_education_edit'])->name('education-edit');
      Route::delete('/employees_education_destroy/{id?}', [EmployeesController::class, 'employees_education_destroy'])->name('employees_education_destroy');
      /* ---- End Experience ---  */
      
      Route::get('/work-report', [EmployeesController::class, 'employee_work_report_list'])->name('employee-work-report');
      Route::match(['get','post'],'/work-report-add', [EmployeesController::class, 'employee_work_report_create'])->name('employee-work-report-add');
      Route::match(['get','post'],'/work-report-edit/{id?}', [EmployeesController::class, 'employee_work_report_edit'])->name('employee-work-report-edit');
      Route::delete('/work-report-destroy/{id?}', [EmployeesController::class, 'employee_work_report_destroy'])->name('employee_work_report_destroy');
});


