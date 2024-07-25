<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hajjs;

class HajjsController extends Controller
{
    public function uploadCSV(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'csv' => 'required|file|mimes:csv,txt',
        ]);

        // Get the uploaded file
        $file = $request->file('csv');

        // Open the CSV file
        $handle = fopen($file->getRealPath(), 'r');

        // Skip the header row
        fgetcsv($handle);

        $all = [];

        // Read each row of the CSV and append to $all
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            $all[] = $data;
        }

        // Close the file handle
        fclose($handle);

        // Log CSV data for debugging
        \Log::info('CSV Data: ' . print_r($all, true));

        // Process each row of data
        foreach ($all as $row) {
            if (count($row) >= 4) { // Ensure there are at least 4 columns
                try {
                    $hajjs = new Hajjs();
                    $hajjs->pilgrim_id = $row[0]; // Pilgrim ID
                    $hajjs->national_id_iqama = $row[1]; // National ID/Iqama
                    // Split Name into First and Last
                    list($first_name, $last_name) = explode(' ', $row[2], 2);
                    $hajjs->first_name = $first_name;
                    $hajjs->last_name = $last_name;
                    $hajjs->gender = $row[3]; // Gender (M/F)
                    $hajjs->save();
                } catch (\Exception $e) {
                    \Log::error('Error saving record: ' . $e->getMessage());
                }
            } else {
                \Log::warning('Skipped row due to insufficient columns: ' . print_r($row, true));
            }
        }

        return redirect('/')->with('success', 'CSV file uploaded and processed successfully.');
    }

}
