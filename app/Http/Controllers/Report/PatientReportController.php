<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Patient;
use App\Models\Patient\Diagnosis;
use App\Models\Patient\Treatment;
use App\Models\Employee;
use App\Models\DiagnosisTags;

use Illuminate\Support\Number;

class PatientReportController extends Controller
{
    public function index()
    {
        return Inertia::render('reports/patient/Index', [
            'title' => 'Reports | Patients',
            'description' => 'Patient Report',
            // 'patients' => $patients,
            // 'tags' => $tags
        ]);
    }

    public function demographics(Request $request)
    {
        $request->validate([
            'gender' => ['nullable', 'string'],
            'civil_status' => ['nullable', 'string'],
            'source' => ['nullable', 'string'],
        ]);

        $query = Patient::query();
        $query->select([
                'patient_id', 'lastname', 'firstname', 'middlename', 
                'contact_number', 'md_assigned', 'address', 'source', 
                'civil_status', 'gender', 'birthdate', 'contact_number', 'email_address', 
            ])
            ->whereNotNull('lastname')
            ->whereNotNull('firstname');

        if($request->has('gender') && $request->gender != 'all') {
            $query->where('gender', $request->gender);
        }

        if($request->has('civil_status')  && $request->civil_status != 'all') {
            $query->where('civil_status', $request->civil_status);
        }

        if($request->has('source')  && $request->source != 'all') {
            $query->where('source', $request->source);
        }

        $patients = $query->orderBy('lastname', 'asc')->get();
    

        $genderTags = Patient::distinct()->whereNotNull('gender')->where('gender', '!=', '')->pluck('gender')->map(function ($tag) {
            return ucwords(strtolower($tag));
        });
        $civilStatusTags = Patient::distinct()->whereNotNull('civil_status')->where('civil_status', '!=', '')->pluck('civil_status')->map(function ($tag) {
            return ucwords(strtolower($tag));
        });
        $sourceTags = Patient::distinct()->whereNotNull('source')->where('source', '!=', '')->pluck('source')->map(function ($tag) {
            return ucwords(strtolower($tag));
        });

        return Inertia::render('reports/patient/Demographics', [
            'title' => 'Reports | Patients',
            'description' => 'Patient Demographics Report',
            'patients' => $patients,
            'genderTags' => $genderTags,
            'civilStatusTags' => $civilStatusTags,
            'sourceTags' => $sourceTags,
            'totalPatients' => $patients->count(),
            'filters' => $request->only(['gender', 'civil_status', 'source']),
        ]);
    }

    public function diagnosis(Request $request)
    {

        $request->validate([
            'diagnosis' => ['nullable', 'string'],
            'md_assigned' => ['nullable', 'string'],
        ]);
        
        $diagnosisTags = DiagnosisTags::select(['tag_id', 'tag as label'])->get();

        $query = Patient::query();

        $query->with(['md','diagnosis', 'treatments'])->select(['patient_id', 'lastname', 'firstname', 'middlename', 'md_assigned', 'address', 'gender'])
                    ->whereNotNull('lastname')
                    ->whereNotNull('firstname')
                    ->whereNotNull('md_assigned')
                    ->whereHas('diagnosis', function ($query) {
                        $query->whereNotNull('diagnosis');
                    });

        if( $request->has('diagnosis')) {
            $query->whereHas('diagnosis', function ($query) use ($request) {
                   $query->where('diagnosis', 'LIKE', '%' . $request->diagnosis . '%');
            });
        }
        
        $patients = $query->orderBy('lastname', 'asc')->get();

        // $patients = Patient::with(['diagnosis'])
        //         ->select('patient_id', 'lastname', 'firstname', 'middlename', 'md_assigned', 'address', 'gender')
        //         ->whereNotNull('lastname')
        //         ->whereNotNull('firstname')
        //         ->whereNotNull('md_assigned')
        //         // ->whereNotNull('md_assigned')
        //         // ->where('md_assigned', '>', 0)
        //         ->whereHas('diagnosis', function ($query) use ($diagnosisTags) {
        //             $query->whereNotNull('diagnosis')
        //                 ->where(function ($q) use ($diagnosisTags) {
        //                     foreach ($diagnosisTags as $diagnosisTag) {
        //                         $q->orWhere('diagnosis', 'LIKE', '%' . $diagnosisTag->label . '%');
        //                     }
        //                 });
        //         })
        //         ->orderBy('lastname', 'asc')
        //         ->limit(100) // Limit to 100 patients for performance
        //         ->get();

                
        // foreach ($patients as $patient) {
        //     $patient->diagnosis_tags = collect();

        //     foreach ($patient->diagnosis as $diagnosis) {
        //         foreach ($diagnosisTags as $diagnosisTag) {
        //             if (stripos($diagnosis->diagnosis, $diagnosisTag->label) !== false) {
        //                 $patient->diagnosis_tags->push($diagnosisTag->label);
        //             }
        //         }
        //     }

        //     // Optional: Remove duplicate tags
        //     $patient->diagnosis_tags = $patient->diagnosis_tags->unique()->values();
        // }
                

        return Inertia::render('reports/patient/Diagnosis', [
            'title' => 'Reports | Patients',
            'description' => 'Patient Report',
            'patients' => $patients,
            // 'tags' => $tags,
            'filters' => $request->only(['diagnosis']),
            'diagnosisTags' => $diagnosisTags,
            'totalPatients' => $patients->count(),
            // 'multiSelectTags' => $multiSelectTags,
            // 'mds' => Employee::where('role', 'doctor')->pluck('name', 'employee_id'),
            // 'diagnosisTags' => DiagnosisTags::pluck('tag')->toArray(),
            // 'diagnosisTagsCount' => DiagnosisTags::select('tag', \DB::raw('COUNT(*) as count'))
            //     ->groupBy('tag')
            //     ->pluck('count', 'tag'),
            // 'diagnosisTagsPatientsCount' => DiagnosisTags::withCount('patients')
            //     ->pluck('patients_count', 'tag'),
            // 'diagnosisTagsPatients' => DiagnosisTags::with(['patients' => function ($query) {
            //     $query->select('patient_id', 'lastname', 'firstname', 'middlename', 'md_assigned', 'address');
            // }])->get(),
        ]);
    }
}
