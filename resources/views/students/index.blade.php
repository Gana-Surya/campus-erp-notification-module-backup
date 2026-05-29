<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Student Management</title>

    {{-- Tailwind CSS --}}
    @vite(['resources/css/app.css'])

</head>

<body class="bg-gray-100 p-10">

<div class="max-w-7xl mx-auto">

    {{-- Page Heading --}}
    <h1 class="text-3xl font-bold mb-6">

        Student Management Dashboard

    </h1>

    {{-- Success Message --}}
    @if(session('success'))

        <div class="bg-green-500 text-white p-3 rounded mb-5">

            {{ session('success') }}

        </div>

    @endif

    {{-- Add Student Form --}}
    <div class="bg-white p-6 rounded shadow mb-8">

        <form method="POST"
              action="/students">

            @csrf

            {{-- Admission Number --}}
            <div class="mb-4">

                <label class="block mb-2 font-semibold">

                    Admission Number

                </label>

                <input type="text"
                       name="admission_number"
                       value="{{ old('admission_number') }}"
                       class="w-full border p-2 rounded"
                       required>

            </div>

            {{-- Student Name --}}
            <div class="mb-4">

                <label class="block mb-2 font-semibold">

                    Student Name

                </label>

                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       class="w-full border p-2 rounded"
                       required>

            </div>

            {{-- Stream --}}
            <div class="mb-4">

                <label class="block mb-2 font-semibold">

                    Stream

                </label>

                <select name="stream"
                        class="w-full border p-2 rounded"
                        required>

                    <option value="">Select Stream</option>

                    <option value="Science">
                        Science
                    </option>

                    <option value="Arts">
                        Arts
                    </option>

                </select>

            </div>

            {{-- Course --}}
            <div class="mb-4">

                <label class="block mb-2 font-semibold">

                    Course

                </label>

                <input type="text"
                       name="course"
                       class="w-full border p-2 rounded"
                       required>

            </div>

            {{-- Semester --}}
            <div class="mb-4">

                <label class="block mb-2 font-semibold">

                    Semester

                </label>

                <input type="number"
                       name="semester"
                       min="1"
                       max="6"
                       class="w-full border p-2 rounded"
                       required>

            </div>

            {{-- Category --}}
            <div class="mb-4">

                <label class="block mb-2 font-semibold">

                    Category

                </label>

                <select name="category"
                        class="w-full border p-2 rounded"
                        required>

                    <option value="GEN">GEN</option>
                    <option value="OBC">OBC</option>
                    <option value="SC">SC</option>
                    <option value="ST">ST</option>

                </select>

            </div>

            {{-- Email --}}
            <div class="mb-4">

                <label class="block mb-2 font-semibold">

                    Email

                </label>

                <input type="email"
                       name="email"
                       class="w-full border p-2 rounded">

            </div>

            {{-- Phone --}}
            <div class="mb-4">

                <label class="block mb-2 font-semibold">

                    Phone

                </label>

                <input type="text"
                       name="phone"
                       class="w-full border p-2 rounded">

            </div>

            <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded">

                Add Student

            </button>

        </form>

    </div>

    {{-- Student List --}}
    <div class="bg-white p-6 rounded shadow">

        <h2 class="text-2xl font-bold mb-4">

            Student List

        </h2>

        <table class="w-full border-collapse">

            <thead>

                <tr class="bg-gray-200">

                    <th class="border p-2">Admission No</th>
                    <th class="border p-2">Name</th>
                    <th class="border p-2">Course</th>
                    <th class="border p-2">Semester</th>
                    <th class="border p-2">Category</th>

                </tr>

            </thead>

            <tbody>

                @forelse($students as $student)

                    <tr>

                        <td class="border p-2">

                            {{ $student->admission_number }}

                        </td>

                        <td class="border p-2">

                            {{ $student->name }}

                        </td>

                        <td class="border p-2">

                            {{ $student->course }}

                        </td>

                        <td class="border p-2">

                            {{ $student->semester }}

                        </td>

                        <td class="border p-2">

                            {{ $student->category }}

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5"
                            class="border p-4 text-center">

                            No students found.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>

</html>