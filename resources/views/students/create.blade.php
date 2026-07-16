<h1>Create Student</h1>

<form method="POST" action="{{ route('admin.students.store') }}">

    @csrf

    <label>Teacher</label>

    <select name="teacher_id">
        @foreach($teachers as $teacher)

            <option value="{{ $teacher->id }}">
                {{ $teacher->name }}
            </option>

        @endforeach
    </select>


    <br>

    <label>Name</label>
    <input type="text" name="name">


    <br>

    <label>Email</label>
    <input type="email" name="email">


    <br>

    <label>Phone</label>
    <input type="text" name="phone">


    <br>

    <label>Status</label>

    <select name="status">
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
    </select>


    <br>

    <button type="submit">
        Create Student
    </button>

</form>
