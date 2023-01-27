<!DOCTYPE html>
<html lang="zh-Hant-TW" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>我的桐人 多帳戶代理介面</title>
</head>
<body class="dark">
    <div id="app">
        <navbar></navbar>
        <div class="main">
            <dead-band></dead-band>
            <router-view></router-view>
            <alert-modal></alert-modal>
        </div>
    </div>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</body>
</html>
