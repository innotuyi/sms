<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Validator;

class SchoolImportController extends Controller
{
    public function showImportForm()
    {
        return view('school.import');
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
                        'school_code' => $cells[0] ?? null,  // Column 1 is school_code
                        'school_name' => $cells[1] ?? null,  // Column 2 is school_name
                        'school_status' => $cells[2] ?? null,  // Column 3 is school_status
                        'school_level' => $cells[3] ?? null,  // Column 4 is school_level
                        'province' => $cells[4] ?? null,     // Column 5 is province
                        'district' => $cells[5] ?? null,     // Column 6 is district
                        'sector' => $cells[6] ?? null,       // Column 7 is sector
                        'grade' => $cells[7] ?? null,        // Column 8 is grade
                        'level' => $cells[8] ?? null,        // Column 9 is level
                        'combination' => $cells[9] ?? null,  // Column 10 is combination
                        'area' => $cells[10] ?? null,        // Column 11 is area
                        'level_status' => $cells[11] ?? null, // Column 12 is level_status
                    ]);
                }
            }
        }

        $reader->close();

        return redirect()->route('school.index')->with('success', 'Schools imported successfully!');
    }
}
