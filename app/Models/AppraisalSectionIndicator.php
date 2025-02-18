<?php

namespace App\Models;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppraisalSectionIndicator extends Model
{
    protected $table = 'appraisal_section_indicators';
    protected $fillable = ['section_id', 'name', 'weight'];

    public static function storeIndicators(array $insertedIds, Request $request)
    {
        $indicatorsData = [];
        var_dump("indicators 1");
        foreach ($insertedIds as $index => $sectionId) {
            if (!isset($request->indicators[$index]) || !is_array($request->indicators[$index])) {
                continue; // Skip if no indicators exist for this section
            }
            var_dump("indicators 2");


            foreach ($request->indicators[$index] as $indicatorName) {
                $indicatorsData[] = [
                    'section_id' => $sectionId,
                    'name' => $indicatorName, // Directly store the name from the array
                    'weight' => null, // No weight provided in the data
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            var_dump("indicators 3");

        }

        // Insert all indicators in bulk
        self::insert($indicatorsData);

        return response()->json([
            'message' => 'Indicators stored successfully',
            'data' => $indicatorsData
        ], 201);
    }

    public static function getIndicatorsBySectionId($sectionId)
    {
        return self::where('section_id', $sectionId)->get();
    }
}
