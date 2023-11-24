<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;
use App\Models\WarehousePlace;
use PDF;


class LabelController extends Controller
{

    private $label = array('111354' => array(
        'width' => 57,
        'height' => 32,
        'posY' => 1,
        'posX' => 0
    ));


    public function createLabel($barcode)
    {

        $twpId = $barcode;
        $label = $this->label['111354'];
        $style = array();
        PDF::SetHeaderMargin(0);
        PDF::SetMargins(0, 0, 0);
        PDF::SetAutoPageBreak(false, 0);
        PDF::AddPage('L', [$label['height'], $label['width']]);
        //write2DBarcode($code, $type, $x=null, $y=null, $w=null, $h=null, $style=array(), $align='', $distort=false
        PDF::write2DBarcode($twpId, 'QRCODE,Q', 0 + $label['posY'], $label['posX'], 28, 28, $style, 'N');
        PDF::SetFontSize(28);
        //MultiCell($w, $h, $txt, $border=0, $align='J', $fill=false, $ln=1, $x=null, $y=null, $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false
        PDF::MultiCell(25, 15, "TWP", 1, 'R', 0, 0, 29 + $label['posY'], 0 + $label['posX'], false, 0, false, false, 24);
        PDF::SetFontSize(26);
        PDF::MultiCell(25, 15, "9999", 1, 'R', 0, 0, 29 + $label['posY'], 15 + $label['posX'], false, 0, false, false, 24);

        PDF::arrow(40, 0, 40, 30, $headStyle = 2, $armSize = 30, $armAngle = 15);
        // PDF::Cell(50, 6, 'Lagerpl. öffnen', null, '', 'C');
        PDF::output();
    }

    public function createLabel2($barcode)
    {

        $twpId = $barcode;
        $label = $this->label['111354'];
        $style = array();
        PDF::SetHeaderMargin(0);
        PDF::SetMargins(0, 0, 0);
        PDF::SetAutoPageBreak(false, 0);
        PDF::AddPage('L', [$label['height'], $label['width']]);
        //write2DBarcode($code, $type, $x=null, $y=null, $w=null, $h=null, $style=array(), $align='', $distort=false
        // PDF::write2DBarcode($twpId, 'QRCODE,Q', 0 + $label['posY'], $label['posX'], 28, 28, $style, 'N');
        //TCPDF::write1DBarcode( $code,  $type,  $x = '',  $y = '',  $w = '',  $h = '',  $xres = '',  $style = array(),  $align = '' )
        PDF::write1DBarcode($twpId, 'C128', 0, '0', 55, 10, '', $style, 'N');
        PDF::SetFontSize(10);
        // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=false, $ln=1, $x=null, $y=null, $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0, $valign='T', $fitcell=false
        PDF::MultiCell(30, 25, $twpId, 1, 'R', 0, 0, 0 + $label['posY'], 15 + $label['posX'], false, 0, false, false, 24);
        // PDF::arrow(45, 10, 45, 40, $headStyle = 2, $armSize = 20, $armAngle = 15);
        // PDF::MultiCell(25, 15, "9999", 1, 'R', 0, 0, 29 + $label['posY'], 15 + $label['posX'], false, 0, false, false, 24);
        // PDF::Cell(50, 6, 'Lagerpl. öffnen', null, '', 'C');
        PDF::output();
    }
}
