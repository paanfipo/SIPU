<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
      xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <title></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>       
        .logo_inicio{
            width: 300px;
            height: 300px;                
            overflow: hidden;
            margin-left: 130px;               
        }

        .logo_inicio img{
            width: 100%;
            height: 300px;
        }

        .btn-link{
            color: #ffffff;
            background-color: #E03E1D;
            text-decoration: none;
            padding: 10px;
            font-weight: 600;
            font-size: 20px;  
            border-radius: 6px;
            border: 2px solid #ffffff;       
        }

        .btn-link:hover{
            padding: 15px;
            font-size: 25px;
        }       
        
    </style>
</head>

<body style="background: #F4F4F4;color:#FFF;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:16px;">
    <div style="background-color:#F4F4F4;">
        <div style="margin:0px auto;max-width:600px;background:#E03E1D;">
            <table role="presentation" cellpadding="0" cellspacing="0"
                   style="font-size:0px;width:100%;background:#E03E1D;"
                   align="center" border="0">
                <tbody>
                    <tr>
                        <td style="text-align:center;vertical-align:top;direction:ltr;font-size:0px;padding:20px 0px;padding-bottom:0px;padding-top:0px;">
        
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="vertical-align:top;width:600px;">
        
                                        <div class="mj-column-per-100 outlook-group-fix"
                                            style="vertical-align:top;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;">
                                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                <tbody>
                                                <tr>
                                                    <td style="word-wrap:break-word;font-size:0px;padding:10px 25px;padding-top:10px;padding-bottom:10px;padding-right:25px;padding-left:25px;"
                                                        align="center">
                                                        <div class=""
                                                            style="cursor:auto;color:#FFF;font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:17px;line-height:22px;text-align:center;">
                                                            <div class="logo_inicio">
                                                                <img src="{{env('APP_URL_LOGO')}}" alt="Imagotipo">
                                                            </div>
                                                            <p style="font-size:18px; color:white">@yield('title_email','Notificación')</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
        
                                    </td>
                                </tr>
                            </table>
        
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        @yield('content')
    </div>
</body>

</html>