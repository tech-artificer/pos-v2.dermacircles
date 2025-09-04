<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use League\Csv\Reader;
use Illuminate\Support\Facades\DB;

class DermatologyDiagnosesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

       $csvFilePath = database_path('diagnosis.csv');
        $fileHandle = fopen($csvFilePath, 'r');
        
        // Check if the file was opened successfully
        if ($fileHandle === FALSE) {
            return;
        }

        // Skip the header row
        fgetcsv($fileHandle);

        $dataToInsert = [];
        while (($data = fgetcsv($fileHandle, 1000, ',')) !== FALSE) {
            // Ensure the row has enough columns
            if (count($data) < 7) {
                continue;
            }

            // Map the CSV columns to the database columns
            $dataToInsert[] = [
                // 'id' is intentionally omitted here to allow for auto-increment
                'name' => $data[1],
                'description' => $data[2] ?? null,
                'symptoms' => $data[3] ?? null,
                'created_at' => Carbon::parse($data[5]),
                'updated_at' => Carbon::parse($data[6]),
            ];
        }

        fclose($fileHandle);
        
        // Insert all rows at once for better performance
        DB::table('dermatology_diagnoses')->insert($dataToInsert);
    }
}
