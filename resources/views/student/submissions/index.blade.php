@foreach($submissions as $submission)

<tr>

    <td>{{ $submission->homework->title }}</td>

    <td>{{ $submission->homework->academyClass->name }}</td>

    <td>{{ $submission->submitted_at?->format('d M Y H:i') }}</td>

    <td>

        <a href="{{ route('student.submissions.show',$submission) }}">
            View
        </a>

    </td>

</tr>

@endforeach
