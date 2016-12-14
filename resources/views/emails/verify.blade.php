<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<table style="border-collapse: collapse; border-spacing: 0;background-color: #F0F8FA; padding: 0;border-radius: 20px;" border="0" cellspacing="0" cellpadding="0" align="center">
            <tbody>
                <tr>
                    <td style="height: 20px;" colspan="3" valign="top"><br></td>
                </tr>
                <tr style="height: 36px;" height="36">
                    <td style="width: 30px;background-color: #F0F8FA;" width="30" valign="middle"><span style="background-color: #F0F8FA;">&nbsp;</span></td>
                    <td style="width: 500px;background-color: #F0F8FA;" width="500" valign="middle" align="center">
                        <span style="font-size: medium;background-color: #F0F8FA;text-align: center;float: left;width: 100%;">
                            <img src="{{asset('/img/inner_logo.png')}}" width="150" style="text-align: center;">
                        </span>
                    </td>
                    <td style="width: 30px;background-color: #F0F8FA;" width="30" valign="middle">
                        <span style="background-color: #F0F8FA;">&nbsp;</span>
                    </td>
                </tr>
                <tr>
                    <td style="height: 20px;" colspan="3" valign="top"><br></td>
                </tr>
                <tr>
                    <td style="width: 30px;" width="30" valign="top"><br></td>
                    <td style="width: 500px;" width="500" valign="top">
                        <span style="font-family: Arial,Helvetica,sans-serif;text-align: center;font-weight: bold;">
                            <table style="border-collapse: collapse; border-spacing: 0" border="0" cellspacing="0" cellpadding="0" width="499" height="108" align="left">
                                <tbody style="font-family: Roboto, sans-serif;font-size:16px;
">
                                    <tr>
                                        <td valign="top">
                                            <p>Hi,<br/><br/>Welcome to Flying Chalks! In order to get started, you need to confirm your email address.</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </span>
                    </td>
                    <td style="width: 30px;" width="30" valign="top"><br></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <p style="text-align: center;margin-top: 18px;"><a  href="{{ URL::to('register/verify/' . $data['confirmation_code']) }}" style="text-align: center;"><img src="{{asset('/img/confirm-email.png')}}"></a></p>
                    </td>
                </tr>
                <tr>
                    <td style="height: 20px;" colspan="3" valign="top"><br></td>
                </tr>
                <tr style="font-family: Roboto, sans-serif;font-size:16px;
">
                    <td style="width: 30px;"></td>
                    <td colspan="2">
                        <p>Cheers,<br>Flying Chalks Team</p>
                    </td>
                </tr>
                <tr>
                    <td style="height: 20px;" colspan="3" valign="top"><br></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <p style="text-align: center;">
                            <a href="https://www.facebook.com/flyingchalks" style="text-decoration: none;" target="_blank"><img src="{{asset('/img/email_fb_icon.png')}}" style="text-align: center;margin-right: 10px;"></a>
                            <a href="https://www.instagram.com/flyingchalks/" style="text-decoration: none;" target="_blank"><img src="{{asset('/img/email_insta_icon.png')}}" style="text-align: center;"></a>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="height: 10px;" colspan="3" valign="top"><br></td>
                </tr>
                <tr style="font-family: Roboto, sans-serif;font-size:16px;
">
                    <td colspan="3">
                        <p style="text-align: center;">
                            Sent with <img src="{{asset('/img/heart_like.png')}}"> from Flying Chalks
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="height: 30px;" colspan="3" valign="top"><br></td>
                </tr>
            </tbody>
        </table>
		<p><span style="font-family: Arial,Helvetica,sans-serif;"> </span></p>
	</body>
</html>
