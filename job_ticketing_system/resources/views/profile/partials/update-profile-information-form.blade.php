<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .header {
            background-color: #333;
            color: #fff;
            padding: 1rem;
            text-align: center;
        }
        .header h2 {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .header p {
            font-size: 1rem;
            color: #ccc;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            font-weight: bold;
            font-size: 1.1rem;
        }
        .form-group input[type="text"], .form-group input[type="email"] {
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
            width: 100%;
        }
        .form-group input[type="text"]:focus, .form-group input[type="email"]:focus {
            border-color: #aaa;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group button[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
        }
        .form-group button[type="submit"]:hover {
            background-color: #3e8e41;
        }
        .success-message {
            font-size: 1.1rem;
            color: #4CAF50;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .error-message {
            font-size: 1.1rem;
            color: #ff0000;
            font-weight: bold;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

<section class="container">
    <header class="header">
        <h2>Profile Information</h2>
        <p>Update your account's profile information and email address.</p>
    </header>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="form-group">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="form-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary">Save</button>

            @if (session('status') === 'profile-updated')
                <p class="success-message">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
