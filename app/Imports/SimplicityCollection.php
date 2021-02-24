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
                    'internal_case_id' => $row['internal_case_id']
                ],
                [
                    'debtor_company' => $row['debtor_company_name'],
                    'internal_case_id' => $row['internal_case_id'],
                    'internal_debtor_id' => $row['internal_debtor_id'],
                    'case_number' => $row['case_number'],
                ]);
        }
    }

    public function chunkSize(): int
    {
        return 100;
    }

}
