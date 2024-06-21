<?php
namespace controller;

use model\Model;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use core\Request;

class ReportsController {
    private $model;

    public function __construct() {
        $this->model = new Model();
    }

    public function export_all_progress_as_excel() {
        $progress = $this->model->get_progress();
        $data = $progress['response'];

        if (!is_array($data)) {
            Request::send_response(400, ['error' => 'Invalid data format']);
            return;
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the headers
        $sheet->setCellValue('A1', 'Participant');
        $sheet->setCellValue('B1', 'Gender');
        $sheet->setCellValue('C1', 'Event Title');
        $sheet->setCellValue('D1', 'Lesson Name');
        $sheet->setCellValue('E1', 'Skills Attained');
        $sheet->setCellValue('F1', 'HIV Status');
        $sheet->setCellValue('G1', 'Self Sufficiency');
        $sheet->setCellValue('H1', 'Date Attended');

        // Populate the data
        $rowNumber = 2;
        $serialNumber = 1;
        foreach ($data as $row) {
            $sheet->setCellValue('A' . $rowNumber, $row['name']);
            $sheet->setCellValue('B' . $rowNumber, $row['gender']);
            $sheet->setCellValue('C' . $rowNumber, $row['title']);
            $sheet->setCellValue('D' . $rowNumber, $row['lesson_name']);
            $sheet->setCellValue('E' . $rowNumber, strip_tags($row['skills_attained'])); // Strip HTML tags
            $sheet->setCellValue('F' . $rowNumber, $row['hiv_status_check']);
            $sheet->setCellValue('G' . $rowNumber, $row['self_sufficiency_check']);
            $sheet->setCellValue('H' . $rowNumber, $row['date_attended']);
            $rowNumber++;
            $serialNumber++;
        }

        // Write to a temporary file
        $tempFilePath = tempnam(sys_get_temp_dir(), 'progress_report');
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFilePath);

        // Send the file as a response
        Request::send_file_response(200, $tempFilePath, 'progress_report.xlsx');

        // Clean up the temporary file
        unlink($tempFilePath);
    }
}

?>