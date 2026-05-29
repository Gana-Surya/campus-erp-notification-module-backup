<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Notifications</title>

    @vite(['resources/css/app.css'])

</head>

<body class="bg-gray-100 p-10">

    <div class="max-w-4xl mx-auto">

        <h1 class="text-3xl font-bold mb-6">
            Notification Dashboard
        </h1>

        @if(session('success'))

            <div class="bg-green-500 text-white p-3 rounded mb-5">

                {{ session('success') }}

            </div>

        @endif

        {{-- Notification Form --}}
        <div class="bg-white p-6 rounded shadow mb-8">

            <form method="POST"
                  action="/notifications">

                @csrf

                {{-- Recipient --}}
                <div class="mb-4">

                    <label class="block mb-2 font-semibold">

                        Recipient

                    </label>

                    <input type="text"
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

                {{-- Notification Type --}}
                <div class="mb-4">

                    <label class="block mb-2 font-semibold">

                        Notification Type

                    </label>

                    <select name="type"
                            class="w-full border p-2 rounded"
                            required>

                        <option value="EMAIL">

                            EMAIL

                        </option>

                        <option value="SMS">

                            SMS

                        </option>

                        <option value="WHATSAPP">

                            WHATSAPP

                        </option>

                    </select>

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

                {{-- Message --}}
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

                            Type

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

                            <td class="border p-2">

                                {{ $notification->recipient }}

                            </td>

                            <td class="border p-2">

                                {{ $notification->type }}

                            </td>

                            <td class="border p-2">

                                {{ $notification->message }}

                            </td>

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

                            <td class="border p-2">

                                {{ $notification->created_at }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                class="border p-4 text-center">

                                No notifications found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

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