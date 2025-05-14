<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center">

  <div class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-md animate-fade-in-up">
    <h2 class="text-3xl font-bold text-gray-800 text-center mb-6">Welcome Back 👋</h2>

    <form class="space-y-4">
      <div>
        <label class="block text-gray-600 font-medium mb-1" for="email">Email</label>
        <input id="email" type="email" class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-purple-400 focus:outline-none" placeholder="your@email.com" required />
      </div>

      <div>
        <label class="block text-gray-600 font-medium mb-1" for="password">Password</label>
        <input id="password" type="password" class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-purple-400 focus:outline-none" placeholder="********" required />
      </div>

      <div class="flex justify-between items-center text-sm">
        <label class="flex items-center gap-2">
          <input type="checkbox" class="accent-purple-600" />
          Remember me
        </label>
        <a href="#" class="text-purple-600 hover:underline">Forgot password?</a>
      </div>

      <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white py-2 rounded-xl transition duration-300 shadow-lg">
        Login
      </button>
    </form>

    <p class="text-center text-sm text-gray-500 mt-6">
      Don't have an account?
      <a href="#" class="text-purple-600 hover:underline">Sign up</a>
    </p>
  </div>

  <style>
    @keyframes fade-in-up {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .animate-fade-in-up {
      animation: fade-in-up 0.6s ease-out;
    }
  </style>
</body>
</html>