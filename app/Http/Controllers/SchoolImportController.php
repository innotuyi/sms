<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School; // Assuming you have the School model
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory; // Use the updated Spout Reader
use Validator;

class SchoolImportController extends Controller
{
    public function showImportForm()
    {
        return view('school.import'); // A view with the import form
    }

    public function import(Request $request)
    {
        // Validate that the uploaded file is a valid Excel file
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle file import
        $file = $request->file('file');

        // Create a reader instance
        $reader = ReaderEntityFactory::createXLSXReader(); // For XLSX files (use createCSVReader() for CSVs)
        $reader->open($file->getPathname());

        // Iterate through the rows and insert into the database
        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $row) {
                $cells = $row->toArray(); // Convert row to an array of cell values

                // Ensure that the row has the necessary columns
                if (count($cells) >= 4) {
                    School::create([
                        'school_code' => $cells[0] ?? null,  // Assuming column 1 is school_code
                        'school_name' => $cells[1] ?? null,  // Assuming column 2 is school_name
                        'school_status' => $cells[2] ?? null,     // Assuming column 3 is province
                        'school_level' => $cells[3] ?? null,     // Assuming column 4 is district
                        'province' => $cells[4] ?? null,     // Assuming column 4 is district
                        'district' => $cells[5] ?? null,     // Assuming column 4 is district
                        'sector' => $cells[6] ?? null,  
                        'grade' => $cells[7] ?? null,  
                        'level' => $cells[8] ?? null,  
                        'trade' => $cells[9] ?? null,  
                        'combination' => $cells[10] ?? null,  
                        'area' => $cells[11] ?? null,  
                        // Add other columns as necessary
                    ]);
                }
            }
        }

        $reader->close();

        return redirect()->route('school.index')->with('success', 'Schools imported successfully!');
    }
}
