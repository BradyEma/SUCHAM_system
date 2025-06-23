<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - GoldenFields</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #b7791f;
        }
        .password-toggle:hover {
            color: #8e5c1a;
        }
        .input-field {
            transition: all 0.3s ease;
        }
        .input-field:focus {
            box-shadow: 0 0 0 3px green;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-green-50 to-amber-50 flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-2xl border-t-4 border-yellow-500 transform hover:shadow-lg transition duration-300">
        <!-- Logo and Header -->
        <div class="flex flex-col items-center mb-8">
            <div class="w-24 h-24 bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-full flex items-center justify-center shadow-md mb-4">
                <i class="fas fa-leaf text-white text-4xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-green-800 mb-2">Join GoldenFields</h1>
            <p class="text-gray-600 text-center">Create your account to access our sugar supply chain network</p>
        </div>

        <form method="POST" action="{{ route('register') }}" onsubmit="return validateForm()">
            @csrf

            <!-- Name -->
            <div class="mb-5 relative">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-green-700"></i>
                    </div>
                    <input id="name" name="name" type="text" required autofocus
                           class="pl-10 input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-1" 
                           placeholder="John Doe" />
                </div>
            </div>

            <!-- Email -->
            <div class="mb-5 relative">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-green-700"></i>
                    </div>
                    <input id="email" name="email" type="email" required
                           class="pl-10 input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-1" 
                           placeholder="your@email.com" />
                </div>
            </div>

            <!-- Password -->
            <div class="mb-5 relative">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-green-700"></i>
                    </div>
                    <input id="password" name="password" type="password" required
                           class="pl-10 input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-1" 
                            />
                    <span class="password-toggle" onclick="togglePassword('password')">
                        <i class="far fa-eye text-green-700"></i>
                    </span>
                </div>
                <div class="text-xs text-gray-500 mt-1">Must be at least 8 characters</div>
            </div>

            <!-- Confirm Password -->
            <div class="mb-6 relative">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-green-700"></i>
                    </div>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                           class="pl-10 input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-1" 
                            />
                    <span class="password-toggle" onclick="togglePassword('password_confirmation')">
                        <i class="far fa-eye text-green-700"></i>
                    </span>
                </div>
                <p id="password-error" class="text-sm text-red-600 mt-1 hidden">
                    <i class="fas fa-exclamation-circle mr-1"></i> Passwords do not match
                </p>
            </div>

            <!-- Terms Checkbox -->
            <div class="mb-6 flex items-start">
                <div class="flex items-center h-5">
                    <input id="terms" name="terms" type="checkbox" required
                           class="h-4 w-4 text-yellow-500 focus:ring-yellow-400 border-gray-300 rounded">
                </div>
                <label for="terms" class="ml-2 block text-sm text-gray-700">
                    I agree to the <a href="#" class="text-yellow-600 hover:underline">Terms of Service</a> and <a href="#" class="text-yellow-600 hover:underline">Privacy Policy</a>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                    class="w-full bg-gradient-to-r from-green-700 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white font-bold py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex items-center justify-center">
                <i class="fas fa-user-plus mr-2"></i> Create Account
            </button>

            <!-- Login Link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="font-medium text-yellow-600 hover:text-yellow-700 hover:underline">
                        Sign in here
                    </a>
                </p>
            </div>
        </form>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling.querySelector('i');
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        function validateForm() {
            const password = document.getElementById('password').value;
            const confirm = document.getElementById('password_confirmation').value;
            const error = document.getElementById('password-error');
            const terms = document.getElementById('terms');

            // Check password match
            if (password !== confirm) {
                error.classList.remove('hidden');
                document.getElementById('password_confirmation').focus();
                return false;
            } else {
                error.classList.add('hidden');
            }

            // Check password length
            if (password.length < 8) {
                alert('Password must be at least 8 characters long');
                document.getElementById('password').focus();
                return false;
            }

            // Check terms agreement
            if (!terms.checked) {
                alert('You must agree to the terms and conditions');
                return false;
            }

            return true;
        }

        // Add real-time password match validation
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirm = this.value;
            const error = document.getElementById('password-error');

            if (confirm.length > 0 && password !== confirm) {
                error.classList.remove('hidden');
            } else {
                error.classList.add('hidden');
            }
        });
    </script>

</body>
</html>