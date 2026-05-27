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

        <div class="bg-white p-6 rounded shadow mb-8">

            <form method="POST"
                  action="/notifications">

                @csrf

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

                <div class="mb-4">

                    <label class="block mb-2 font-semibold">
                        Message
                    </label>

                    <textarea name="message"
                              rows="4"
                              class="w-full border p-2 rounded"
                              required>{{ old('message') }}</textarea>

                    @error('message')

                        <p class="text-red-500 mt-1">

                            {{ $message }}

                        </p>

                    @enderror

                </div>

                <input type="hidden"
                       name="type"
                       value="EMAIL">

                <button type="submit"
                        class="bg-blue-600 text-white px-5 py-2 rounded">

                    Send Notification

                </button>

            </form>

        </div>

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

                            <td class="border p-2">

                                {{ $notification->recipient }}

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

</body>

</html>