<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppraisalSection;
use App\Models\AppraisalSectionIndicator;


class NewAppraisalController extends Controller
{
    /**
     * Handle new appraisal form submission.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNewAppraisalType(Request $request)
    {




       
        // Validate incoming request 
    //   Validate incoming request with custom error messages

 

//    $request->validate([
//     "company_id"         => "required|integer",
//     "section_name"       => "required|array|min:1",
//     "section_name.*"     => "required|string", // Ensures each item in section_name is a valid string
//     "indicators"         => "required|array|min:1",
//     "indicators.*"       => "required|array|min:1", // Ensures each indicator group is an array with values
//     "section_weightage"  => "required|array|min:1",
//     "section_weightage.*"=> "required|numeric|min:1", // Ensures weightage values are valid numbers
//     "evaluate_by"        => "required|array|min:1",
//     "evaluate_by.*"      => "required|string" // Ensures each evaluator is a valid string
// ], [
//     "company_id.required"         => "Please select a company.",
//     "company_id.integer"          => "Invalid company selection.",
//     "section_name.required"       => "At least one appraisal section name is required.",
//     "section_name.array"          => "Appraisal section names must be an array.",
//     "section_name.min"            => "Appraisal section names cannot be empty.",
//     "section_name.*.required"     => "Each section name must have a value.",
//     "section_name.*.string"       => "Section names must be valid strings.",
//     "indicators.required"         => "At least one indicator is required for each section.",
//     "indicators.array"            => "Indicators must be an array.",
//     "indicators.min"              => "Indicators cannot be empty.",
//     "indicators.*.required"       => "Each indicator group must contain at least one indicator.",
//     "indicators.*.array"          => "Each indicator must be an array.",
//     "indicators.*.min"            => "Each indicator array must have at least one value.",
//     "section_weightage.required"  => "Please assign weightage to all sections.",
//     "section_weightage.array"     => "Section weightage must be an array.",
//     "section_weightage.min"       => "Section weightage cannot be empty.",
//     "section_weightage.*.required"=> "Each section must have a weightage value.",
//     "section_weightage.*.numeric" => "Weightage must be a valid number.",
//     "section_weightage.*.min"     => "Weightage must be at least 1.",
//     "evaluate_by.required"        => "Please select an evaluator.",
//     "evaluate_by.array"           => "Evaluator selection must be an array.",
//     "evaluate_by.min"             => "At least one evaluator must be selected.",
//     "evaluate_by.*.required"      => "Each evaluator must have a value.",
//     "evaluate_by.*.string"        => "Evaluator must be a valid string."
// ]);



        $request['indicators'] = array_values(array: array_map(callback: function ($value): array {
            return array_values($value);
        }, array: $request['indicators']));



        // Insert data into the database
        var_dump("controller 1");
        $sectionIdsArray=AppraisalSection::storeSections($request);

        AppraisalSectionIndicator::storeIndicators(insertedIds: $sectionIdsArray,request: $request);

        return response()->json(['message' => 'Appraisal sections and indicators created successfully.']);
    }

    
}
