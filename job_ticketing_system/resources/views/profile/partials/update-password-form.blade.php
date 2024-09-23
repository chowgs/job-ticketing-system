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
        .form-group input[type="password"] {
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 0.25rem;
            width: 100%;
        }
        .form-group input[type="password"]:focus {
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
        <h2>Update Password</h2>
        <p>Ensure your account is using a long, random password to stay secure.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="update_password_current_password">Current Password</label>
            <input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="form-group">
            <label for="update_password_password">New Password</label>
            <input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="form-group">
            <label for="update_password_password_confirmation">Confirm Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary">Save</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
