<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('post.update')}}" method="post">
        @csrf
    <input type="text" name="barta" value="{{$single_data->post}}">
    <input type="hidden" name="id" value="{{$single_data->id}}">
    <button type="submit">submit</button>
    </form>
</body>
</html>