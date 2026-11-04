
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>New Quote Request - Soft Allure Décor</title>
</head>

<body style="
    margin:0;
    padding:25px 12px;
    background:#faf8f4;
    font-family:Arial,Helvetica,sans-serif;
    color:#24211e;
">

    <div style="
        max-width:650px;
        margin:0 auto;
        background:#ffffff;
        border:1px solid #e8e0d5;
    ">

        <!-- HEADER -->

        <div style="
            padding:28px 30px;
            background:#f6f0e8;
            border-bottom:1px solid #e8e0d5;
        ">

            <h2 style="
                margin:0 0 8px;
                color:#98713b;
                font-size:25px;
            ">
                Soft Allure Décor
            </h2>

            <p style="
                margin:0;
                color:#77716b;
                font-size:14px;
                line-height:1.6;
            ">
                A new quotation request has been
                submitted through the website.
            </p>

        </div>

        <div style="padding:28px 30px;">

            <!-- CUSTOMER DETAILS -->

            <h3 style="
                margin:0 0 16px;
                font-size:18px;
                color:#24211e;
            ">
                Customer Details
            </h3>

            <table role="presentation"
                   width="100%"
                   cellpadding="8"
                   cellspacing="0"
                   style="border-collapse:collapse;font-size:14px;">

                <tr>
                    <td style="width:120px;color:#77716b;">
                        Name
                    </td>

                    <td>
                        <strong>{{ $quote['name'] }}</strong>
                    </td>
                </tr>

                <tr>
                    <td style="color:#77716b;">Email</td>
                    <td>{{ $quote['email'] }}</td>
                </tr>

                <tr>
                    <td style="color:#77716b;">Phone</td>
                    <td>{{ $quote['phone'] }}</td>
                </tr>

                <tr>
                    <td style="color:#77716b;">City</td>

                    <td>
                        {{ $quote['city'] ?? 'Not provided' }}
                    </td>
                </tr>

            </table>

            <hr style="
                border:0;
                border-top:1px solid #eee5da;
                margin:26px 0;
            ">

            <!-- PROJECT DETAILS -->

            <h3 style="
                margin:0 0 16px;
                font-size:18px;
            ">
                Project Details
            </h3>

            <table role="presentation"
                   width="100%"
                   cellpadding="8"
                   cellspacing="0"
                   style="border-collapse:collapse;font-size:14px;">

                <tr>
                    <td style="width:120px;color:#77716b;">
                        Category
                    </td>

                    <td>{{ $quote['category'] }}</td>
                </tr>

                <tr>
                    <td style="color:#77716b;">
                        Quantity
                    </td>

                    <td>
                        {{ $quote['quantity'] ?? 'Not provided' }}
                    </td>
                </tr>

                <tr>
                    <td style="color:#77716b;">
                        Budget
                    </td>

                    <td>
                        {{ $quote['budget'] ?? 'Not provided' }}
                    </td>
                </tr>

                <tr>
                    <td style="color:#77716b;">
                        Timeline
                    </td>

                    <td>
                        {{ $quote['timeline'] ?? 'Not provided' }}
                    </td>
                </tr>

            </table>

            <!-- SELECTED PRODUCTS -->

            @if(!empty($quote['selected_products']))

                <hr style="
                    border:0;
                    border-top:1px solid #eee5da;
                    margin:26px 0;
                ">

                <h3 style="
                    margin:0 0 16px;
                    font-size:18px;
                ">
                    Selected Products
                </h3>

                <table width="100%"
                       cellpadding="10"
                       cellspacing="0"
                       style="
                           border-collapse:collapse;
                           font-size:13px;
                       ">

                    <thead>
                        <tr style="
                            background:#f6f0e8;
                            text-align:left;
                        ">

                            <th style="border:1px solid #e8e0d5;">
                                Product
                            </th>

                            <th style="border:1px solid #e8e0d5;">
                                Category
                            </th>

                            <th style="border:1px solid #e8e0d5;">
                                Qty
                            </th>

                        </tr>
                    </thead>

                    <tbody>

                        @foreach($quote['selected_products'] as $product)

                            <tr>

                                <td style="
                                    border:1px solid #e8e0d5;
                                ">
                                    {{ $product['name'] }}
                                </td>

                                <td style="
                                    border:1px solid #e8e0d5;
                                ">
                                    {{ $product['category'] ?? '-' }}
                                </td>

                                <td style="
                                    border:1px solid #e8e0d5;
                                ">
                                    {{ $product['quantity'] }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            @endif

            <!-- REQUIREMENTS -->

            <hr style="
                border:0;
                border-top:1px solid #eee5da;
                margin:26px 0;
            ">

            <h3 style="
                margin:0 0 14px;
                font-size:18px;
            ">
                Customer Requirements
            </h3>

            <div style="
                padding:16px;
                background:#faf8f4;
                border:1px solid #eee5da;
                line-height:1.7;
                font-size:14px;
                white-space:pre-wrap;
                overflow-wrap:anywhere;
            ">{{ $quote['message'] }}</div>

            <!-- ATTACHMENT -->

            <p style="
                margin-top:24px;
                font-size:12px;
                line-height:1.6;
                color:#77716b;
            ">
                If the customer uploaded a reference file,
                it is attached to this email.
            </p>

        </div>

        <!-- FOOTER -->

        <div style="
            padding:18px 30px;
            background:#f6f0e8;
            border-top:1px solid #e8e0d5;
            text-align:center;
        ">

            <p style="
                margin:0;
                color:#77716b;
                font-size:12px;
            ">
                Soft Allure Décor — Website Enquiry Notification
            </p>

        </div>

    </div>

</body>
</html>
