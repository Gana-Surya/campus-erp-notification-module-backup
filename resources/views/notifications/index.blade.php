<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Notifications</title>

    {{-- Tailwind CSS via Vite --}}
    @vite(['resources/css/app.css'])

</head>

<body class="bg-gray-100 p-10">

    <div class="max-w-4xl mx-auto">

        {{-- Page Heading --}}
        <h1 class="text-3xl font-bold mb-6">
            Notification Dashboard
        </h1>

        {{-- Success Message --}}
        @if(session('success'))

            <div class="bg-green-500 text-white p-3 rounded mb-5">

                {{ session('success') }}

            </div>

        @endif

        {{-- Notification Form Card --}}
        <div class="bg-white p-6 rounded shadow mb-8">

            <form method="POST"
                  action="/notifications">

                @csrf

                {{-- Recipient Email --}}
                <div class="mb-4">

                    <label class="block mb-2 font-semibold">

                        Recipient Email

                    </label>

                    <input type="email"
                           name="recipient"
                           value="{{ old('recipient') }}"
                           class="w-full border p-2 rounded"
                           required>

                    @error('recipient')

                        <p class="text-red-500 mt-1">

                            {{ $message }}

                        </p>

                    @enderror

                </div>

                {{-- Template Dropdown --}}
                <div class="mb-4">

                    <label class="block mb-2 font-semibold">

                        Select Template

                    </label>

                    <select id="templateSelect"
                            class="w-full border p-2 rounded">

                        <option value="">

                            -- Choose Template --

                        </option>

                        @foreach($templates as $template)

                            <option value="{{ $template->message }}">

                                {{ $template->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- Message Textarea --}}
                <div class="mb-4">

                    <label class="block mb-2 font-semibold">

                        Message

                    </label>

                    <textarea id="messageBox"
                              name="message"
                              rows="5"
                              class="w-full border p-3 rounded"
                              required>{{ old('message') }}</textarea>

                    @error('message')

                        <p class="text-red-500 mt-1">

                            {{ $message }}

                        </p>

                    @enderror

                </div>

                {{-- Hidden Notification Type --}}
                <input type="hidden"
                       name="type"
                       value="EMAIL">

                {{-- Submit Button --}}
                <button type="submit"
                        class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">

                    Send Notification

                </button>

            </form>

        </div>

        {{-- Notification History --}}
        <div class="bg-white p-6 rounded shadow">

            <h2 class="text-2xl font-bold mb-4">

                Notification History

            </h2>

            <table class="w-full border-collapse">

                <thead>

                    <tr class="bg-gray-200">

                        <th class="border p-2 text-left">

                            Recipient

                        </th>

                        <th class="border p-2 text-left">

                            Message

                        </th>

                        <th class="border p-2 text-left">

                            Status

                        </th>

                        <th class="border p-2 text-left">

                            Sent At

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($notifications as $notification)

                        <tr>

                            {{-- Recipient --}}
                            <td class="border p-2">

                                {{ $notification->recipient }}

                            </td>

                            {{-- Message --}}
                            <td class="border p-2">

                                {{ $notification->message }}

                            </td>

                            {{-- Status Badge --}}
                            <td class="border p-2">

                                @if($notification->status === 'SENT')

                                    <span class="bg-green-500 text-white px-2 py-1 rounded text-sm">

                                        SENT

                                    </span>

                                @elseif($notification->status === 'FAILED')

                                    <span class="bg-red-500 text-white px-2 py-1 rounded text-sm">

                                        FAILED

                                    </span>

                                @else

                                    <span class="bg-yellow-500 text-white px-2 py-1 rounded text-sm">

                                        PENDING

                                    </span>

                                @endif

                            </td>

                            {{-- Created Time --}}
                            <td class="border p-2">

                                {{ $notification->created_at }}

                            </td>

                        </tr>

                    @empty

                        {{-- Empty State --}}
                        <tr>

                            <td colspan="4"
                                class="border p-4 text-center">

                                No notifications found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- Auto-fill Message from Selected Template --}}
    <script>

        const templateSelect =
            document.getElementById('templateSelect');

        const messageBox =
            document.getElementById('messageBox');

        templateSelect.addEventListener(
            'change',
            function () {

                messageBox.value = this.value;

            }
        );

    </script>

</body>

</html>