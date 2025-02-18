<?php

namespace App\Http\Controllers;

use  App\Models\AppraisalSection;
use  App\Models\AppraisalSectionIndicator;
use Illuminate\Http\Request;
use App\Models\Appraisal;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class AppraisalSubmitController extends Controller
{



    function submitEmployeeAppraisal(Request $request) {

      
        $data = $request->all();
    
        // Extract performance indicators
        $performanceIndicators = $data['performance_indicators'] ?? [];
    
        // Calculate total score
        $total = array_sum(array_map('intval', $performanceIndicators));
        $data['total'] = $total;
     
        // Get section weightage
        $sectionWeightage = isset($data['weightage']) ? intval($data['weightage']) : 100;
    
        // Determine max possible score dynamically
        $numIndicators = count($performanceIndicators);
        $maxScore = $numIndicators * 10; // Each indicator max is 10
    
        // Avoid division by zero
        $percentage = ($maxScore > 0) ? ($total / $maxScore) * $sectionWeightage : 0;
        $data['percentage'] = round($percentage, 2);
    
        // Fetch designation_id and department_id from Employee model
        $employee = Employee::getEmployeeDesDepartId($data['employee_id']);
    
        if (!$employee) {
            return redirect()->route("performance.appraisal.index")->with('error', 'Employee not found');
        }
    
        // Save appraisal using model function
        $appraisal = Appraisal::saveAppraisal($data, $employee->designation_id, $employee->department_id);
    
        // Extract message from response (assuming saveAppraisal returns JSON)
        $appraisalData = $appraisal->getData();
    
        // Store message properly in session
        if (isset($appraisalData->error)) {

            return redirect()->route("performance.appraisal.index")->with('error', $appraisalData->error);
        }

    
        return redirect()->route("performance.appraisal.index")->with('success', 'Appraisal saved successfully!');
    }
    
    
    




    function getUserRoleId()
    {
        // Get the currently authenticated user
        $user = auth()->user();
    
        // Check if a user is logged in
        if (!$user) {
            return 0;
        }
    
        // Return the role_users_id
        return $user->role_users_id;
    }


    function getYourSection()
    {
        // Get the logged-in user's role ID
        $user = auth()->user();
        $employee = Employee::find($user->id);
        $roleId = $user->role_users_id; // Fetch role_users_id from the authenticated user
        $directorChecking=$employee->appraisal;
    
        // Fetch sections assigned to this role (evaluator)
        if($directorChecking==20){
            $appraisalSections = AppraisalSection::where('evaluate_by', $directorChecking)->get();
        }
        else{
            $appraisalSections = AppraisalSection::where('evaluate_by', $roleId)->get();
        }

    
        // If no sections are found, return an error response
        if ($appraisalSections->isEmpty()) {
            return response()->json(['message' => 'No sections found for this evaluator'], 404);
        }
    
        // Process each section and fetch its indicators
        $sectionsWithIndicators = [];
        foreach ($appraisalSections as $section) {
            $indicators = AppraisalSectionIndicator::getIndicatorsBySectionId($section->id);
            $sectionsWithIndicators[] = [
                'section' => $section,
                'indicators' => $indicators
            ];
        }
    
        return response()->json($sectionsWithIndicators);
    }
    

    public static function getAppraisalsWithFullResultLength4()
    {
        try {
            // Get initial records
            $recordToBeIncremented = Appraisal::getAppraisalsWithFullResultLength4();
            
            // Transform each record to add related data
            $transformedRecords = $recordToBeIncremented->map(function ($record) {
                // Get company data
                $company = DB::table('companies')
                    ->where('id', $record->company_id)
                    ->select('id', 'company_name')
                    ->first();
    
                // Get employee data
                $employee = DB::table('employees')
                    ->where('id', $record->employee_id)
                    ->select('id', 'first_name', 'last_name', 'department_id')
                    ->first();
    
                // Get department data
                $department = null;
                if ($employee && $employee->department_id) {
                    $department = DB::table('departments')
                        ->where('id', $employee->department_id)
                        ->select('id', 'department_name')
                        ->first();
                }
    
                // For debugging
            Log::info('Processing record:', [
                    'appraisal_id' => $record->id,
                    'company_data' => $company,
                    'employee_data' => $employee,
                    'department_data' => $department
                ]);
    
                // Add new fields to the record
                $record->company_name = $company ? $company->company_name : 'N/A';
                $record->full_name = $employee ? 
                    trim($employee->first_name . ' ' . $employee->last_name) : 'N/A';
                $record->department_name = $department ? 
                    $department->department_name : 'N/A';
    
                return $record;
            });
    
            // For debugging
            Log::info('Transformed records count: ' . $transformedRecords->count());
    
            // return view('performance.appraisal.set-increment', ['recordToBeIncremented' => $transformedRecords]);
            return $transformedRecords;
            
        } catch (\Exception $e) {
            Log::error('Error in getAppraisalsWithFullResultLength4: ' . $e->getMessage());
            return view('performance.appraisal.set-increment', ['recordToBeIncremented' => collect()]);
        }
    }

    
            

}
