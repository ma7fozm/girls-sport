<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
<h2> قام {{$fname.' '.$lname}} بارسال تلك الرسالة لادارة الموقع </h2>
<h3> بيانات المرسل</h3>
<h4>الاسم الاول : {{$fname}}</h4>
<h4>الاسم التانى : {{$lname}}</h4>
<h4>البريد الالكترونى :{{$email}} </h4>
<h4>رقم الجوال :{{$phone}} </h4>
<h4>نص الرسالة:</h4>
<blockquote>
    {{$msg}}
</blockquote>
</body>

</html>