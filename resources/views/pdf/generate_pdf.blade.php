<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css" media="screen">
        thead { display: table-header-group }
        tfoot { display: table-row-group }
        tr,td,th { page-break-inside: avoid;vertical-align: top; }
        @page {
            margin: 0cm;
        }
    </style>
</head>
<body style="width: 100%;padding:0;clear: both;margin: 0px;">
    <table style="width: 100%;padding:0;margin: 0px;border-spacing: 0;">
        <tbody>
            <tr>
                <td style="text-align: center;padding: 10px">
                    <img src="{{ asset('images/Avatar_logo.png') }}" alt="" width="150">
                </td>
            </tr>
            <tr>
                <td>
                    <table style="width: 50%;margin: 0 auto;border: 1px solid #ddd;border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td style="padding: 10px;">Investor Name</td>
                                <td style="padding: 10px;">{{ $data['data']['fullname'] }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px;border-bottom: 1px solid #ddd;">Email</td>
                                <td style="padding: 10px;border-bottom: 1px solid #ddd;">{{ $data['data']['email'] }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center;padding: 10px;border-bottom: 1px solid #ddd;"><strong>Token Purchase Details</strong></td>
                            </tr>
                            <tr>
                                <td style="padding: 10px;">Currency</td>
                                <td style="padding: 10px;">{{ $data['data']['currency'] }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px;border-bottom: 1px solid #ddd;">Amount</td>
                                <td style="padding: 10px;border-bottom: 1px solid #ddd;">{{ $data['data']['amount'] }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center;padding: 10px;border-bottom: 1px solid #ddd;"><strong>Bonus Details</strong></td>
                            </tr>
                            <tr>
                                <td style="padding: 10px;">Bonus</td>
                                <td style="padding: 10px;">{{ $data['data']['bonus'] }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px;">Referral Bonus</td>
                                <td style="padding: 10px;">{{ $data['data']['refferal_bonus'] }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px;border-bottom: 1px solid #ddd;">Total Token</td>
                                <td style="padding: 10px;border-bottom: 1px solid #ddd;">{{ $data['data']['bonus'] }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center;padding: 10px;border-bottom: 1px solid #ddd;"><strong>Token Credited</strong></td>
                            </tr>
                            <tr>
                                <td style="padding: 10px;border-bottom: 1px solid #ddd;">Token</td>
                                <td style="padding: 10px;border-bottom: 1px solid #ddd;">{{ $data['data']['token'] }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="padding: 10px;">Thank you</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

        </tbody>
    </table>
</body>
</html>
