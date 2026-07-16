<!DOCTYPE html>
<html>
<head>
    <title>Create Teacher</title>
</head>
<body>

<h1>Create Teacher</h1>

@if(session('success'))
    <p style="color:green">
        {{ session('success') }}
    </p>
@endif

<form action="{{ route('admin.teachers.store') }}" method="POST">

    @csrf

    <div>
        <label>Name</label><br>
        <input type="text" name="name" value="{{ old('name') }}">
        @error('name')
            <div style="color:red">{{ $message }}</div>
        @enderror
    </div>

    <br>

    <div>
        <label>Email</label><br>
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email')
            <div style="color:red">{{ $message }}</div>
        @enderror
    </div>

    <br>

    <div>
        <label>Password</label><br>
        <input type="password" name="password">
        @error('password')
            <div style="color:red">{{ $message }}</div>
        @enderror
    </div>

    <br>

    <div>
        <label>Confirm Password</label><br>
        <input type="password" name="password_confirmation">
    </div>

    <br>

    <button type="submit">
        Create Teacher
    </button>

</form>

</body>
</html>
