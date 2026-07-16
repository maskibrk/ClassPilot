<!DOCTYPE html>
<html>
<head>
    <title>Parents</title>
</head>

<body>

<h1>Parents List</h1>

<a href="{{ route('admin.parents.create') }}">
    Create Parent
</a>

<br><br>


@if(session('success'))

<p style="color:green">
    {{ session('success') }}
</p>

@endif


<table border="1" cellpadding="10">

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Children</th>
</tr>


@forelse($parents as $parent)

<tr>

    <td>
        {{ $parent->id }}
    </td>


    <td>
        {{ $parent->name }}
    </td>


    <td>
        {{ $parent->email }}
    </td>


    <td>

        @forelse($parent->children as $child)

            {{ $child->name }}<br>

        @empty

            No children assigned

        @endforelse

    </td>


</tr>


@empty

<tr>

<td colspan="4">
    No parents found.
</td>

</tr>

@endforelse


</table>


</body>
</html>
