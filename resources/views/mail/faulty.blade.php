<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Faulty Notification Email</title>
  <style>
    /* Reset some default styles */
    body, h1, p {
      margin: 0;
      padding: 0;
    }
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }
    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: #ffffff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
      color: #333333;
      margin-bottom: 20px;
    }
    p {
      color: #666666;
      line-height: 1.6;
      margin-bottom: 20px;
    }
    .button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #ff6600;
      color: #ffffff;
      text-decoration: none;
      border-radius: 5px;
    }
  </style>
</head>
<body>
    <div class="container">
        <h1>{{$action}}</h1>
        <p>Hello there {{$user->name}}!</p>
        <h3>{{$issue->title}}.</h3>
        <p>{{ $issue->description }}</p>
        @if ($user->hasRole('artisan'))
            <a href="{{route('artisan-issues-show', $issue->id)}}" class="button">See More</a>
        @endif
        @if ($user->hasRole('admin'))
            <a href="{{route('admin-issues-show', $issue->id)}}" class="button">See More</a>
        @endif
        @if ($user->hasRole('user'))
            <a href="{{route('user-issues-show', $issue->id)}}" class="button">See More</a>
        @endif
    </div>
</body>
</html>
