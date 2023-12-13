<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Email Confirmation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        @media screen {
            @font-face {
                font-family: 'Source Sans Pro';
                font-style: normal;
                font-weight: 400;
                src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
            }

            @font-face {
                font-family: 'Source Sans Pro';
                font-style: normal;
                font-weight: 700;
                src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
            }
        }

        body,
        table,
        td,
        a {
            -ms-text-size-adjust: 100%;
            /* 1 */
            -webkit-text-size-adjust: 100%;
            /* 2 */
        }

        /**
   * Remove extra space added to tables and cells in Outlook.
   */
        table,
        td {
            mso-table-rspace: 0pt;
            mso-table-lspace: 0pt;
        }

        /**
   * Better fluid images in Internet Explorer.
   */
        img {
            -ms-interpolation-mode: bicubic;
        }

        /**
   * Remove blue links for iOS devices.
   */
        a[x-apple-data-detectors] {
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            color: inherit !important;
            text-decoration: none !important;
        }

        /**
   * Fix centering issues in Android 4.4.
   */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }

        body {
            width: 100% !important;
            height: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        /**
   * Collapse table borders to avoid space between cells.
   */
        table {
            border-collapse: collapse !important;
        }

        a {
            color: #1a82e2;
        }

        img {
            height: auto;
            line-height: 100%;
            text-decoration: none;
            border: 0;
            outline: none;
        }
    </style>

</head>

<body style="background-color: #e9ecef;">
    <div class="preheader"
        style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
        Pembayaran Pembelian Produk Anda Diterima Oleh Admin
    </div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" bgcolor="#e9ecef">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" valign="top" style="padding: 36px 24px;">
                            <img src="https://i.ibb.co/D57PFQ0/homidesain-closing.png" alt="Homi Desain" border="0"
                                width="48" style="display: block; width: 48px; max-width: 48px; min-width: 48px;">
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" bgcolor="#e9ecef">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="left" bgcolor="#ffffff"
                            style="padding: 36px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;">
                            <h1
                                style="margin: 0; font-size: 28px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">
                                Pembayaran Pembelian Produk Anda Diterima
                            </h1>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" bgcolor="#e9ecef">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="left" bgcolor="#ffffff"
                            style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                            <p style="margin: 0;">
                                Silahkan Download Desain Yang Anda Pesan Di Website Homi Desain
                                <br>
                                Rincian Pembelian :
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" bgcolor="#ffffff"
                            style="font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 1px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px;">
                                        <p style="margin: 0;">
                                            Nama Produk
                                        </p>
                                    </td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 1px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px;">
                                        <p style="margin: 0;">
                                            : {{$details['product']->product_name}}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 1px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px;">
                                        <p style="margin: 0;">
                                            Harga
                                        </p>
                                    </td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 1px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px;">
                                        <p style="margin: 0;">
                                            : Rp. {{number_format($details['product']->price, 0, ',', '.')}}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 1px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px;">
                                        <p style="margin: 0;">
                                            Diskon
                                        </p>
                                    </td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 1px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px;">
                                        <p style="margin: 0;">
                                            : {{$details['product']->discount}}%
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 1px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px;">
                                        <p style="margin: 0;">
                                            Subtotal
                                        </p>
                                    </td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 1px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px;">
                                        <p style="margin: 0;">
                                            : Rp.
                                            {{number_format($details['product']->price -
                                            ($details['product']->discount*$details['product']->price / 100), 0, ',',
                                            '.')}}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 1px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px;">
                                        <p style="margin: 0;">
                                            Status Pembayaran
                                        </p>
                                    </td>
                                    <td align="left" bgcolor="#ffffff"
                                        style="padding: 1px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px;">
                                        <p style="margin: 0;">
                                            : Berhasil
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" bgcolor="#ffffff"
                            style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                            <p style="margin: 0;">
                                Terimakasih Telah Menggunakan Jasa Homi Desain.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" bgcolor="#ffffff"
                            style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px; border-bottom: 3px solid #d4dadf">
                            <p style="margin: 0;">Salam,<br> Homi Desain</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center" bgcolor="#e9ecef" style="padding: 24px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" bgcolor="#e9ecef"
                            style="padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;">
                            <p style="margin: 0;">Homi Desain</p>
                            <p style="margin: 0;">Jl. Banjarmasin No. 2, Antapani Kidul
                                Kec. Antapani, Kota Bandung
                                Jawa Barat, 40291</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>