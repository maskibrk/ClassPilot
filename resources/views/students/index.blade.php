<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
</head>
<body>

<h1>Students List</h1>

<a href="{{ route('admin.students.create') }}">
    Create Student
</a>


<br></br>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Teacher</th>
        <th>Parent</th>
    </tr>

    @foreach($students as $student)
        <tr>
            <td>{{ $student->id }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>{{ $student->teacher->name }}</td>
            <td>{{ $student->parent?->name }}</td>
        </tr>
    @endforeach

</table>
{{ auth()->user()->name }}
<br>
{{ auth()->user()->role }}
</body>
</html>
