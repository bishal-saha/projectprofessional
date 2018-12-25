<?php
/**
 * Created by PhpStorm.
 * User: bishal
 * Date: 17/10/18
 * Time: 8:01 AM
 */

namespace App\Exports;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

abstract class ExportManager
    implements FromQuery, WithStrictNullComparison, Responsable, WithHeadings
{
    use Exportable;

    public function getFileName($filename, $type = null) {
        $path_info = pathinfo($filename);

        if ($type) {
            $fileName = $path_info['filename'].'.'.$type;
        }

        return $fileName;
    }


    /**
     * @return Builder
     */
    abstract public function query();

    /**
     * @return array
     */
    abstract public function headings(): array;
}