<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HireSphere - Job Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body class="bg-gray-100">
    <!-- Header -->
<header class="bg-blue-600 text-white py-4">
    <div class="container mx-auto flex justify-between items-center px-2">
        <a href="<?= base_url('/') ?>" class="text-2xl font-bold">
            <img src="<?php echo base_url('public/vector/default-monochrome-white.svg') ?>" class="h-8 md:h-12 w-auto" />
        </a>

        <!-- Mobile Burger Menu Icon -->
        <div class="lg:hidden">
            <button id="burgerMenu" class="text-white focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="hidden lg:flex items-center space-x-6">
            <a href="<?= base_url('/') ?>" class="hover:underline">Home</a>
            <a href="#about" class="hover:underline">About</a>
            <a href="<?= base_url('/all-jobs') ?>" class="hover:underline">Jobs</a>
            <a href="<?= base_url('/contact_us') ?>" class="hover:underline">Contact Us</a>

            <div class="relative">
                <button class="flex items-center bg-blue-600 border border-gray-100 px-4 py-2 rounded-lg hover:bg-blue-700">
                    <span>Sign Up / Login</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="absolute right-0 mt-2 bg-white border rounded shadow-md hidden w-48 z-10" id="dropdownMenu">
                    <a href="<?= base_url('/signup') ?>" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Sign Up as Organization</a>
                    <a href="<?= base_url('/login') ?>" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Login as Organization</a>
                </div>
            </div>
        </nav>
    </div>

    <!-- Mobile Navigation Menu -->
    <div id="mobileMenu" class="lg:hidden hidden bg-blue-600 text-white py-4">
        <nav class="flex flex-col items-center space-y-4">
            <a href="<?= base_url('/') ?>" class="hover:underline">Home</a>
            <a href="#about" class="hover:underline">About</a>
            <a href="<?= base_url('/all-jobs') ?>" class="hover:underline">Jobs</a>
            <a href="<?= base_url('/contact_us') ?>" class="hover:underline">Contact Us</a>
            <div class="relative">
                <button class="flex items-center bg-blue-600 border border-gray-100 px-4 py-2 rounded-lg hover:bg-blue-700">
                    <span>Sign Up / Login</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="absolute right-0 mt-2 bg-white border rounded shadow-md hidden w-48 z-10" id="dropdownMenuMobile">
                    <a href="<?= base_url('/signup') ?>" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Sign Up as Organization</a>
                    <a href="<?= base_url('/login') ?>" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Login as Organization</a>
                </div>
            </div>
        </nav>
    </div>
</header>

<script>
    // JavaScript to toggle mobile menu visibility
    const burgerMenu = document.getElementById('burgerMenu');
    const mobileMenu = document.getElementById('mobileMenu');
    const dropdownMenuMobile = document.getElementById('dropdownMenuMobile');

    burgerMenu.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // Toggle dropdown for mobile view
    document.querySelectorAll('[data-dropdown-toggle="dropdownMenuMobile"]').forEach(button => {
        button.addEventListener('click', () => {
            dropdownMenuMobile.classList.toggle('hidden');
        });
    });
</script>


    <?php $this->load->view($main); ?>
      <!-- Footer -->
<!-- Footer -->
<footer class="bg-gray-800 text-white py-12">
    <div class="container mx-auto px-4">
        <!-- Footer Content (Three Columns) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
            <!-- First Column: Stay Connected (Social Media Links) -->
            <div>
                <p class="text-lg font-semibold mb-4">Stay Connected</p>
                <div class="flex justify-center md:justify-start mb-4 space-x-6">
                    <a href="#" class="text-white text-3xl hover:text-blue-500">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-white text-3xl hover:text-blue-500">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>

            <!-- Second Column: Contact Us, Report Issues, All Jobs -->
            <div>
                <p class="text-lg font-semibold mb-4">Quick Links</p>
                <div class="flex flex-col">
                    <a href="#" class="text-white hover:text-blue-500">Contact Us</a>
                    <a href="#" class="text-white hover:text-blue-500">Report Issues</a>
                    <a href="#" class="text-white hover:text-blue-500">All Jobs</a>
                </div>
            </div>

            <!-- Third Column: Register/Login as Organization -->
            <div>
                <p class="text-lg font-semibold mb-4">Organization</p>
                <div class="flex flex-col">
                    <a href="<?php echo base_url('org/register') ?>" class="text-white hover:text-blue-500">Register as Organization</a>
                    <a href="<?php echo base_url('org/login') ?>" class="text-white hover:text-blue-500">Login as Organization</a>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="text-center mt-8">
            <p>&copy; <?= date('Y') ?> HireSphere. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Font Awesome CDN for social media icons -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>


<!-- Font Awesome CDN for social media icons -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>


    <!-- Dropdown Script -->
    <script>
        const userDropdown = document.getElementById('userDropdown');
        const dropdownMenu = document.getElementById('dropdownMenu');

        userDropdown.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });

        window.addEventListener('click', (e) => {
            if (!userDropdown.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
</body>

</html>