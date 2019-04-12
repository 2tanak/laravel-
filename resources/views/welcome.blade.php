@extends(env('THEME').'.layouts.master')

<div class='welcom2'>
<div>
Здравствуйте гость, чтобы зайти в админку и увидеть функционал
вам нужно авторизоваться, данные для авторизации: login: admin, password: 123456
</div>
</div>
@include(env('THEME').'.admin.footer')

