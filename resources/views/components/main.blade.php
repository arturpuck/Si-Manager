<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="noindex">
        <link rel="stylesheet" href="{{$cssFilePath}}">
        <link href="https://fonts.googleapis.com/css?family=Exo+2|Aldrich|Oxanium|Teko|Play&display=swap" rel="preload stylesheet" as="style">
        <title>{{$title}}</title>
        <script src="{{$jsFilePath}}" defer></script>
    </head>
    <body class="body">
    <div id="app">
        {{$slot}}
    </div>
    </body>
</html>