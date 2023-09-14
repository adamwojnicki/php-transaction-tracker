<!DOCTYPE html>
<html>

<head>
    <title>Transactions</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        table tr th,
        table tr td {
            padding: 5px;
            border: 1px #eee solid;
        }

        tfoot tr th,
        tfoot tr td {
            font-size: 20px;
        }

        tfoot tr th {
            text-align: right;
        }

        .income {
            color: green;
        }

        .expense {
            color: red;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Check #</th>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <!-- YOUR CODE -->
            <?= $httable ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Total Income:</th>
                <td><?= format_dollar_amount($totals['incomes']) ?></td>
            </tr>
            <tr>
                <th colspan="3">Total Expense:</th>
                <td><?= format_dollar_amount($totals['expenses']) ?></td>
            </tr>
            <tr>
                <th colspan="3">Net Total:</th>
                <td><?= format_dollar_amount($totals['net_total']) ?></td>
            </tr>
        </tfoot>
    </table>
</body>

</html>