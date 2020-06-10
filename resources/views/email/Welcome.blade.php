<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <title></title> <!-- The title tag shows in email notifications, like Android 4.4. -->
    <link href="https%3A%2F%2Ffonts.googleapis.com%2Fcss%3Ffamily%3DPoppins%26display%3Dswap" rel="stylesheet">

    <!-- CSS Reset -->
    <style type="text/css">

        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 3% auto;
            padding: 0 ;
            height: 100% ;
            width: 100% ;
            font-family: 'Poppins', sans-serif;
            background-color: #ededed;
        }

        @media only screen and (max-width: 992px){
            .container{
                width: 95% !important;
            }
        }
        .container{
            width: 70%;
            background: #fff;
            overflow: hidden;
            margin-left: auto;
            margin-right: auto;
            border-radius: 5px;
            box-shadow: 0 0 43px 0 #6E6E6E;
            border: solid 1px #6E6E6E;
        }

        .text{
            padding-left: 5%;
            padding-right: 5%;
            font-size: 20px;
        }

        .banners{
            padding: 3%
        }

        .banner-title{
            display: flex;
            justify-content: center;
            margin-left: auto;
            margin-right: auto;

        }

        .banner-logos{
            display: flex;
            justify-content: center;
        }

        .banner-img{
            width: 25%;
            margin-top: auto;
            padding-left: 12.5%;
            padding-right: 12.5%;
            margin-bottom: auto;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        /* What it does: Fixes webkit padding issue. Fix for Yahoo mail table alignment bug. Applies table-layout to the first 2 tables then removes for anything nested deeper. */
        table {
            border-spacing: 0;
            border-collapse: collapse;
            table-layout: fixed;
            Margin: 0 auto;
        }
        table table table {
            table-layout: auto;
        }

        /* What it does: A work-around for iOS meddling in triggered links. */
        .mobile-link--footer a,
        a[x-apple-data-detectors] {
            color:inherit;
            text-decoration: underline;
        }
        .header-img{
            padding: 15%;
            background-color: #28323C;
        }

    </style>

</head>
<body>
<div class="container">

    <section class="header-img">
        <img src="" width="600" height="" alt="alt_text" border="0" align="center" style="width: 100%;">
    </section>

    <section class="text">
        <p>
            <br>
            <br>
            {{ $data->getName() }}!<br/><br/> {{ $data->getMessage() }}
        </p>
    </section>


    <section class="banners">
        <div class="banner-title">
            <h4>Powered By</h4>
        </div>

        <div class="banner-logos">

            <div class="banner-img">
                <img src="" width="90%">
            </div>
            <div class="banner-img">
                <img src="" width="90%">
            </div>
        </div>
    </section>

</div>
<!-- Email Footer : BEGIN -->
<table cellspacing="0" cellpadding="0" border="0" align="center" width="100%">
    <tr>
        <td style="padding: 40px 10px;width: 100%;font-size: 12px; mso-height-rule: exactly; line-height:18px; text-align: center; color: #6E6E6E;">
            Zeep Commerce <br>
            <span class="mobile-link--footer"></span>
            <br>
            <span class="mobile-link--footer">info@zeepcommerce.com</span>
        </td>
    </tr>
</table>
<!-- Email Footer : END -->

<!--[if (gte mso 9)|(IE)]>
</td>
</tr>
</table>
<![endif]-->

</body>
</html>
