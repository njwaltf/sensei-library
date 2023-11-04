<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
{{-- <style>
    .qr {
        margin: auto;
    }
</style> --}}

<body>
    @php
        $id = request()->segment(3);
    @endphp
    {{-- <div class="qr">
        <img src="data:image/png;base64, {!! base64_encode(QrCode::size(200)->generate('http://127.0.0.1:8000/dashboard/books/' . $id)) !!} "> --}}
    <div class="parent-container" style="display: flex; justify-content: center; align-items: center;">
        <!-- Your QR code content -->
        <img src="data:image/png;base64, {!! base64_encode(QrCode::size(200)->generate('http://127.0.0.1:8000/dashboard/books/' . $id)) !!} ">
    </div>

</body>

</html>
