<?php

namespace App\Imports;

use App\Models\Excel;
use App\Events\ChannelExcelImport;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

class ExcelImport implements ToModel,WithStartRow,ShouldQueue,WithChunkReading,WithHeadingRow,WithEvents
{

    use Importable,RegistersEventListeners;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $heading ;

    public function __construct($heading)
    {
     $this->heading = $heading;
    }

    public function model(array $row)
    {
        $data = [];    
              
        foreach ($this->heading as $value) {
            
            $data[$value] = $row[$value];           
             
        }
               

        return new Excel([
            'row' => json_encode($data),  
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function startRow(): int
    {
        return 2;
    }

    public static function afterImport(AfterImport $event)
    {
        $filename = "exceljson.json";

        if (Storage::disk('local')->exists($filename)) {
            Storage::delete($filename);
        }

        $result = Excel::get();
        Storage::prepend($filename, $result );

        $url = "/download/$filename";
        $status = true;
      
        Event::dispatch(new ChannelExcelImport($status,$url));
    }

}
