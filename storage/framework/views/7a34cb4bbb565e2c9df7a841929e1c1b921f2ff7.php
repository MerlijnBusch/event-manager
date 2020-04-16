<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Document</title>

    <link href="<?php echo e(mix('css/app.css')); ?>">
</head>
<body>

    <div id="app"></div>


    <script src="<?php echo e(mix('js/app.js')); ?>"></script>
</body>
</html>
<?php /**PATH /home/merlijn/PhpstormProjects/nz-evenementenregistratie/resources/views/app.blade.php ENDPATH**/ ?>