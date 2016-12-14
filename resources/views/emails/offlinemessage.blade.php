<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
    <table width="300" style="border-collapse: collapse; border-spacing: 0;background-color: #F0F8FA; padding: 0;border-radius: 20px;" border="0" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td width="100%">
          <!-- Start of preheader -->
          <table width="100%" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="preheader" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;margin:0;padding:0;width:100% !important;line-height:0px !important;border-radius: 20px;">
            <tbody>
              <tr>
                <td style="border-collapse:collapse">
                  <table width="640px"  bgcolor="#f0f8fa"  cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt">
                    <tbody>
                      <tr>
                        <td width="100%" style="border-collapse:collapse">
                          <table width="640px" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt">
                            <tbody>
                              <!-- Spacing -->
                              {{-- <tr>
                                <td width="100%" height="20" style="border-collapse:collapse"></td>
                              </tr> --}}
                              <tr>
                                <td align="center" width="100%" height="40" style="border-collapse:collapse"><img src="{{ asset('/img/inner_logo.png') }}" width="150"></td>
                              </tr>
                              <!-- Spacing -->
                                {{-- <tr>
                                <td width="100%" height="40" style="border-collapse:collapse"></td>
                              </tr> --}}
                              <!-- Spacing -->
                            </tbody>
                          </table>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
            </tbody>
          </table>

          <!--middle-->
          <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;margin:0;padding:0; width:100% !important;line-height:auto !important" st-sortable="full-text" id="backgroundTable">
            <tbody>
              <tr>
                <td style="border-collapse:collapse">
                  <table bgcolor="#f0f8fa"  width="640px" cellspacing="0" cellpadding="0" border="0" align="center" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt" class="devicewidth">
                    <tbody>
                      <tr>
                        <td width="100%" style="border-collapse:collapse">
                          <table width="640pxpx" cellspacing="0" cellpadding="0" border="0" align="center" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt" class="devicewidth">
                            <tbody>
                              <tr>
                                <td style="border-collapse:collapse">
                                  <table width="640px" cellspacing="0" cellpadding="0" class="devicewidth" border="0" align="center" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt" class="devicewidthinner">
                                    <tbody>
                                      <!-- Title -->
                                      <tr>
                                        <td st-title="fulltext-heading" style="border-collapse:collapse;font-family: Helvetica, arial, sans-serif; font-size:18px; color: #333333; text-align:center; line-height: 30px;">
                                          You have received a new message!
                                        </td>
                                      </tr>
                                      <!-- End of Title -->
                                      <!-- spacing -->
                                      <tr>
                                        <td width="100%" height="35" style="border-collapse:collapse;font-size:1px; line-height:1px; mso-line-height-rule: exactly;">&nbsp;</td>
                                      </tr>
                                      <!-- End of spacing -->
                                      <!-- content -->
                                      <tr>
                                        <td st-content="fulltext-content" style="border-collapse:collapse;font-family: Helvetica, arial, sans-serif; font-size: 14px; color: #666666; text-align:center;">
                                          <!--box content-->
                                          <table width="100%" cellspacing="0" cellpadding="0" border="0" >
                                            <tr>
                                              <td width="161" align="right"> &nbsp;  </td>
                                              <td width="317" align="center" valign="bottom" style="line-height:0px !important;"><img style="display:block;" src="{{ asset('/img/box-top-img.png') }}"  alt="Flying Chalks"></td>
                                              <td width="161" align="right"> &nbsp; </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td height="163" st-content="fulltext-content" style="border-collapse:collapse;font-family: Helvetica, arial, sans-serif; font-size: 16px; color: #666666; text-align:center;">
                                          <!--box content-->
                                          <table width="100%" cellspacing="0" cellpadding="0" border="0" height="163" >
                                            <tr>
                                              <td align="right"  height="163">  <img style="display:block;" src="{{ asset('/img/box-line-lft.png') }}"  alt="Flying Chalks"></td>
                                              <td width="307" bgcolor="#ffffff" height="163" valign="top" style="line-height:25px !important; letter-spacing:0px; word-spacing:3px;">
                                                <p style="padding:0 5px; color:#000000; margin:0px; word-break:break-all; font-size:20px; text-align:center;">
                                                  <?php
                                                  $string = strip_tags($data['message']);
                                                  if (strlen($string) > 120) {
                                                  // truncate string
                                                  $stringCut = substr($string, 0, 120);
                                                  // make sure it ends in a word so assassinate doesn't become ass...
                                                  $string = $stringCut.'...';
                                                  }
                                                  echo $string;
                                                  ?>
                                                </p></td>
                                                <td  align="left" height="163"> <img style="display:block;" src="{{ asset('/img/box-line-rgt.png') }}"  alt="Flying Chalks"></td>
                                              </tr>
                                            </table>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td st-content="fulltext-content" style="border-collapse:collapse;font-family: Helvetica, arial, sans-serif; font-size: 16px; color: #666666; text-align:center;">
                                            <table width="100%" cellspacing="0" cellpadding="0" border="0" >
                                              <tr align="top" valign="top" >
                                                <td colspan="3" align="center" style="display:block;"><img src="{{ asset('/img/box-bot-img.png') }}" alt="Flying Chalks"></td>
                                              </tr>
                                            </table>
                                            <!--/box content-->
                                          </td>
                                        </tr>
                                        <!-- End of content -->
                                      </tbody>
                                    </table>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
            <!--middle-->
            <!--Reply End-->
            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;margin:0;padding:0;width:100% !important;line-height:100% !important" st-sortable="preheader" id="backgroundTable">
              <tbody>
                <tr>
                  <td style="border-collapse:collapse">
                    <table width="640px" cellspacing="0" cellpadding="0" border="0" bgcolor="#f0f8fa" align="center" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt" class="devicewidth">
                      <tbody>
                        <tr>
                          <td width="100%" style="border-collapse:collapse">
                            <table width="640px" cellspacing="0" cellpadding="0" border="0" align="center" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt" class="devicewidth">
                              <tbody>
                                <!-- Spacing -->
                                <tr>
                                  <td width="100%" height="20" style="border-collapse:collapse"></td>
                                </tr>
                                <tr>
                                  <td>
                                    <table width="640px" cellspacing="0" cellpadding="0" border="0" align="center;">
                                      <?php   if(Auth::user()->avatar!=''){ ?>
                                      <tr>
                                        <td align="center">
                                          <?php
                                          if((strpos(Auth::user()->avatar,'http://')!== false || strpos(Auth::user()->avatar,'https://')!== false)) {
                                          ?>
                                          <div  style="border: 2px solid #e8e4e4; border-radius: 50%;padding:5px;text-align: center; width:109px;height:109px;">
                                            <img src="<?php echo str_replace('=normal','=large&width=200&height=200',Auth::user()->avatar) ?> " style="width:109px;height:109px;border-radius:50%;text-align:center;" />
                                          </div>
                                          <?php
                                          }else {
                                          ?>
                                          <div  style="border: 2px solid #e8e4e4; border-radius: 50%;padding:5px;text-align: center; width:109px;height:109px;">
                                            <img src="{{ asset('/img/memberImages/')}}/{{ Auth::user()->avatar }}" style="width:109px;height:109px;border-radius:50%;text-align:center;" />
                                          </div>
                                          <?php } ?>
                                        </td>
                                      </tr>
                                      <?php }else{
                                      ?>
                                      <tr>
                                        <td align="center">
                                          <img src="{{ asset('/img/bot-logo.png') }}" alt"Flying Chalks" >
                                        </td>
                                      </tr>
                                      <?php } ?>
                                    </table>
                                  </td>
                                </tr>
                                <!-- Spacing -->
                                <tr>
                                  <td width="100%" height="20" style="border-collapse:collapse"></td>
                                </tr>
                                <!-- Spacing -->
                                <tr>
                                  <td width="100%" style="border-collapse:collapse" align="center" >
                                    <table width="350" border="0" cellpadding="0" cellspacing="0" style="background:#ff7c00 !important;">
                                      <tr>
                                        <td height="40" valign="middle" align="center" style="coloe:#ffffff; font-weight: bold; text-decoration: none; font-family: Arial, Helvetica, sans-serif; font-size: 26px;">
                                          <a href="{{ URL::to('community?from=email') }}" target="_blank" style="color: #ffffff; font-weight: bold; text-decoration: none;">Reply&nbsp;{{ Auth::user()->fname }}</a>
                                        </td>
                                      </tr>
                                    </table>
                                  </td>
                                </tr>
                                <!-- Spacing -->
                                {{-- <tr>
                                  <td width="100%" height="30" style="border-collapse:collapse"></td>
                                </tr> --}}
                                <!-- Spacing -->
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
            <!--Reply End-->
            <!--footer-->
            <table width="100%" cellspacing="0" cellpadding="0" border="0" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt;margin:0;padding:0;width:100% !important;line-height:100% !important" st-sortable="preheader" id="backgroundTable">
              <tbody>
                <tr>
                  <td style="border-collapse:collapse">
                    <table width="640px" cellspacing="0" cellpadding="0" border="0" bgcolor="#f0f8fa" align="center" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt" class="devicewidth">
                      <tbody>
                        <tr>
                          <td width="100%" style="border-collapse:collapse">
                            <table width="640px" cellspacing="0" cellpadding="0" border="0" align="center" style="border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt" class="devicewidth">
                              <tbody>
                                <!-- Spacing -->
                                <tr>
                                  <td  align="right" style="border-collapse:collapse"><a href="https://www.facebook.com/flyingchalks"><img src="{{ asset('/img/fb-icon.png') }}" alt"Facebook"></a></td>
                                  <td width="15px"   style="border-collapse:collapse">&nbsp;</td>
                                  <td  align="left" style="border-collapse:collapse"><a href="https://www.instagram.com/flyingchalks/"><img src="{{ asset('/img/instragram-icon.png') }}" alt"Instragram"></a></td>
                                </tr>
                                {{-- <tr>
                                  <td height="20"  align="center" style="border-collapse:collapse" colspan="3"> &nbsp; </td>
                                </tr> --}}
                                <!-- Spacing -->
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
            <!--/footer-->
          </td>
        </tr>
      </table>
    </body>
  </html>
