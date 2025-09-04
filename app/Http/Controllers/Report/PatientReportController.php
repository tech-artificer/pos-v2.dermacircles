<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Models\Patient;
use App\Models\DermatologyDiagnosis;
use App\Models\Sales as Sale;

class PatientReportController extends Controller
{
    public function index()
    {

        $actualPatientsCount = Sale::distinct('patient_id')->count();

        return Inertia::render('reports/patient/Index', [
            'title' => 'Reports | Patients',
            'description' => 'Patient Report',
            'actualPatientsCount' => $actualPatientsCount,
    
        ]);
    }

    public function demographics(Request $request)
    {
        $filters = $request->validate([
            'gender' => ['nullable', 'string'],
            'civil_status' => ['nullable', 'string'],
            'source' => ['nullable', 'string'],
        ]);

        $gender = $filters['gender'] ?? null;
        $civilStatus = $filters['civil_status'] ?? null;
        $source = $filters['source'] ?? null;

        $patients = Patient::query()
            ->select([
                'patient_id', 'lastname', 'firstname', 'middlename',
                'contact_number', 'md_assigned', 'address', 'source',
                'civil_status', 'gender', 'birthdate', 'email_address',
            ])
            ->whereNotNull('lastname')
            ->whereNotNull('firstname')
            ->when(!is_null($gender) && $gender !== 'all', fn($q) => $q->where('gender', $gender))
            ->when(!is_null($civilStatus) && $civilStatus !== 'all', fn($q) => $q->where('civil_status', $civilStatus))
            ->when(!is_null($source) && $source !== 'all', fn($q) => $q->where('source', $source))
            ->orderBy('lastname')
            ->get();

        return Inertia::render('reports/patient/Demographics', [
            'title' => 'Reports | Patients',
            'description' => 'Patient Demographics Report',
            'patients' => $patients,
            'civilStatusTags' => $this->distinctTags('civil_status'),
            'filters' => $filters,
        ]);
    }

    public function diagnosis(Request $request)
    {
        $filters = $request->validate([
            'diagnosis' => ['nullable', 'string'],
            'md_assigned' => ['nullable', 'string'], // reserved for future filter use
        ]);

        // $diagnosis = $filters['diagnosis'] ?? null;

        $patients = Patient::query()
            ->with(['md', 'diagnosis', 'treatments.user.therapist'])
            ->select([
                'patient_id', 'lastname', 'firstname', 'middlename',
                'md_assigned', 'address', 'gender',
            ])
            ->whereNotNull('lastname')
            ->whereNotNull('firstname')
            ->whereNotNull('md_assigned')
            ->whereHas('diagnosis', fn($q) => $q->whereNotNull('diagnosis'))
            // ->when($diagnosis, fn($q) =>
            //     $q->whereHas('diagnosis', fn($dq) =>
            //         $dq->where('diagnosis', 'LIKE', '%' . $diagnosis . '%')
            //     )
            // )
            ->orderBy('lastname')
            ->get();
    
       return Inertia::render('reports/patient/Diagnosis', [
            'title' => 'Reports | Patients',
            'description' => 'Patient Diagnosis Report',
            'patients' => $patients,
            'genderTags' => $this->distinctTags('gender'),
            'civilStatusTags' => $this->distinctTags('civil_status'),
            'sourceTags' => $this->distinctTags('source'),
            'filters' => $filters,
        ]);
    }

    public function visits(Request $request) {
        
        return Inertia::render('reports/patient/Visits', [
            'title' => 'Reports | Patients',
            'description' => 'Patient Report',
        ]);
    }

    /**
     * Get distinct tag values from Patient table and format them.
     *
     * @param string $column
     * @return \Illuminate\Support\Collection
     */
    private function distinctTags(string $column)
    {
        return cache()->remember("patient_tags_{$column}", 3600, function () use ($column) {
            return Patient::query()
                ->distinct()
                ->whereNotNull($column)
                ->where($column, '!=', '')
                ->pluck($column)
                ->map(fn($tag) => Str::of($tag)->lower()->title())
                ->unique()
                ->sort()
                ->values();
        });
    }
}
