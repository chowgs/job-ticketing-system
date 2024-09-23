<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrator</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg">
                <a href="{{ route('admin.dashboard') }}" class="block p-4 text-blue-500 hover:text-blue-700 text-sm">← Back</a>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('job_manage.update', $Jobinfo->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Client's Info -->
                        <div class="mb-8 border-b pb-4">
                            <h3 class="text-lg font-semibold mb-4">Client's Info</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="flex flex-col space-y-4">
                                    <label for="name" class="text-sm font-medium text-gray-700 dark:text-gray-300">Name:</label>
                                    <input type="text" id="name" name="name" class="p-3 border rounded-md text-sm" value="{{ $Jobinfo->name }}" readonly>
                                </div>
                                <div class="flex flex-col space-y-4">
                                    <label for="contact_number" class="text-sm font-medium text-gray-700 dark:text-gray-300">Contact Number:</label>
                                    <input type="text" id="contact_number" name="contact_number" class="p-3 border rounded-md text-sm" value="{{ $Jobinfo->number }}" readonly>
                                </div>
                            </div>
                            <div class="mt-4">
                                <label for="department" class="text-sm font-medium text-gray-700 dark:text-gray-300">Department:</label>
                                <input type="text" id="department" name="department" class="p-3 border rounded-md w-full text-sm" value="{{ auth()->user()->department }}" readonly>
                            </div>
                        </div>

                        <!-- Request Options -->
                        <div class="mb-8 border-b pb-4">
                            <h3 class="text-lg font-semibold mb-4">Type of Request</h3>
                            <div class="flex flex-col space-y-4">
                                <label for="request" class="text-sm font-medium text-gray-700 dark:text-gray-300">Client Request:</label>
                                <input type="text" id="request" name="request" class="p-3 border rounded-md text-sm bg-gray-50" value="{{ $Jobinfo->requests }}" readonly>
                            </div>
                        </div>

                        <!-- Date/Time Fields -->
                        <div class="mb-8 border-b pb-4">
                            <h3 class="text-lg font-semibold mb-4">Date/Time Details</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="flex flex-col space-y-4">
                                    <label for="datetime_started" class="text-sm font-medium text-gray-700 dark:text-gray-300">Date/Time Started:</label>
                                    <input type="datetime-local" id="datetime_started" name="datetime_started" class="p-3 border rounded-md text-sm" value="{{ $Jobinfo->datetime_started }}" readonly>
                                </div>
                                <div class="flex flex-col space-y-4">
                                    <label for="datetime_accomplished" class="text-sm font-medium text-gray-700 dark:text-gray-300">Date/Time Accomplished:</label>
                                    <input type="datetime-local" id="datetime_accomplished" name="datetime_accomplished" class="p-3 border rounded-md text-sm" value="{{ $Jobinfo->datetime_accomplished }}" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-6">
                            <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Void
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
