<?php

namespace App\Controllers;
use App\Models\M_Mahasiswa;
use Dompdf\Dompdf;
use Dompdf\Options;
require ROOTPATH . 'vendor/autoload.php';
// install phpoffice/phpspreadsheet
// composer require phpoffice/phpspreadsheet

class C_Mahasiswa extends BaseController
{
  public function index()
  {
    $mahasiswa = new M_Mahasiswa();
    $data = [
      'mahasiswa' => $mahasiswa->findAll()
    ];
    return view('V_DataMahasiswa', $data);
  }

  public function import()
  {
    $mahasiswa = new M_Mahasiswa();
    // import file excel
    $file = $this->request->getFile('file_excel');
    $file->move(ROOTPATH . 'public/uploads');
    $nama_file = $file->getName();
    $extension = $file->getClientExtension();
    
    // load library excel
    if ($extension == 'xls') {
      $excelReader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
    } else {
      $excelReader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }

    $loadExcel = $excelReader->load(ROOTPATH . 'public/uploads/' . $nama_file);

    // load sheet yang aktif
    $sheet = $loadExcel->getActiveSheet()->toArray(null, true, true, true);
    
    $mhs = [];
    $numrow = 1;
    foreach ($sheet as $row) {
      // jika $numrow lebih dari 1 (karena tabel xls ada header pada baris 1)
      // maka masukkan data ke database
      if ($numrow > 1) {
        // push (add) array data ke variabel data
        $data = [
          'NIM' => $row['A'],
          'Nama' => $row['B'],
          'Nilai_UTS' => $row['C'],
          'Nilai_UAS' => $row['D'],
        ];
        array_push($mhs, $data);

        $mahasiswa->insert($data);
      }
      $numrow++;
    }

    // hapus file xls yang udah dibaca
    unlink(ROOTPATH . 'public/uploads/' . $nama_file);
    
    return redirect()->to(base_url('mahasiswa'));

  }

  public function exportExcel()
  {
    $mahasiswa = new M_Mahasiswa();
    $data = [
      'mahasiswa' => $mahasiswa->findAll()
    ];

    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A1', 'NIM')
      ->setCellValue('B1', 'Nama')
      ->setCellValue('C1', 'Nilai UTS')
      ->setCellValue('D1', 'Nilai UAS')
      ->setCellValue('E1', 'Nilai Akhir');

    $column = 2;
    foreach ($data['mahasiswa'] as $mhs) {
      $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $column, $mhs['NIM'])
        ->setCellValue('B' . $column, $mhs['Nama'])
        ->setCellValue('C' . $column, $mhs['Nilai_UTS'])
        ->setCellValue('D' . $column, $mhs['Nilai_UAS'])
        ->setCellValue('E' . $column, ($mhs['Nilai_UTS'] + $mhs['Nilai_UAS']) / 2);
      $column++;
    }

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $filename = 'Data Mahasiswa';

    // Mendefinisikan header untuk file excel yang akan di download 
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
    header('Cache-Control: max-age=0');

    // Mendownload file excel
    $writer->save('php://output');
  }

  public function exportPDF()
  {
    $mahasiswa = new M_Mahasiswa();
    $data = [
      'mahasiswa' => $mahasiswa->findAll()
    ];

    // return view('layout/V_PDFDataMahasiswa', $data);

    $options = new Options();
    $options->set('chroot', realpath(''));


    $dompdf = new Dompdf($options);
    // $dompdf->set_option('isHtml5ParserEnabled', true);
    // $dompdf->set_option('isRemoteEnabled', true);

    $dompdf->setOptions($options);
    

    $html = view('layout/V_PDFDataMahasiswa', $data);
    $dompdf->loadHtml($html, 'UTF-8');
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream( 'Data Mahasiswa.pdf', ['Attachment' => false]);

    exit(0);
  }
}