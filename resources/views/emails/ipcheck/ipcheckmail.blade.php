<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <!--<title>Email Template</title>-->
   </head>
   <body  offset="0" class="body externalClass" style="font-family: sans-serif; padding:0; margin:0; display:block; background:#e8ecf0; -webkit-text-size-adjust:none" bgcolor="#e8ecf0">
      <table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%">
         <tr>
            <td align="center" valign="top" style="background-color:#eeebeb" width="100%">
               
                  <table cellspacing="0" cellpadding="0" width="700" class="w320">
                     <tr>
                        <td align="center" valign="top">
                           <table class="mobile-hide" style="margin:0 auto;" cellspacing="0" cellpadding="0" width="100%">
                              <tr>
                                 <!--<td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>-->
                              </tr>
                              <tr>
                                 <td style="text-align: center; background-color: #fff; padding: 13px;">
                                 </td>
                              </tr>
                           </table>
                           <table cellspacing="0" cellpadding="0" width="100%">
                              <tr>
                                 <td class="hero-bg" style="background: -webkit-linear-gradient(90deg, #2991bf 0%,#7ecaec 100%); background-color: #4baad4;">
                                    <table cellspacing="0" cellpadding="0" width="100%" style="padding: 18px 0px;">
                                       <tr>
                                          <td style="font-size:36px; font-weight: 400; color: #ffffff; text-align:center;">
                                             Welcome to Amb Logistic
                                             <br>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td height="15" style="font-size: 15px; line-height: 15px;">&nbsp;</td>
                                       </tr>
                                       <!--<tr>-->
                                       <!--   <td style="font-size:20px; text-align:center; padding: 0 75px; color:#ffffff;">-->
                                       <!--      Here’s What You Need To Get Started-->
                                       <!--   </td>-->
                                       <!--</tr>-->
                                    </table>
                                 </td>
                              </tr>
                           </table>
                           <table cellspacing="0" cellpadding="0" width="100%">
                                <tr>
                                    <td height="50" style="padding:40px;background-color: #fff;">
                                        <h4 style="font-size: 25px; color: #0273bf;">Dear Admin</h4>
                                        @php
                                			$userid = base64_encode($testMailData['link']); 
                                		@endphp
                                        <p><span style="color:blue;">Verification for ip registration click on "Active Now" button.</span> <sapn style="color:green;"> Login AMB Logistic Successfully.</sapn></p>
                                        
                                        <table style="margin-top:50px; text-align: left;">
                                           <tr>
                                                <th>Email</th>
                                                <th>Ip</th>
                                                <th>Action</th>
                                            </tr>
                                            <tr>
                                                <td style="width:250px;">{{ $testMailData['Email'] }}</td>
                                                <td style="width: 220px;"> {{ $testMailData['Ip'] }}</td>
                                                <td style="width: 150px;"><a style="display: inline-block; margin: 10px 0px; width: fit-content; padding: 1px 6px; background-color: #c1292e; color: #fff; border-radius: 50px; text-decoration: none; font-size: 13px;" href="{{ url('/admin/verifyip').'/'.$userid }}" target="_blank">Active Now</a></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                           </table>
                                    <table style="width: 100%;" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="force-full-width">
                                       <tr>
                                          <td align="center">     
                                       <tr>
                                          <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
                                       </tr>
                                       <tr>
                                          <td align="center">      
                                             <img src="{{url('public/backend/assets/office/email-footer.png')}}" style="display: block; width: 100%" width="100%" border="0" alt=""/>
                                          </td>
                                       </tr>
                                       </td>
                                       </tr>      
                                    </table>

                                    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="4baad4" style="margin-bottom: 25px;">
                                       <tr>
                                          <td align="center">
                                             <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" bgcolor="4baad4">
                                                <tr>
                                                <tr>
                                                   <td height="45" style="font-size: 45px; line-height: 45px;">&nbsp;</td>
                                                </tr>
                                                <td align="center">
                                                   <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" bgcolor="4baad4">
                                                      <tr>
                                                         <td align="center">        
                                                      <tr>
                                                         <td align="center">
                                                             <ul style="color: #fff; margin-bottom: 20px;    display: flex;justify-content: center; column-gap: 40px;">
                                                                 <li style="list-style: none;">Call Support:<br> <a style="color: #fff;text-decoration: none;display: inline-block;margin-top: 6;font-size: 15px;" href="tel:(888) 538-6433">(888) 538-6433</a></li>
                                                                 <li style="list-style: none;">Email Support:<br> <a style="color: #fff;text-decoration: none;display: inline-block;margin-top: 6;font-size: 15px;" href="mailto:info@amblogistic.us" target="_blank">info@amblogistic.us</a></li>
                                                                 <li style="list-style: none;">Website:<br> <a style="color: #fff;text-decoration: none;display: inline-block;margin-top: 6;font-size: 15px;" href="https://www.amblogistic.us/" target="_blank">https://www.amblogistic.us/</a></li>
                                                             </ul>
                                                            <a href="{{url('')}}" border="0" style="text-decoration: none !important; font-size: 18px; font-family: arial, sans-serif; border-style:none; color:#fff;" target="_blank">Need help? We have you covered.</a>
                                                         </td>
                                                      </tr>
                                                      </td>
                                                      </tr>
                                                   </table>
                                                </td>
                                                </tr>
                                                <tr>
                                                   <td height="65" style="font-size: 65px; line-height: 65px;">&nbsp;</td>
                                                </tr>
                                             </table>
                                          </td>
                                       </tr>
                                    </table>
                                 </td>
                              </tr>
                           </table>
                        </td>
                     </tr>
                  </table>
                <center>
                </center>
            </td>
         </tr>
      </table>
   </body>
</html>