<!DOCTYPE html>
<html>
<head>
    <title>Property Status Updated</title>
</head>
<body>
    <h1>Hello {{ $property->user->name }}</h1>
    <p>The status of your property "{{ $property->property_name }}" has been updated to "{{ $property->status }}".</p>
    <p>Thank you for using our service.</p>
</body>
</html>