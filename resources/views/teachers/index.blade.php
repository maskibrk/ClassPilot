<!DOCTYPE html>
<html>
<head>
    <title>Teachers</title>
</head>
<body>

<h1>Teachers List</h1>

<a href="{{ route('admin.teachers.create') }}">
    Create Teacher
</a>

<br><br>

@if(session('success'))
    <p style="color:green;">
        {{ session('success') }}
    </p>
@endif

<table border="1" cellpadding="10">

    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
    </tr>

    @forelse($teachers as $teacher)

        <tr>
            <td>{{ $teacher->id }}</td>
            <td>{{ $teacher->name }}</td>
            <td>{{ $teacher->email }}</td>
        </tr>

    @empty

        <tr>
            <td colspan="3">
                No teachers found.
            </td>
        </tr>

    @endforelse

</table>

</body>
</html>
