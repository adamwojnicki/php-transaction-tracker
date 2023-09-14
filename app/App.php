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
            [$date, $check_id, $description, $amount] = $line;
            $amount = str_replace([',', '$'], '', $amount);
            $row = [
                'date' => $date,
                'check_id' => $check_id,
                'description' => $description,
                'amount' => $amount
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
        $amount_class = $row['amount'] < 0 ? 'expense' : 'income';
        $formatted_amount = format_dollar_amount($row['amount']);
        $formatted_date = format_date($row['date']);
        $html_sgl_row = <<<HTML
            <tr>
                <td>$formatted_date</td>    
                <td>$row[check_id]</td>    
                <td>$row[description]</td>    
                <td class=$amount_class>$formatted_amount</td>    
            </tr>
        HTML;
        $html_rows .= $html_sgl_row;
    }
    return $html_rows;
}

function calculate_totals(array $arr): array
{
    $amounts = array_map(fn ($row) => floatval($row['amount']), $arr);
    $incomes = (float) 0;
    $expenses = (float) 0;
    foreach ($amounts as $amount) {
        $amount < 0 ? $expenses -= $amount : $incomes += $amount;
    }
    return [
        'incomes' => $incomes,
        'expenses' => $expenses,
        'net_total' => $incomes - $expenses
    ];
}


$file_paths = get_csv_filepaths();
$data_array = csv_to_array($file_paths);
$httable = array_to_html($data_array);

$totals = calculate_totals($data_array);
