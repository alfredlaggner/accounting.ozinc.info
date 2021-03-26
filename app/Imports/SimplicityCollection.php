<?php

namespace App\Imports;

use App\Models\Simplicity;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue;

class SimplicityCollection implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {

            Simplicity::updateOrCreate(
                [
                    'license' => $row['license']
                ],
                [
                    'debtor_company' => $row['debtor_company_name'],
                    'internal_debtor_id' => $row['internal_debtor_id'],
                    'license' => $row['license']
                ]);

        }
    }

    public function chunkSize(): int
    {
        return 100;
    }

}
