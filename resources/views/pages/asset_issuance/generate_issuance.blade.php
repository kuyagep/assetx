<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Issuance</title>

    <style>
        * {
            box-sizing: border-box;
        }

        /* Create three equal columns that floats next to each other */
        .column {
            float: left;
            width: 33.33%;
            height: 60px;
            /* Should be removed. Only for demonstration */
        }

        .column1 {
            float: left;
            width: 50%;
            /* height: 60px; */
            /* Should be removed. Only for demonstration */
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }


        h2,
        h4 {
            font-family: 'Times New Roman', Times, serif;
            text-align: center;
            padding: 1px
        }

        table {
            border-collapse: collapse;
        }

        .table-header {
            border: none !important;
        }

        th,
        td {
            border: 1px solid #444;
            padding: 8px;
        }

        th {
            text-align: center;
        }

        td {
            text-align: left;
        }

        .sign {
            text-align: center;
            padding-top: 60px;
            font-weight: 600;
            border-top: none !important;
        }

        .position,
        .date {
            text-align: center;
            padding-top: 25px;
            font-weight: 600;
        }

        .mytable {
            text-align: center;
        }
    </style>
</head>

<body>




    <div class="row">
        <div class="column" style="text-align: center;">
            <img src="https://upload.wikimedia.org/wikipedia/commons/f/fa/Seal_of_the_Department_of_Education_of_the_Philippines.png"
                alt="Logo" srcset="utf-8" style="width:100%; max-width:80px;">
        </div>
        <div class="column">
            <h4>Department of Education <br> Division of Davao del Sur</h4>
        </div>
        <div class="column" style="text-align: center; padding-top: 8px">
            <img src="https://logodix.com/logo/1354867.png" alt="Logo" srcset="utf-8"
                style="width:100%; max-width:100px;">
        </div>
    </div>

    <h2>INVENTORY CUSTODIAN SLIP</h2>





    <div class="row">
        <div class="column1">
            <p>Entity Name: <br>
                Fund Cluster: </p>
        </div>
        <div class="column1" style="text-align: right;">
            <p>ICS NO: <b> {{ $issuance->issuance_code }}</b></p>
        </div>
    </div>

    <table style="width:100%" class="table">
        <tr>
            <th rowspan="2">Quantity</th>
            <th rowspan="2">Unit</th>
            <th colspan="2">Amount</th>
            <th rowspan="2">Description</th>
            <th rowspan="2">Inventory Item No.</th>
            <th rowspan="2">Estimated Useful Life </th>
        </tr>
        <tr>
            <th>Unit Cost</th>
            <th>Total Cost</th>
        </tr>
        @foreach ($asset_issuances as $asset_issuance)
            <tr>
                <td>{{ $asset_issuance->quantity }}</td>
                <td>{{ $asset_issuance->asset->unit_of_measure }}</td>
                <td>{{ number_format($asset_issuance->asset->unit_value, 2, '.', ',') }}</td>
                <td>
                    {{ number_format($asset_issuance->quantity * $asset_issuance->asset->unit_value, 2, '.', ',') }}
                </td>
                <td>{{ $asset_issuance->asset->description }}</td>
                <td></td>
                <td>3 years</td>
            </tr>
        @endforeach

        <tr>
            <td colspan="7">
                Accountability over Semi-expendable Property. Inventory Custodian Slip (ICS) shall be issued to
                end-user of Semi-expendable Property to establish accountability. Accountability shall be
                extinguished upon return of the item to the Asset Management Division (AMD) or in case of loss, upon
                approval of the relief from property accountability.
            </td>
        </tr>
        <tr>
            <td colspan="4">Received from:</td>
            <td colspan="3">Received by:</td>
        </tr>
        <tr>
            <td colspan="4" class="sign" style="width:50%">
                {{ strtoupper($issuance->issuedBy->first_name . ' ' . $issuance->issuedBy->last_name) }}</td>
            <td colspan="3" class="sign" style="width:50%">
                {{ strtoupper($issuance->issuedTo->first_name . ' ' . $issuance->issuedTo->last_name) }}</td>
        </tr>
        <tr>
            <td colspan="4" class="mytable">Signature Over Printed Name</td>
            <td colspan="3" class="mytable">Signature Over Printed Name</td>
        </tr>
        <tr>
            <td colspan="4" class="position">
                {{ $issuance->issuedBy->position->name }}
            </td>
            <td colspan="3" class="position">{{ $issuance->issuedTo->position->name }}</td>
        </tr>
        <tr>
            <td colspan="4" class="mytable">Position/Office</td>
            <td colspan="3" class="mytable">Position/Office</td>
        </tr>
        <tr>
            <td colspan="4" class="date">1/01/2023</td>
            <td colspan="3" class="date">1/01/2023</td>
        </tr>
        <tr>
            <td colspan="4" class="mytable">Date</td>
            <td colspan="3" class="mytable">Date</td>
        </tr>
    </table>
</body>

</html>
