<DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h1>Чтобы подтвердить вашу почту, перейдите по ссылке</h1>
        <a href="{{ route('confirm-email', $user->confirmation_token) }}">tap here</a>
    </body>
</html>