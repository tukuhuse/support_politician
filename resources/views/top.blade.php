<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>トップページ</title>
        
        <script src="{{ secure_asset('js/app.js') }}" defer></script>
        
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapi.com/css?family=Raleway:300.400.600" rel="stylesheet" type="text/css">
        
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        
    </head>
    <body>
        <div id="menu">
            <main class="menu_table">
                <table class="menu_list">
                    <tr>
                        <td><a href="#">議題検索ページ</a></td>
                        <td><a href="#">議員検索ページ</a></td>
                        @guest
                            <td><a href="./register">新規登録</a></td>
                        @else
                            <td><a href="#">ログアウト</a></td>
                        @endguest
                    </tr>
                </table>
            </main>
        </div>
    </body>
</html>