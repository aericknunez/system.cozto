<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailCorte{

      
    static public function EnviarCorte(){
    $db = new dbConn();

$r = $db->select("*", "corte_diario", "WHERE edo = 2 and user = '".$_SESSION["user"]."' and td = ".$_SESSION["td"]." order by time desc limit 1");


    if ($_SESSION['config_enviar_email'] == "on") {

         $cuerpo = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
         <html xmlns="http://www.w3.org/1999/xhtml">
           <head>
             <meta name="viewport" content="width=device-width, initial-scale=1.0" />
             <meta name="x-apple-disable-message-reformatting" />
             <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
             <meta name="color-scheme" content="light dark" />
             <meta name="supported-color-schemes" content="light dark" />
             <title>Corte Realizado</title>
             <style type="text/css" rel="stylesheet" media="all">
         
         
             @import url("https://fonts.googleapis.com/css?family=Nunito+Sans:400,700&display=swap");
             body {
               width: 100% !important;
               height: 100%;
               margin: 0;
               -webkit-text-size-adjust: none;
             }
             
             a {
               color: #3869D4;
             }
             
             a img {
               border: none;
             }
             
             td {
               word-break: break-word;
             }
             
             .preheader {
               display: none !important;
               visibility: hidden;
               mso-hide: all;
               font-size: 1px;
               line-height: 1px;
               max-height: 0;
               max-width: 0;
               opacity: 0;
               overflow: hidden;
             }
             /* Type ------------------------------ */
             
             body,
             td,
             th {
               font-family: "Nunito Sans", Helvetica, Arial, sans-serif;
             }
             
             h1 {
               margin-top: 0;
               color: #333333;
               font-size: 22px;
               font-weight: bold;
               text-align: left;
             }
             
             h2 {
               margin-top: 0;
               color: #333333;
               font-size: 16px;
               font-weight: bold;
               text-align: left;
             }
             
             h3 {
               margin-top: 0;
               color: #333333;
               font-size: 14px;
               font-weight: bold;
               text-align: left;
             }
             
             td,
             th {
               font-size: 16px;
             }
             
             p,
             ul,
             ol,
             blockquote {
               margin: .4em 0 1.1875em;
               font-size: 16px;
               line-height: 1.625;
             }
             
             p.sub {
               font-size: 13px;
             }
             /* Utilities ------------------------------ */
             
             .align-right {
               text-align: right;
             }
             
             .align-left {
               text-align: left;
             }
             
             .align-center {
               text-align: center;
             }
             
             .u-margin-bottom-none {
               margin-bottom: 0;
             }
             /* Buttons ------------------------------ */
             
             .button {
               background-color: #3869D4;
               border-top: 10px solid #3869D4;
               border-right: 18px solid #3869D4;
               border-bottom: 10px solid #3869D4;
               border-left: 18px solid #3869D4;
               display: inline-block;
               color: #FFF;
               text-decoration: none;
               border-radius: 3px;
               box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
               -webkit-text-size-adjust: none;
               box-sizing: border-box;
             }
             
             .button--green {
               background-color: #22BC66;
               border-top: 10px solid #22BC66;
               border-right: 18px solid #22BC66;
               border-bottom: 10px solid #22BC66;
               border-left: 18px solid #22BC66;
             }
             
             .button--red {
               background-color: #FF6136;
               border-top: 10px solid #FF6136;
               border-right: 18px solid #FF6136;
               border-bottom: 10px solid #FF6136;
               border-left: 18px solid #FF6136;
             }
             
             @media only screen and (max-width: 500px) {
               .button {
                 width: 100% !important;
                 text-align: center !important;
               }
             }
             /* Attribute list ------------------------------ */
             
             .attributes {
               margin: 0 0 21px;
             }
             
             .attributes_content {
               background-color: #F4F4F7;
               padding: 16px;
             }
             
             .attributes_item {
               padding: 0;
             }
             /* Related Items ------------------------------ */
             
             .related {
               width: 100%;
               margin: 0;
               padding: 25px 0 0 0;
               -premailer-width: 100%;
               -premailer-cellpadding: 0;
               -premailer-cellspacing: 0;
             }
             
             .related_item {
               padding: 10px 0;
               color: #CBCCCF;
               font-size: 15px;
               line-height: 18px;
             }
             
             .related_item-title {
               display: block;
               margin: .5em 0 0;
             }
             
             .related_item-thumb {
               display: block;
               padding-bottom: 10px;
             }
             
             .related_heading {
               border-top: 1px solid #CBCCCF;
               text-align: center;
               padding: 25px 0 10px;
             }
             /* Discount Code ------------------------------ */
             
             .discount {
               width: 100%;
               margin: 0;
               padding: 24px;
               -premailer-width: 100%;
               -premailer-cellpadding: 0;
               -premailer-cellspacing: 0;
               background-color: #F4F4F7;
               border: 2px dashed #CBCCCF;
             }
             
             .discount_heading {
               text-align: center;
             }
             
             .discount_body {
               text-align: center;
               font-size: 15px;
             }
             /* Social Icons ------------------------------ */
             
             .social {
               width: auto;
             }
             
             .social td {
               padding: 0;
               width: auto;
             }
             
             .social_icon {
               height: 20px;
               margin: 0 8px 10px 8px;
               padding: 0;
             }
             /* Data table ------------------------------ */
             
             .purchase {
               width: 100%;
               margin: 0;
               padding: 35px 0;
               -premailer-width: 100%;
               -premailer-cellpadding: 0;
               -premailer-cellspacing: 0;
             }
             
             .purchase_content {
               width: 100%;
               margin: 0;
               padding: 25px 0 0 0;
               -premailer-width: 100%;
               -premailer-cellpadding: 0;
               -premailer-cellspacing: 0;
             }
             
             .purchase_item {
               padding: 10px 0;
               color: #51545E;
               font-size: 15px;
               line-height: 18px;
             }
             
             .purchase_heading {
               padding-bottom: 8px;
               border-bottom: 1px solid #EAEAEC;
             }
             
             .purchase_heading p {
               margin: 0;
               color: #85878E;
               font-size: 12px;
             }
             
             .purchase_footer {
               padding-top: 15px;
               border-top: 1px solid #EAEAEC;
             }
             
             .purchase_total {
               margin: 0;
               text-align: right;
               font-weight: bold;
               color: #333333;
             }
             
             .purchase_total--label {
               padding: 0 15px 0 0;
             }
             
             body {
               background-color: #F2F4F6;
               color: #51545E;
             }
             
             p {
               color: #51545E;
             }
             
             .email-wrapper {
               width: 100%;
               margin: 0;
               padding: 0;
               -premailer-width: 100%;
               -premailer-cellpadding: 0;
               -premailer-cellspacing: 0;
               background-color: #F2F4F6;
             }
             
             .email-content {
               width: 100%;
               margin: 0;
               padding: 0;
               -premailer-width: 100%;
               -premailer-cellpadding: 0;
               -premailer-cellspacing: 0;
             }
             /* Masthead ----------------------- */
             
             .email-masthead {
               padding: 25px 0;
               text-align: center;
             }
             
             .email-masthead_logo {
               width: 94px;
             }
             
             .email-masthead_name {
               font-size: 16px;
               font-weight: bold;
               color: #A8AAAF;
               text-decoration: none;
               text-shadow: 0 1px 0 white;
             }
             /* Body ------------------------------ */
             
             .email-body {
               width: 100%;
               margin: 0;
               padding: 0;
               -premailer-width: 100%;
               -premailer-cellpadding: 0;
               -premailer-cellspacing: 0;
             }
             
             .email-body_inner {
               width: 570px;
               margin: 0 auto;
               padding: 0;
               -premailer-width: 570px;
               -premailer-cellpadding: 0;
               -premailer-cellspacing: 0;
               background-color: #FFFFFF;
             }
             
             .email-footer {
               width: 570px;
               margin: 0 auto;
               padding: 0;
               -premailer-width: 570px;
               -premailer-cellpadding: 0;
               -premailer-cellspacing: 0;
               text-align: center;
             }
             
             .email-footer p {
               color: #A8AAAF;
             }
             
             .body-action {
               width: 100%;
               margin: 30px auto;
               padding: 0;
               -premailer-width: 100%;
               -premailer-cellpadding: 0;
               -premailer-cellspacing: 0;
               text-align: center;
             }
             
             .body-sub {
               margin-top: 25px;
               padding-top: 25px;
               border-top: 1px solid #EAEAEC;
             }
             
             .content-cell {
               padding: 45px;
             }
             /*Media Queries ------------------------------ */
             
             @media only screen and (max-width: 600px) {
               .email-body_inner,
               .email-footer {
                 width: 100% !important;
               }
             }
             
             @media (prefers-color-scheme: dark) {
               body,
               .email-body,
               .email-body_inner,
               .email-content,
               .email-wrapper,
               .email-masthead,
               .email-footer {
                 background-color: #333333 !important;
                 color: #FFF !important;
               }
               p,
               ul,
               ol,
               blockquote,
               h1,
               h2,
               h3,
               span,
               .purchase_item {
                 color: #FFF !important;
               }
               .attributes_content,
               .discount {
                 background-color: #222 !important;
               }
               .email-masthead_name {
                 text-shadow: none !important;
               }
             }
             
             :root {
               color-scheme: light dark;
               supported-color-schemes: light dark;
             }
             </style>
           </head>
           <body>
             <span class="preheader">Esta es una información confidecial, no lo comparta con nadie</span>
             <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
               <tr>
                 <td align="center">
                   <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                     <tr>
                       <td class="email-masthead">
                         <a href="https://example.com" class="f-fallback email-masthead_name">
                         '.$_SESSION['config_cliente'].'
                       </a>
                       </td>
                     </tr>
                     <!-- Email Body -->
                     <tr>
                       <td class="email-body" width="570" cellpadding="0" cellspacing="0">
                         <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                           <!-- Body content -->
                           <tr>
                             <td class="content-cell">
                               <div class="f-fallback">
                                 <h1>Hola '.$_SESSION['config_propietario'].',</h1>
                                 <p>Se ha realizado un nuevo corte de caja.</p>
         
         
                                 <table width="100%" cellpadding="0" cellspacing="0">
                                   <tr>
                                     <td>
                                       <h3>'.Helpers::GetData("login_userdata", "nombre", "user", $r["user"]).'</h3>
                                     </td>
                                     <td>
                                       <h3 class="align-right">'.$r["fecha"].'  '.$r["cierre"].'</h3>
                                     </td>
                                   </tr>
                                 </table>
         
         
         
                                 <table class="attributes" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                   <tr>
                                     <td class="attributes_content">
                                       <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                         <tr>
                                           <td class="attributes_item">
                                             <span class="f-fallback">
                                               <strong>Monto Ingresado:</strong>
                                             </span>
                                           </td>
                                           <td class="attributes_item">
                                             <span class="f-fallback">
                                               <strong>$ '.$r["efectivo_ingresado"].'</strong>
                                             </span>
                                           </td>
                                         </tr>
                                         <tr>
                                           <td class="attributes_item">
                                             <span class="f-fallback">
                                             <strong>Diferencia Efectivo:</strong>
                                           </span>
                                           </td>
                                           <td class="attributes_item">
                                             <span class="f-fallback">
                                               <strong>$ '.$r["diferencia"].'</strong>
                                           </span>
                                           </td>
                                         </tr>
                                       </table>
                                     </td>
                                   </tr>
                                 </table>
                                 <!-- Action -->
                                 <!-- <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                                   <tr>
                                     <td align="center">
                                       <table width="100%" border="0" cellspacing="0" cellpadding="0" role="presentation">
                                         <tr>
                                           <td align="center">
                                             <a href="{{action_url}}" class="f-fallback button button--green" target="_blank">Pay Invoice</a>
                                           </td>
                                         </tr>
                                       </table>
                                     </td>
                                   </tr>
                                 </table> -->
                                 <table width="100%" cellpadding="0" cellspacing="0">
                                   <tr>
                                     <td colspan="2">
                                       <table class="purchase_content" width="100%" cellpadding="0" cellspacing="0">
                                         <tr>
                                           <th class="purchase_heading" align="left">
                                             <p class="f-fallback">Descripción</p>
                                           </th>
                                           <th class="purchase_heading" align="right">
                                             <p class="f-fallback">Monto</p>
                                           </th>
                                         </tr>
           
         
                                         <tr>
                                           <td width="80%" class="purchase_footer" valign="middle">
                                             <p class="f-fallback purchase_total--label">Apertura</p>
                                           </td>
                                           <td width="20%" class="purchase_footer" valign="middle">
                                             <p class="f-fallback purchase_total">'.$r["apertura"].'</p>
                                           </td>
                                         </tr>

                                         
                                         <tr>
                                         <td width="80%" class="purchase_footer" valign="middle">
                                           <p class="f-fallback purchase_total--label">Venta en Efectivo</p>
                                         </td>
                                         <td width="20%" class="purchase_footer" valign="middle">
                                           <p class="f-fallback purchase_total">'.$r["t_efectivo"].'</p>
                                         </td>
                                       </tr>
                                         

                                       <tr>
                                       <td width="80%" class="purchase_footer" valign="middle">
                                         <p class="f-fallback purchase_total--label">Venta con Tarjeta</p>
                                       </td>
                                       <td width="20%" class="purchase_footer" valign="middle">
                                         <p class="f-fallback purchase_total">'.$r["t_tarjeta"].'</p>
                                       </td>
                                     </tr>


                                     <tr>
                                     <td width="80%" class="purchase_footer" valign="middle">
                                       <p class="f-fallback purchase_total--label">Total de Creditos</p>
                                     </td>
                                     <td width="20%" class="purchase_footer" valign="middle">
                                       <p class="f-fallback purchase_total">'.$r["t_credito"].'</p>
                                     </td>
                                   </tr>
         

                                   <tr>
                                   <td width="80%" class="purchase_footer" valign="middle">
                                     <p class="f-fallback purchase_total--label">Total de Venta (sumas)</p>
                                   </td>
                                   <td width="20%" class="purchase_footer" valign="middle">
                                     <p class="f-fallback purchase_total">'.$r["total"].'</p>
                                   </td>
                                 </tr>


                                 <tr>
                                 <td width="80%" class="purchase_footer" valign="middle">
                                   <p class="f-fallback purchase_total--label">Abonos Ingresados</p>
                                 </td>
                                 <td width="20%" class="purchase_footer" valign="middle">
                                   <p class="f-fallback purchase_total">'.$r["abonos"].'</p>
                                 </td>
                               </tr>


                               <tr>
                               <td width="80%" class="purchase_footer" valign="middle">
                                 <p class="f-fallback purchase_total--label">Gastos Realizados</p>
                               </td>
                               <td width="20%" class="purchase_footer" valign="middle">
                                 <p class="f-fallback purchase_total">'.$r["gastos"].'</p>
                               </td>
                             </tr>


                             <tr>
                             <td width="80%" class="purchase_footer" valign="middle">
                               <p class="f-fallback purchase_total--label">Efectivo Inicial</p>
                             </td>
                             <td width="20%" class="purchase_footer" valign="middle">
                               <p class="f-fallback purchase_total">'.$r["efectivo_ingresado"].'</p>
                             </td>
                           </tr>

                           <tr>
                           <td width="80%" class="purchase_footer" valign="middle">
                             <p class="f-fallback purchase_total--label">Diferencia</p>
                           </td>
                           <td width="20%" class="purchase_footer" valign="middle">
                             <p class="f-fallback purchase_total">'.$r["diferencia"].'</p>
                           </td>
                         </tr>






                                       </table>
                                     </td>
                                   </tr>
                                 </table>
         
                                 
                                 <table class="body-sub" role="presentation">
                                   <tr>
                                     <td>
                                       <p class="f-fallback sub">Este mensaje es generado automaticamente</p>
                                     </td>
                                   </tr>
                                 </table>
                               </div>
                             </td>
                           </tr>
                         </table>
                       </td>
                     </tr>
                     <tr>
                       <td>
                         <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                           <tr>
                             <td class="content-cell" align="center">
                               <p class="f-fallback sub align-center">
                                 Powered By: Hibrido. Soluciones Tecnológicas
                               </p>
                             </td>
                           </tr>
                         </table>
                       </td>
                     </tr>
                   </table>
                 </td>
               </tr>
             </table>
           </body>
         </html>';


      $mail = new PHPMailer(true);

      $mail->SMTPOptions = array(
      'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
      )
    );
    //Server settings
    $mail->SMTPDebug = false;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = Encrypt::decrypt('Q0l3ZzlTWWJ5TmNZM2l2TnpxQ2xSUT09', 'https://hibridosv.com');                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'no_reply@hibridosv.com';                     // SMTP username
    $mail->Password   = Encrypt::decrypt('RnhOK3hpcWU2UnpBN2Foc2FKTU93Zz09', 'https://hibridosv.com');                                // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('no_reply@hibridosv.com', 'Hibrido');
    $mail->addAddress($_SESSION['config_email'], $_SESSION['config_propietario']);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "Corte de caja realizado";
    $mail->Body    = $cuerpo;

    if($mail->send()){
    	return TRUE;
    } else {
        return FALSE;
    }

    }

    unset($r);

}



} // class
?>