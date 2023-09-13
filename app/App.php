<?php

declare(strict_types=1);

function get_csv_filepaths(): array
{
    $files = scandir(FILES_PATH);
    $csv_files = [];
    foreach ($files as $filename) {
        if (is_file(FILES_PATH . $filename) && str_ends_with($filename, '.csv')) {
            array_push($csv_files, FILES_PATH . $filename);
        }
    }
    return $csv_files;
}

function csv_to_array(array $csvs): array
{
    $data_array = [];
    foreach ($csvs as $document) {
        $current_file = fopen($document, 'r');
        while (($line = fgetcsv($current_file)) !== false) {
            $row = [
                'date' => $line[0],
                'check_id' => $line[1],
                'description' => $line[2],
                'amount' => $line[3]
            ];
            array_push($data_array, $row);
        }
    }
    array_shift($data_array);
    return $data_array;
}

function array_to_html(array $arr): string
{
    $html_rows = "";
    foreach ($arr as $row) {
        $html_sgl_row = <<<HTML
            <tr>
                <td>$row[date]</td>    
                <td>$row[check_id]</td>    
                <td>$row[description]</td>    
                <td>$row[amount]</td>    
            </tr>
        HTML;
        $html_rows .= $html_sgl_row;
    }
    return $html_rows;
}

function calculate_total_income(array $arr): int
{
    $total = 0;
    return $total;
}

$file_paths = get_csv_filepaths();
$data_array = csv_to_array($file_paths);
$httab = array_to_html($data_array);

// 4. COUNT TOTAL EXPENSE
// 5. COUNT NET TOTAL
