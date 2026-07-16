<h1>Create Parent</h1>


<form method="POST" action="{{ route('admin.parents.store') }}">

@csrf


<label>
    Parent Name
</label>

<input type="text" name="name">


<br><br>


<label>
    Email
</label>

<input type="email" name="email">


<br><br>


<label>
    Password
</label>

<input type="password" name="password">


<br><br>


<label>
    Confirm Password
</label>

<input type="password" name="password_confirmation">


<br><br>


<h3>Select Children</h3>


@foreach($students as $student)

    <label>

        <input
            type="checkbox"
            name="students[]"
            value="{{ $student->id }}"
        >

        {{ $student->name }}

    </label>

    <br>

@endforeach


<br>


<button type="submit">
    Create Parent
</button>


</form>
