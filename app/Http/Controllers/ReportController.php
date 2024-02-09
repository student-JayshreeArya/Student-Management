<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Auth;
use App\Models\Payment;

class ReportController extends Controller{
    public function report1($pid){
        $payments = Payment::find($pid);
        $pdf = App::make('dompdf.wrapper');
        $print = "<div style='margin:20px; padding:20px;'>";
        $print.= "<h1 align='center'>Payment Receipt </h1>";
        $print.= "<hr/>";
        $print.= "<p> Receipt No : <b>" . $pid . "</b> </p>";
        $print.= "<p> Date : <b>" . $payments->paid_date . "</b> </p>";
        $print.= "<p> Enrollment No : <b>" . $payments->enrollment->enroll_no . "</b> </p>";
        $print.= "<p> Student Name : <b>" . $payments->enrollment->student->name . "</b> </p>";
        $print.= "<hr/>";
        $print.= "<table style='width: 100%;'>";
        $print.= "<tr>";
        $print.= "<td> Description </td>";
        $print.= "<td> Amount </td>";
        $print.= "</tr>";
    
        $print.= "<tr>";
        $print.= "<td> <h3>" . $payments->enrollment->batch->name . "</h3> </td>";
        $print.= "<td> <h3>" . $payments->amount . "</h3> </td>";
        $print.= "</tr>";

        $print.= "</table>";
        $print.= "<hr/>";

        //$print.= "<span> Printed By : <b>" . Auth::user()->name . "</b> </span>";
        $print.= "<span> Printed Date : <b>" . date('Y-m-d') . "</b> </span>";
    
        $print.= "</div>";
        $pdf->loadHTML($print);
        return $pdf->stream();
    }
}
?>