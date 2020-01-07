<?php 
namespace App\Http\Exports;

use App\Models\Fms\File;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FileExport implements FromCollection, WithHeadings
{
    public function collection()
    {
            return File::leftjoin('references','references.id', '=','files.file_reference_id')
            ->leftjoin('publishers','publishers.id', '=', 'files.file_publisher_id')
            ->select('files.id','files.file_subject_title','files.file_author_name','publishers.publisher_name','references.folder_name','references.reference_code','files.file_published_date','files.file_received_date')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Subject',
            'Author Name',
            'Publisher Name',
            'Folder Name',
            'Reference Code',
            'Publication Date',
            'Receivied Date',
        ];
    }
}