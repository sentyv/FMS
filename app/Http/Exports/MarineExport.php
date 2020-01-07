<?php 
namespace App\Http\Exports;

use App\Models\Maprot\Detail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MarineExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return  Detail::leftjoin('fishers','fishers.id', '=','details.fisher_id')
        ->leftjoin('species','species.id', '=', 'details.species_id')
        ->leftjoin('purposes','purposes.id', '=', 'details.purpose_id')
        ->leftjoin('islands','islands.id', '=', 'fishers.island_id')
        ->leftjoin('preservations','preservations.id', '=', 'details.preservation_id')   
        ->select('islands.island_name','fishers.fisher_first_name','fishers.fisher_last_name','details.weight','species.species_name','purposes.purpose_name','preservations.preservation_name','details.indate')->get();
    }

    public function headings(): array
    {
        return [
            'Island',
            'First Name',
            'Last Name',
             'Weight',  
            'Species Name',
            'Purpose',
            'Preservation',
            'Date',
        ];
    }
}