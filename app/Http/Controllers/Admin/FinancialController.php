<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\Financial;
use App\Models\User;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FinancialController extends Controller
{
   public function addfinancial()
   {
      $page = 'financial';
      //get employee with role employee or admin
      $employees = Employee::where('status', '1')->where('role', "!=", 'superadmin')->get();
      // you can add admin also if you want to pay them
      return view('Pages.Admin.Financial.AddFinancial', (compact('page', 'employees')));
   } 

    public function financial(Request $request)
    {
        $page = 'financial';
        $financials = Financial::orderBy('id', 'desc')->with('employee')->get();
        return view('Pages.Admin.Financial.Financial', compact('financials', 'page'));
    }

    public function viewfinancial($id)
    {
        $page = 'financial';
        $financial = Financial::where('id', $id)->first();
        $employee = Employee::where('id', $financial->employee_id)->first();
        return view('Pages.Admin.Financial.ViewFinancial', compact('financial','employee', 'page'));
    }

    public function submitfinancial(Request $request)
    {
        // Validate Employee Fields
        $request->validate([
            'employee_id' => 'required|string|unique:financials,employee_id',
            'paymentmethod' => 'required|string',
            'paymentprice' => 'required|string',
            'paymentaddress' => 'required|string',
            'status' => 'required|string',
        ],
        [
            'employee_id.required' => 'Employee Already Added',
            'employee_id.unique' => 'Employee Already Added',
            'paymentmethod.required' => 'Payment Method Required',
            'paymentprice.required' => 'Payment Price Required',
            'paymentaddress.required' => 'Payment Address Required',
            'status.required' => 'Status Required',
        ]);
        // Insert Employee Data
        $financial = new Financial();
        $financial->employee_id = $request->employee_id;
        $financial->paymentmethod = $request->paymentmethod;
        $financial->paymentprice = $request->paymentprice;
        $financial->paymentaddress = $request->paymentaddress;
        $financial->status = $request->status;
        $financial->save();

        // Redirect to Employee Page
        return redirect()->route('admin.financial')->with('success', 'Financial Details Added Successfully');

    }

    public function financialedit($id)
    {
        $page = 'financial';
        $financial = Financial::where('id', $id)->first();
        $employees = User::where('role', 'employee')->get();
        return view('Pages.Admin.Financial.FinancialEdit', compact( 'page', 'employees', 'financial'));
    }

    public function financialstatus(Request $request)
    {
        $financial = Financial::where('id', $request->id)->first();
        if($financial){
        $financial->status = $request->status; 
        $financial->save();
        }



        return response()->json(['message' => 'Updated successfully.'], 200);
    }

    public function updatefinancial(Request $request)
    {
        
        // Validate Employee Fields
        $request->validate([
            'employee_id' => 'required|string|unique:financials,employee_id,'.$request->id.'',
            'paymentmethod' => 'required|string',
            'paymentprice' => 'required|string',
            'paymentaddress' => 'required|string',
            'status' => 'required|string',
        ],
        [
            'employee_id.required' => 'Employee Required',
            'employee_id.unique' => 'Employee Already Added',
            'paymentmethod.required' => 'Payment Method Required',
            'paymentprice.required' => 'Payment Price Required',
            'paymentaddress.required' => 'Payment Address Required',
            'status.required' => 'Status Required',
        ]);

        // Insert Employee Data
        Financial::findOrFail($request->id)->update([
            'employee_id' => $request->employee_id,
            'paymentmethod' => $request->paymentmethod,
            'paymentprice' => $request->paymentprice,
            'paymentaddress' => $request->paymentaddress,
            'status' => $request->status,
            'updated_at' => Carbon::now(),
        ]);
        // Redirect to Employee Page
        return redirect()->route('admin.financial')->with('success', 'Financial Details Updated Successfully');

    }

    public function deletefinancial($id)
    {
        $financial = Financial::where('id', $id)->first();
        $financial->delete();
        return response('Employee deleted successfully');
    }
    
}
