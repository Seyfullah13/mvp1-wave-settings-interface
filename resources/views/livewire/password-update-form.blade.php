<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password form</title>
    <link rel="stylesheet" href="/style.css">
</head>

<body>

    <form wire:submit.prevent="updatePassword" class="w-[520px] mx-auto">
        <label for="current-password" class="block text-sm font-medium text-gray-700">Current Password</label>
        <input type="password" id="current-password" placeholder="Your Name"
            class="mt-1 block w- h-[42px] border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300 mb-4"
            required>

        <label for="new-password" class="block text-sm font-medium text-gray-700">New Password</label>
        <input type="password" id="new-password" placeholder="Your@adresse.mail"
            class="mt-1 block w-2/3 h-[42px] border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300 mb-4"
            required>

        <label for="confirm-new-password" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
        <input type="password" id="confirm-new-password" placeholder="Your@adresse.mail"
            class="mt-1 block w-2/3 h-[42px] border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300 mb-4"
            required>

        <h3 class="mt-4 text-lg font-bold text-gray-700 password">Password requirements:</h3>
        <ul class="list-disc pl-5 text-sm text-gray-600 mb-4">
            <br>
            <li class="requirement">At least 10 characters (and up to 100 characters)</li>
            <li class="requirement">At least one lowercase character</li>
            <li class="requirement">Inclusion of at least one special character, e.g., ! @ # ?</li>
        </ul>

        <button type="submit" class="px-4 py-2 text-white bg-teal-500 hover:bg-teal-600 rounded-lg btn-custom"> Save
            Changes</button>
    </form>

</body>

</html>