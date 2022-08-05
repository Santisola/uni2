<?php
/**
 * @var $password
 */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Grids Master Template</title>

    <style type="text/css">
        * {
            font-family: sans-serif;
        }

        /* Outlines the grids, remove when sending */
        /*table td { border: 1px solid cyan; }*/

        /* CLIENT-SPECIFIC STYLES */
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0; mso-table-rspace: 0; line-height: 1.5 }
        img { -ms-interpolation-mode: bicubic; }

        /* RESET STYLES */
        img { border: 0; outline: none; text-decoration: none; }
        table { border-collapse: collapse !important; }
        body { margin: 0 !important; padding: 0 !important; width: 100% !important; }

        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* ANDROID CENTER FIX */
        div[style*="margin: 16px 0;"] { margin: 0 !important; }

        /* MEDIA QUERIES */
        @media all and (max-width:639px){
            .wrapper{ width:320px!important; padding: 0 !important; }
            .container{ width:300px!important;  padding: 0 !important; }
            .mobile{ width:300px!important; display:block!important; padding: 0 !important; }
            .img{ width:100% !important; height:auto !important; }
            *[class="mobileOff"] { width: 0 !important; display: none !important; }
            *[class*="mobileOn"] { display: block !important; max-height:none !important; }
        }

    </style>
</head>
<body style="margin:0; padding:0; background-color:#7C7C7C;">

<span style="display: block; width: 640px !important; max-width: 640px; height: 1px" class="mobileOff"></span>

<center>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#7C7C7C">
        <tr>
            <td align="center" valign="top">

                <table width="640" cellpadding="0" cellspacing="0" border="0" class="wrapper" bgcolor="#FFC800">
                    <tr>
                        <td height="30" style="font-size:10px; line-height:10px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">

                            <table width="600" cellpadding="0" cellspacing="0" border="0" class="container">
                                <tr>
                                    <td align="center" valign="top">
                                        <img width="480" height="162" class="img" src="{{ asset('imgs/logo.png') }}" alt="Unidos logo" style="width: 200px; height: auto">
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                    <tr>
                        <td height="30" style="font-size:10px; line-height:10px;">&nbsp;</td>
                    </tr>
                </table>

                <table width="640" cellpadding="0" cellspacing="0" border="0" class="wrapper" bgcolor="#FFFFFF">
                    <tr>
                        <td height="30" style="font-size:10px; line-height:10px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">

                            <table width="600" cellpadding="0" cellspacing="0" border="0" class="container">
                                <tr>
                                    <td align="center" valign="top" style="font-size: 18px">
                                        Recibimos tu solicitud de recuperación de contraseña y te enviamos esta contraseña provisoria.
                                        <br>No compartas esta información con nadie.
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                    <tr>
                        <td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
                    </tr>
                </table>

                <table width="640" cellpadding="0" cellspacing="0" border="0" class="wrapper" bgcolor="#FFF">
                    <tr>
                        <td height="20" style="font-size:10px; line-height:10px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">

                            <table width="600" cellpadding="0" cellspacing="0" border="0" class="container">
                                <tr>
                                    <td align="center" valign="middle" bgcolor="#5C3AE2" style="padding: 10px 0">
                                        <h2 style="margin: 0 10px; font-weight: bold; color: white">{{ $password }}</h2>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                    <tr>
                        <td height="20" style="font-size:10px; line-height:10px;">&nbsp;</td>
                    </tr>
                </table>

                <table width="640" cellpadding="0" cellspacing="0" border="0" class="wrapper" bgcolor="#FFFFFF">
                    <tr>
                        <td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">

                            <table width="600" cellpadding="0" cellspacing="0" border="0" class="container">
                                <tr>
                                    <td align="left" valign="top" style="font-size: 12px">
                                        Si cree que este mensaje es un error o usted no pidió un cambio de contraseña, por favor verifique la seguridad de su cuenta, podría estar siendo víctima de un ataque cibernético.
                                        <br>
                                        Póngase en contacto con nosotros para brindarle una asistencia y proteger su cuenta.
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                    <tr>
                        <td height="20" style="font-size:10px; line-height:10px;">&nbsp;</td>
                    </tr>
                </table>

                <table width="640" cellpadding="0" cellspacing="0" border="0" class="wrapper" bgcolor="#FFFFFF">
                    <tr>
                        <td height="10" style="font-size:10px; line-height:10px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">

                            <table width="600" cellpadding="0" cellspacing="0" border="0" class="container">
                                <tr>
                                    <td align="left" valign="top" style="font-size: 10px">
                                        <b>Unidos</b> bloqueará su cuenta en el caso de encontrar irregularidades en su usuario y nuestra plataforma debido a las políticas de uso detalladas en
                                        <a href="https://unidos-app.com/" style="color: #222222">https://unidos-app.com/</a> las cuales detallan el correcto uso de nuestras aplicaciones. Por lo tanto, en el caso de haber sufrido un ataque cibernético y su cuenta haya sido bloqueada por precaución o uso indebido por favor comuníquese con nosotros.
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                    <tr>
                        <td height="20" style="font-size:10px; line-height:10px;">&nbsp;</td>
                    </tr>
                </table>

                <table width="640" cellpadding="0" cellspacing="0" border="0" class="wrapper" bgcolor="#222222">
                    <tr>
                        <td height="20" style="font-size:10px; line-height:10px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center" valign="top">

                            <table width="600" cellpadding="0" cellspacing="0" border="0" class="container">
                                <tr>
                                    <td width="120" class="mobile" align="center" valign="top">
                                        <img width="400" height="135" src="{{ asset('imgs/logo-b&w.png') }}" alt="Logo Unidos en blanco y negro" style="width: 100px; height: auto;">
                                    </td>
                                    <td width="120" class="mobile" align="center" valign="middle">

                                    </td>
                                    <td width="120" class="mobile" align="center" valign="middle">
                                        <a href="mailto:info@unidos-app.com" style="text-decoration: none; color: #fff; font-size: 14px;">Contactanos</a>
                                    </td>
                                    <td width="120" class="mobile" align="center" valign="top">

                                    </td>
                                    <td width="120" class="mobile" align="center" valign="top">
                                        <a href="https://www.facebook.com/Unidos-106842428794820/" target="_blank"><img width="32" height="32" src="{{ asset('imgs/facebook.png') }}" alt="facebook"></a>
                                        <a href="https://www.instagram.com/unidos.app/" target="_blank"><img width="32" height="32" src="{{ asset('imgs/ig.png') }}" alt="Instagram"></a>
                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                    <tr>
                        <td height="20" style="font-size:10px; line-height:10px;">&nbsp;</td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>
</center>
</body>
</html>
