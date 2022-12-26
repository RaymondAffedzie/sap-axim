<?php
include_once('../config/security.php');

require_once '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;


if (isset($_POST['export_excel_btn'])) {
    $file_ext_name = $_POST['export_file_type'];
    $filename = 'members-sheet';
    $query = "SELECT `Id`, `Init`, `Reg_year`, `Firstname`, `Sur_name`, `Other_name`,
     `Sex`, `Birth_Date`, `Birth_Place`, `Birth_Region`, `Birth_District` FROM `members`";
    $query_run = mysqli_query($connection, $query);

    if (mysqli_num_rows($query_run) > 0) {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Member ID');
        $sheet->setCellValue('B1', 'Full name');
        $sheet->setCellValue('C1', 'Sex');
        $sheet->setCellValue('D1', 'Date of birth');
        $sheet->setCellValue('E1', 'Place of birth');
        $sheet->setCellValue('F1', 'Birth region');
        $sheet->setCellValue('G1', 'Birth district');

        $counter = 2;
        foreach ($query_run as $data) {
            $sheet->setCellValue('A'.$counter, $data['Init'].$data['Reg_year'].$data['Id']);
            $sheet->setCellValue('B'.$counter, $data['Firstname']." ".$data['Other_name']." ".$data['Sur_name']);
            $sheet->setCellValue('C'.$counter, $data['Sex']);
            $sheet->setCellValue('C'.$counter, $data['Birth_Date']);
            $sheet->setCellValue('E'.$counter, $data['Birth_Place']);
            $sheet->setCellValue('F'.$counter, $data['Birth_Region']);
            $sheet->setCellValue('G'.$counter, $data['Birth_District']);
            $counter++;
        }

        if ($file_ext_name == 'xlsx') {
            $writer = new Xlsx($spreadsheet);
            $final_filename = $filename.'.xlsx';
        } elseif ($file_ext_name == 'xls') {
            $writer = new Xls($spreadsheet);
            $final_filename = $filename.'.xls';
        } elseif ($file_ext_name == 'csv') {
            $writer = new Csv($spreadsheet);
            $final_filename = $filename.'.csv';
        }
        // $writer->save($final_filename);
        
        header('content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('content-Disposition: attactment; filename="'.urlencode($final_filename).'"');
        $writer->save('php://output');

    } else {
        $_SESSION['neutral'] = "No records found";
        header('Location: ../view-members.php');
    }
}