<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Arvan Challenge</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet" media="screen" id="color">

    </head>
    <body>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    پنل ادمین
                </h5>
                <p>
                برای مشاهده لیست کد‌ها و ایجاد کد جدید باید وارد پنل ادمین شوید.
                <br>
                آدرس پنل ادمین : 
                <code>
                    <a target="_blank" href="/admin/codes">{{url('/admin/codes')}}</a>
                </code>
                </p>
                <h5 class="card-title">
                    لیست API
                </h5>
                <p>
                کالکش API رو هم میتونید از لینک زیر دانلود کنید. 
                <br>
                <a target="_blank" href="https://www.getpostman.com/collections/e64ffda06d1da23b1668" class="btn btn-primary btn-sm">Postman Collection</a>
                </p>
            </div>
        </div>
    </body>
</html>
