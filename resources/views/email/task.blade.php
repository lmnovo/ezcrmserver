<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>{{trans("crudbooster.email_task_title")}}</title>
</head>
<body>

<div style='padding:20px;background:#ffffff;border-bottom:1px solid #eee;color:#ffffff;font-size:25px;font-weight:bold'>
    <div align='center'>
        <img src="<?php echo e(asset('assets/images/logo_ezcrm.png')); ?>" alt="EzCRM">
    </div>
</div>
<div style='padding:20px 20px 60px 20px;background:#ffffff;'>

<p>{{trans("crudbooster.email_task_content")}}</p>

<ul>
    <li><b>{{trans("crudbooster.name")}}:</b> {{ $data->name }}</li>
    <li><b>{{trans("crudbooster.date")}}:</b> {{ $data->created_at }}</li>
</ul>

 <p> {{trans("crudbooster.phase_sign")}} {{CRUDBooster::getSetting('appname')}}</p>
</body>
</html>