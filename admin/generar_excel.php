<?php
include("dbconnection.php");
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



$mes = date("m");  
$año = date("Y");  

$fecha_encabezado = date("d-m-Y");  

$nombre_archivo = "REPORTE-" . date("d-m-Y") . "-TICKETS.xlsx";

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();

$styleHeader = [
    'font' => [
        'bold' => true,
        'color' => ['rgb' => 'FFFFFF'], 
    ],
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => ['rgb' => '294365'],
    ],
];

$sheet->getStyle('A2:H2')->applyFromArray($styleHeader);

$spreadsheet->getActiveSheet()->setCellValue('A1', "Reporte de tickets al  $fecha_encabezado");
$spreadsheet->getActiveSheet()->mergeCells('A1:G1');

$dimension = $sheet->getRowDimension(1);
$dimension->setRowHeight(60);
$style = $sheet->getStyle('A1');
$style->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$style->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$style->getFont()->setBold(true);
$style->getFont()->setSize(18); 

$sheet->setCellValue('A2', 'id');
$sheet->setCellValue('B2', 'Asunto');
$sheet->setCellValue('C2', 'Descripción');
$sheet->setCellValue('D2', 'Estatus');
$sheet->setCellValue('E2', 'Fecha de creación');
$sheet->setCellValue('F2', 'Fecha de cierre');
$sheet->setCellValue('G2', 'Area solicitante');
$sheet->setCellValue('H2', 'Area de atención');


$report = mysqli_query($con, "SELECT id, subject, ticket, status, posting_date, closing_date, area, COALESCE(area_asig, 'TI') AS area_asig FROM ticket WHERE MONTH(posting_date) = $mes AND YEAR(posting_date) = $año");

$row = 3; 
while ($fila = mysqli_fetch_assoc($report)) {
    $sheet->setCellValue('A' . $row, $fila['id']);
    $sheet->setCellValue('B' . $row, $fila['subject']);
    $sheet->setCellValue('C' . $row, $fila['ticket']);
    $sheet->getStyle('C' . $row)->getAlignment()->setWrapText(true);
    $sheet->setCellValue('D' . $row, $fila['status']);
    $sheet->setCellValue('E' . $row, $fila['posting_date']);
    $sheet->setCellValue('F' . $row, $fila['closing_date']);
    $sheet->setCellValue('G' . $row, $fila['area']);
    $sheet->setCellValue('H' . $row, $fila['area_asig']);
    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['rgb' => '294365'], 
            ],
        ],
    ];
    $sheet->getStyle('A' . $row . ':H' . $row)->applyFromArray($styleArray);
    $row++;
    
}

$lastColumn = $sheet->getHighestColumn();
$sheet->getColumnDimension('A')->setWidth(5);
$sheet->getColumnDimension('B')->setWidth(33);
$sheet->getColumnDimension('C')->setWidth(43); 
$sheet->getColumnDimension('D')->setWidth(12); 
$sheet->getColumnDimension('E')->setWidth(20); 
$sheet->getColumnDimension('F')->setWidth(20); 
$sheet->getColumnDimension('G')->setWidth(23);
$sheet->getColumnDimension('H')->setWidth(22);
$sheet->setAutoFilter("A2:$lastColumn$row");

$logoPath = './img/Logo.png'; 
$logoDrawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$logoDrawing->setName('Logo');
$logoDrawing->setDescription('IVRA');
$logoDrawing->setPath($logoPath);
$logoDrawing->setOffsetX(10); 
$logoDrawing->setOffsetY(10); 
$logoDrawing->setCoordinates('H1'); 
$logoDrawing->setHeight(60); 
$logoDrawing->setWorksheet($spreadsheet->getActiveSheet());

$writer = new Xlsx($spreadsheet);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $nombre_archivo . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
?>
