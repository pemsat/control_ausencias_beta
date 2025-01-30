<div>
    <!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
    @extends('layouts.app')

    @section('content')
    <h2>Faltas Actuales</h2>
    <ul>
        @foreach ($attendances as $attendance)
            <li>
                {{ $attendance->user->name }} ({{ $attendance->user->department->name }}) -
                {{ $attendance->time_slot }} -
                {{ $attendance->comment ?? 'Sin comentario' }}
            </li>
        @endforeach
    </ul>
    @endsection

</div>
