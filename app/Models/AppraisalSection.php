<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AppraisalSection extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'name', 'weightage','evaluate_by'];

    public function indicators()
    {
        return $this->hasMany(AppraisalSectionIndicator::class);
    }

    public function appraisal()
    {
        return $this->belongsTo(Appraisal::class);
    }

    /**
     * Insert sections with indicators.
     *
     * @param array $data
     * @return void
     */
    public static function insertSectionsWithIndicators(array $data)
    {
        foreach ($data['section_name'] as $index => $sectionName) {
            // Create the section
            var_dump('hello 1');

            try {
                $section = self::create([
                    'company_id'   => $data['company_id'],
                    'name'         => $sectionName,
                ]);
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
            var_dump('hello 2');

            // Create related indicators for the section
           

            try {
                foreach ($data['indicators'][$index] as $indicatorName) {
                    $section->indicators()->create(['name' => $indicatorName]);
                }
            } catch (\Exception $e) {
                dd($e->getMessage());
            }
            var_dump('hello 3');

        }
    }


    public static function storeSections(Request $request)
    {
        var_dump("app_1");
        $sections = [];
        $insertedIds = [];
        var_dump("app_2");

        foreach ($request->section_name as $index => $sectionName) {
            $section = AppraisalSection::create([
                'company_id' => $request->company_id,
                'name' => $sectionName,
                'weightage' => intval($request->roles[$index]),
                'evaluate_by'=>intval($request->roles[$index]),
            ]);
    
            $sections[] = $section;
            $insertedIds[] = $section->id; // Capture inserted ID
        }
    
        return $insertedIds;
    }

    public static function getSectionsByCompanyId($companyId)
    {
        return AppraisalSection::where('company_id', $companyId)->get();
    }



   
}
    