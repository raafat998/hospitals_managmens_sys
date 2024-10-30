<!DOCTYPE html>
<html>
<head>
    <title>New User Added</title>
</head>
<body>
    <h1>New User Added</h1>
    <p>A new user has been added to the system:</p>
    <ul>
        <li>Name: {{ $user->name }}</li>
        <li>Email: {{ $user->email }}</li>
        <li>Phone: {{ $user->phone }}</li>
    </ul>
</body>
</html>
