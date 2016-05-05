<?xml version="1.0" encoding="utf-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="styles.css" />
        <title>{{ $story->name }}</title>
    </head>
    <body>
        <h1>{{ $story->name }}</h1>
        <h2>{{ $story->showMany('authors') }}</h2>
        <h2>Truyện được download từ website Readable (Thích đọc sách) www.readable.co<h2>
        <h4>Nguồn sưu tầm: {{ $story->showMany('sources') }}</h4>
    </body>
</html>