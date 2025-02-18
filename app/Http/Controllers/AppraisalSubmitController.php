<?php

namespace App\Http\Controllers;

use  App\Models\AppraisalSection;
use  App\Models\AppraisalSectionIndicator;
use Illuminate\Http\Request;
use App\Models\Appraisal;
use App\Models\Employee;

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
        $sectionWeightage = isset($data['section_weightage']) ? intval($data['section_weightage']) : 100;
    
        // Determine max possible score dynamically
        $numIndicators = count($performanceIndicators);
        $maxScore = $numIndicators * 10; // Each indicator max is 10
    
        // Avoid division by zero
        $percentage = ($maxScore > 0) ? ($total / $maxScore) * $sectionWeightage : 0;
        $data['percentage'] = round($percentage, 2);
    
        // Fetch designation_id and department_id from Employee model
        $employee = Employee::getEmployeeDesDepartId($data['employee_id']);
    
        if (!$employee) {
            return response()->json(['error' => 'Employee not found'], 404);
        }
    
        // Save appraisal using model function
        $appraisal = Appraisal::saveAppraisal($data, $employee->designation_id, $employee->department_id);
    
        // Return the view with appraisal data

        return redirect()->route("performance.appraisal.index")->with('message', $appraisal->getData());
        ;
        
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
        $roleId = $user->role_users_id; // Fetch role_users_id from the authenticated user
    
        // Fetch sections assigned to this role (evaluator)
        $appraisalSections = AppraisalSection::where('evaluate_by', $roleId)->get();
    
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
    


    
            

}
