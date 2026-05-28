<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Staff Attendance</title>

    {{-- Tailwind CSS --}}
    @vite(['resources/css/app.css'])

</head>

<body class="bg-gray-100 p-10">

    <div class="max-w-6xl mx-auto">

        {{-- Page Heading --}}
        <h1 class="text-3xl font-bold mb-6">

            Staff Attendance Dashboard

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
                  action="/staff/attendance">

                @csrf

                {{-- Staff Selection --}}
                <div class="mb-4">

                    <label class="block mb-2 font-semibold">

                        Select Staff

                    </label>

                    <select name="staff_id"
                            class="w-full border p-2 rounded"
                            required>

                        <option value="">

                            -- Select Staff --

                        </option>

                        @foreach($staff as $member)

                            <option value="{{ $member->id }}">

                                {{ $member->name }}
                                ({{ $member->type }})

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

                {{-- Submit Button --}}
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

                        <th class="border p-2 text-left">
                            Staff Name
                        </th>

                        <th class="border p-2 text-left">
                            Type
                        </th>

                        <th class="border p-2 text-left">
                            Date
                        </th>

                        <th class="border p-2 text-left">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($attendanceRecords as $record)

                        <tr>

                            <td class="border p-2">

                                {{ $record->staff->name }}

                            </td>

                            <td class="border p-2">

                                {{ $record->staff->type }}

                            </td>

                            <td class="border p-2">

                                {{ $record->date }}

                            </td>

                            <td class="border p-2">

                                @if($record->status === 'PRESENT')

                                    <span class="bg-green-500 text-white px-2 py-1 rounded text-sm">

                                        PRESENT

                                    </span>

                                @elseif($record->status === 'ABSENT')

                                    <span class="bg-red-500 text-white px-2 py-1 rounded text-sm">

                                        ABSENT

                                    </span>

                                @else

                                    <span class="bg-yellow-500 text-white px-2 py-1 rounded text-sm">

                                        HOLIDAY

                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4"
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