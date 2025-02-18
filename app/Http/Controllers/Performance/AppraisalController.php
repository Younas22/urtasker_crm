<?php

namespace App\Http\Controllers\Performance;

use App\Models\Appraisal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\AppraisalSubmitController;

class AppraisalController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $appraisals = Appraisal::with('company:id,company_name','employee:id,first_name,last_name','department:id,department_name','designation:id,designation_name')
                        ->orderBy('id','DESC')->get();
                        
                  

            return DataTables::of($appraisals)
                ->setRowId(function ($row)
                {
                    return $row->id;
                })
                ->addIndexColumn()
                ->addColumn('company_name', function ($row)
                {
                    return $row->company->company_name ?? '' ;
                })
                ->addColumn('employee_name', function ($row)
                {
                    if ($row->employee) {
                        return $row->employee->first_name.' '.$row->employee->last_name;
                    }else {
                        return '';
                    }

                })
                ->addColumn('department_name', function ($row)
                {
                    return $row->department->department_name ?? '';
                })
                ->addColumn('designation_name', function ($row)
                {
                    return $row->designation->designation_name ?? '' ;
                })
                ->addColumn('date', function ($row)
                {
                    return date("d M, Y", strtotime($row->date));;
                })

                ->addColumn('full_result', function ($row) {
                    if (!$row->full_result) return '';
                
                    $sections = json_decode($row->full_result, true);
                
                    if (!is_array($sections)) return '';
                
                    $sectionNames = array_column($sections, 'section_name');
                
                    return '' . implode(' / ', $sectionNames) . '';
                })
                ->rawColumns(['full_result'])





                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" name="edit" data-id="'.$row->id.'" class="edit btn btn-success btn-sm"><i class="dripicons-pencil"></i></a>
                                &nbsp;
                                <a href="javascript:void(0)" name="delete" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm"><i class="dripicons-trash"></i></a>';
                    return $actionBtn;
                })
                
                ->rawColumns(['action'])
                ->make(true);
               
        }


        $companies = Company::select('id','company_name')->get();
        $sectionArray=$this->getFormattedSectionData();
        $appraisalData = session('appraisal_data'); 

        $recordToBeIncremented = AppraisalSubmitController::getAppraisalsWithFullResultLength4();
        return view('performance.appraisal.index', compact('companies', 'sectionArray','recordToBeIncremented'))->with([
            'success' => session('success'),
            'error' => session('error')
        ]);

    }


    function getFormattedSectionData()
    {
        $evaluateBy = [
            1 => 'Admin',
            4 => 'Team Lead',
            6 => 'HR' ,
            20 => 'Director',
        ];
    
        $sectionData = app(AppraisalSubmitController::class)->getYourSection();
        $sectionArray = json_decode($sectionData->getContent(), true);
    
        // Ensure 'evaluate_by' exists before modifying
        if (isset($sectionArray[0]['section']['evaluate_by'])) {
            $evaluateByKey = $sectionArray[0]['section']['evaluate_by'];
    
            // Replace the numeric value with the corresponding label
            $sectionArray[0]['section']['evaluate_by'] = $evaluateBy[$evaluateByKey] ?? 'Unknown';
        }
    
        return $sectionArray;
    }
    



    public function getEmployee(Request $request)
    {
        $employees = Employee::where('company_id',$request->company_id)
                    ->select('id','first_name','last_name')
                    ->where('is_active',1)->where('exit_date',NULL)
                    ->get();

        return response()->json(['employees' => $employees]);
    }

    public function store(Request $request)
    {
        $logged_user = auth()->user();

        if ($logged_user->can('store-appraisal'))
		{
            if ($request->ajax())
            {
                $validator = Validator::make($request->only('company_id','employee_id'),[
                    'company_id' => 'required',
                    'employee_id' => 'required'
                ]);

                if ($validator->fails())
                {
                    return response()->json(['errors' => "<h3>Please fill the required option</h3>"]);
                }

                $employee = Employee::find($request->employee_id);

                $appraisal                = new Appraisal();
                $appraisal->company_id    = $request->company_id;
                $appraisal->employee_id   = $request->employee_id;
                $appraisal->department_id = $employee->department_id;
                $appraisal->designation_id= $employee->designation_id;
                $appraisal->customer_experience = $request->customer_experience;
                $appraisal->marketing     = $request->marketing;
                $appraisal->administration= $request->administration;
                $appraisal->professionalism = $request->professionalism;
                $appraisal->integrity     = $request->integrity;
                $appraisal->attendance    = $request->attendance;
                $appraisal->remarks       = $request->remarks;
                $appraisal->date          = $request->date;
                $appraisal->save();

                return response()->json(['success' => '<p><b>Data Saved Successfully.</b></p>']);
            }
        }
    }

    public function edit(Request $request)
    {
        if ($request->ajax())
        {
            $appraisal = Appraisal::find($request->id);
            $employees = Employee::select('id','first_name','last_name')->where('company_id',$appraisal->company_id)->where('is_active',1)->where('exit_date',NULL)->get();

            return response()->json(['appraisal' => $appraisal, 'employees'=> $employees]);
        }
    }

    public function update(Request $request)
    {
        $logged_user = auth()->user();

        if ($logged_user->can('edit-appraisal'))
		{
            if ($request->ajax())
            {
                $appraisal = Appraisal::find($request->appraisal_id);
                $employee  = Employee::find($request->employee_id);

                $appraisal->company_id    = $request->company_id;
                $appraisal->employee_id   = $request->employee_id;
                $appraisal->department_id = $employee->department_id;
                $appraisal->designation_id= $employee->designation_id;
                $appraisal->date          = $request->date          ;
                $appraisal->customer_experience = $request->customer_experience;
                $appraisal->marketing     = $request->marketing;
                $appraisal->administration= $request->administration;
                $appraisal->professionalism = $request->professionalism;
                $appraisal->integrity     = $request->integrity;
                $appraisal->attendance    = $request->attendance;
                $appraisal->remarks       = $request->remarks;
                $appraisal->update();

                return response()->json(['success' => '<p><b>Data Updated Successfully.</b></p>']);
            }
        }
    }

    public function delete(Request $request)
    {
        $logged_user = auth()->user();

        if ($logged_user->can('delete-appraisal'))
		{
            if ($request->ajax()) {
                $appraisal = Appraisal::find($request->appraisal_id);
                $appraisal->delete();

                return response()->json(['success' => '<p><b>Data Deleted Successfully.</b></p>']);
            }
        }
    }

    public function deleteCheckbox(Request $request)
    {
        if ($request->ajax())
        {
            $all_id   = $request->all_checkbox_id;
            $total_id = count($all_id);
            for ($i=0; $i < $total_id; $i++) {
                $data = Appraisal::find($all_id[$i]);
                $data->delete();
            }

            return response()->json(['success' => '<p><b>Data Deleted Successfully.</b></p>']);
        }
    }



    public static function setIncrement(Request $request){
        // Extract the IDs and increments from the request
        $ids = $request->input('id');
        $increments = $request->input('increment');

        // Ensure both arrays have the same length
        if (count($ids) !== count($increments)) {
            return response()->json(['error' => 'IDs and increments count mismatch'], 400);
        }

        // Loop through the IDs and update the corresponding records
        foreach ($ids as $index => $id) {
            Appraisal::where('id', $id)->update([
                'increment_granted' => $increments[$index]
            ]);
        }
        return redirect(route('performance.appraisal.index'));
    }
}
