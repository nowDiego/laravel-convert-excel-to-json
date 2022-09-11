<?php

namespace App\Http\Controllers;

use App\Events\ChannelExcelImport;
use App\Imports\ExcelImport;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\Excel as ExcelModel;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\HeadingRowImport;

class ExcelController extends Controller
{
  
    public function index(){

        return View('excel.index');

    }


    public function store(Request $request) 
    {
        $file = $request->file('file');

        ExcelModel::query()->truncate();
       
        $heading = $this->getHeading($file);
    
        Excel::queueImport(new ExcelImport($heading), $file);

        return view('excel.load');
        
    }


    private function getHeading($file){

        $headings = (new HeadingRowImport)->toArray($file);
        $value = ''; 

        foreach ($headings as $key => $value1) {      
            foreach ($value1 as $key => $value2) {    
                 $value = $value2;             
            }    
           }

           $result = explode(",",implode(",",$value));;

           return $result;
    }

    public function download($filename){

       return  Storage::download($filename);
    }


   
    

}
