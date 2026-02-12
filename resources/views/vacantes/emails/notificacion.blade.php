@extends('emprendimiento.emails.layouts.app')
@section('title_email','Notificación Modulo Vacantes')
@section('content')

    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center"
           style="width:600px;">
        <tr>
            <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">

                <div style="margin:0px auto;max-width:600px;background:#E03E1D;">
                    <table role="presentation" cellpadding="0" cellspacing="0"
                           style="font-size:0px;width:100%;background:#E03E1D;"
                           align="center" border="0">
                        <tbody>
                            <tr>                          
                                <td style="text-align:center;vertical-align:middle;direction:ltr;font-size:0px;padding:20px 0px;padding-bottom:5px;padding-top:0px;">

                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td style="vertical-align:middle;width:600px;">

                                                <div class="mj-column-per-100 outlook-group-fix"
                                                    style="vertical-align:middle;display:inline-block;direction:ltr;font-size:13px;text-align:left;width:100%;">
                                                    <table role="presentation" cellpadding="0" cellspacing="0" style="vertical-align:middle;"
                                                        width="100%" border="0">
                                                        <tbody>
                                                        <tr>
                                                            <td style="word-wrap:break-word;font-size:0px;padding:10px 25px;padding-top:0px;padding-bottom:0px;padding-right:20px;padding-left:20px;">
                                                                <p style="font-size:1px;margin:0px auto;border-top:2px solid #ffffff;width:100%;"></p>

                                                                <table role="presentation" align="center" border="0" cellpadding="0"
                                                                    cellspacing="0"
                                                                    style="font-size:1px;margin:0px auto;border-top:2px solid #ffffff;width:100%;"
                                                                    width="600">
                                                                    <tr>
                                                                        <td style="height:0;line-height:0;"> </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="word-wrap:break-word;font-size:0px;padding:10px 25px;padding-top:10px;padding-bottom:10px;padding-right:25px;padding-left:25px;" align="center">
                                                                <div class="" style="cursor:auto;color:#FFF;font-family:Helvetica;font-size:13px;line-height:22px;text-align:center;">
                                                                    <div style="font-size:16px;color:#FFF;">
                                                                    <p>@if(isset($item)) {{$item["type"]}} @endif</p>

                                                                        <p><strong>Oferta</strong>: @if(isset($item)) {{$item["oferta"]}} @endif </p>
                                                                        <p><strong>Estado</strong>: @if(isset($item)) {{$item["estado"]}} @endif </p>
                                                                        <p><strong>De</strong>: @if(isset($item)) {{$item["de"]}} @endif</p>
                                                                        <p><strong>Para</strong>: @if(isset($item)) {{$item["para"]}} @endif </p>                                                                        
                                                                        <p><strong>Mensaje</strong>: @if(isset($item)) {{$item["message"]}} @endif </p>
                                                                        <p><strong>Detalle</strong>: @if(isset($item)) {{$item["detalle"]}} @endif </p>
                                                                    </div>
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

            </td>
        </tr>
    </table>

    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="600" align="center"
           style="width:600px;">
        <tr>
            <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"></td>
        </tr>
    </table>

@endsection
