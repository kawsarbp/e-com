<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        E-mail
    </title>
</head>
<body>

<table>
    <tr>
        <td>Dear {{ $name }}!</td>
    </tr>
    <tr>
        <td>You have requested to recover your password. new password is as below :- </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>Password: {{$password}}</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>Thanks & Regards</td>
    </tr>
</table>

</body>
</html>
