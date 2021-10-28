@component('mail::message')
<h1>{{ $data['name'] }}</h1>
<strong>{{ $data['subject'] }}</strong>
<p>{{ $data['message'] }}</p>
@endcomponent
{{-- <!DOCTYPE html>
<html>
<head>
    <title>ItsolutionStuff.com</title>
</head>
<body>
    <h1>{{ $data['name'] }}</h1>
    <strong>{{ $data['subject'] }}</strong>
    <p>{{ $data['message'] }}</p>
    <p>Thank you</p>
</body>
</html> --}}