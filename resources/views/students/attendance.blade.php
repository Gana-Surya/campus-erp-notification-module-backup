<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Student Attendance</title>

    @vite(['resources/css/app.css'])

</head>

<body class="bg-gray-100 p-10">

<div class="max-w-7xl mx-auto">

    {{-- Page Heading --}}
    <h1 class="text-3xl font-bold mb-6">

        Student Attendance Dashboard

    </h1>

    {{-- Success Message --}}
    @if(session('success'))

        <div class="bg-green-500 text-white p-3 rounded mb-5">

            {{ session('success') }}

        </div>

    @endif

    {{-- Attendance Form --}}
    <div class="bg-white p-6 rounded shadow mb-8">

        <form method="POST"
              action="/students/attendance">

            @csrf

            {{-- Student --}}
            <div class="mb-4">

                <label class="block mb-2 font-semibold">

                    Select Student

                </label>

                <select name="student_id"
                        class="w-full border p-2 rounded"
                        required>

                    <option value="">
                        -- Select Student --
                    </option>

                    @foreach($students as $student)

                        <option value="{{ $student->id }}">

                            {{ $student->admission_number }}
                            -
                            {{ $student->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            {{-- Attendance Date --}}
            <div class="mb-4">

                <label class="block mb-2 font-semibold">

                    Attendance Date

                </label>

                <input type="date"
                       name="date"
                       class="w-full border p-2 rounded"
                       required>

            </div>

            {{-- Attendance Status --}}
            <div class="mb-4">

                <label class="block mb-2 font-semibold">

                    Attendance Status

                </label>

                <select name="status"
                        class="w-full border p-2 rounded"
                        required>

                    <option value="PRESENT">
                        PRESENT
                    </option>

                    <option value="ABSENT">
                        ABSENT
                    </option>

                    <option value="HOLIDAY">
                        HOLIDAY
                    </option>

                </select>

            </div>

            <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded">

                Mark Attendance

            </button>

        </form>

    </div>

    {{-- Attendance History --}}
    <div class="bg-white p-6 rounded shadow">

        <h2 class="text-2xl font-bold mb-4">

            Attendance History

        </h2>

        <table class="w-full border-collapse">

            <thead>

                <tr class="bg-gray-200">

                    <th class="border p-2">
                        Admission No
                    </th>

                    <th class="border p-2">
                        Student Name
                    </th>

                    <th class="border p-2">
                        Course
                    </th>

                    <th class="border p-2">
                        Date
                    </th>

                    <th class="border p-2">
                        Status
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($attendanceRecords as $record)

                    <tr>

                        <td class="border p-2">

                            {{ $record->student->admission_number }}

                        </td>

                        <td class="border p-2">

                            {{ $record->student->name }}

                        </td>

                        <td class="border p-2">

                            {{ $record->student->course }}

                        </td>

                        <td class="border p-2">

                            {{ $record->date }}

                        </td>

                        <td class="border p-2">

                            @if($record->status === 'PRESENT')

                                <span class="bg-green-500 text-white px-3 py-1 rounded">

                                    PRESENT

                                </span>

                            @elseif($record->status === 'ABSENT')

                                <span class="bg-red-500 text-white px-3 py-1 rounded">

                                    ABSENT

                                </span>

                            @else

                                <span class="bg-yellow-500 text-white px-3 py-1 rounded">

                                    HOLIDAY

                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5"
                            class="border p-4 text-center">

                            No attendance records found.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>

</html>