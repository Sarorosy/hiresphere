<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organization Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-lg bg-white rounded-lg shadow-md p-6">
        <div class="w-full flex items-center justify-center rounded my-2">
            <img src="<?php echo base_url('public/vector/default-monochrome-black.svg') ?>" class="h-12 w-auto my-1 rounded" />
        </div>
        <hr />
        <h2 class="text-2xl font-bold text-center text-blue-900 mt-1">Organization Register</h2>
        <form action="<?= base_url('OrgLogin/register') ?>" method="POST" class="mt-4">
            <?php if (validation_errors()): ?>
                <div class="text-red-500 text-sm"><?= validation_errors() ?></div>
            <?php endif; ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700">Organization Name</label>
                <input type="text" name="org_name" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Contact Number</label>
                <input type="text" name="contact_number" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300" required>
            </div>
            
            
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Address</label>
                <textarea name="address" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-300" required></textarea>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Register</button>
        </form>
        <p class="text-sm text-center text-gray-600 mt-4">Already have an account? <a href="<?= base_url('OrgLogin/login') ?>" class="text-blue-500 hover:underline">Login</a></p>
    </div>
</body>

</html>