<x-layouts::app :title="__('Create Teacher')">

<div class="max-w-xl">


<h1 class="mb-6 text-3xl font-bold">
Create Teacher
</h1>


<form method="POST"
action="{{ route('admin.teachers.store') }}"
class="space-y-5 rounded-xl bg-white p-6 shadow">

@csrf


<div>

<label>Name</label>

<input name="name"
class="w-full rounded-lg border p-2">

</div>



<div>

<label>Email</label>

<input type="email"
name="email"
class="w-full rounded-lg border p-2">

</div>



<div>

<label>Password</label>

<input type="password"
name="password"
class="w-full rounded-lg border p-2">

</div>



<div>

<label>Confirm Password</label>

<input type="password"
name="password_confirmation"
class="w-full rounded-lg border p-2">

</div>



<button
class="rounded-lg bg-blue-600 px-5 py-2 text-white">

Create Teacher

</button>


</form>


</div>

</x-layouts::app>
