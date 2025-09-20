<!DOCTYPE html>
<html>
<head>
    <title>Password Required</title>
</head>
<body>
    <form method="POST" action="{{ route('simple.password.check') }}">
        @csrf
        <label>Enter Access Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
