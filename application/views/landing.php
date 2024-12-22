<!-- Banner Section -->
<section class="relative text-white py-20 text-center" style="background-image: url('<?= base_url('public/banner.jpg') ?>'); background-size: cover; background-position: center;">
    <!-- Black Overlay -->
    <div class="absolute inset-0 bg-black opacity-70"></div>

    <!-- Banner Content -->
    <h1 class="text-4xl font-bold relative">HireSphere Job Portal</h1>
    <p class="mt-4 text-lg relative">Find jobs with verified companies and opportunities</p>

    <!-- Additional Content -->
    <div class="relative mt-6">
        <h2 class="text-2xl font-semibold">Over 10,000+ Job Openings</h2>
        <p class="mt-2 text-lg">Explore job opportunities across various industries with top verified companies</p>
    </div>

    <!-- Call to Action -->
    <div class="relative mt-8">
        <a href="<?= base_url('all-jobs') ?>" class="inline-block bg-yellow-500 text-white px-6 py-3 rounded-lg text-xl font-semibold hover:bg-yellow-600 transition duration-300">Browse All Jobs</a>
        <a href="<?= base_url('contact_us') ?>" class="inline-block bg-blue-500 text-white px-6 py-3 rounded-lg ml-4 text-xl font-semibold hover:bg-blue-600 transition duration-300">Contact Us</a>
    </div>
</section>




<!-- About Section -->
<section id="about" class="py-20 bg-gray-100 text-center">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold mb-6">About HireSphere</h2>
        <p class="text-gray-600 mb-4">HireSphere is a trusted platform connecting job seekers with verified companies to help them find the best job opportunities. Our mission is to bridge the gap between talented professionals and top-tier employers, ensuring that both sides benefit from a seamless hiring experience.</p>
        <p class="text-gray-600">With a wide range of job listings, from startups to well-established organizations, HireSphere ensures that job seekers can explore diverse opportunities while helping companies find the right talent for their needs. Whether you're looking for your next career move or hiring for your team, HireSphere is here to make the process easier, faster, and more reliable.</p>
    </div>
</section>

<!-- Recent Jobs Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8 text-center">Recent Jobs</h2>

        <!-- Check if there are any recent jobs -->
        <?php if (!empty($recent_jobs)): ?>
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($recent_jobs as $job): ?>
                    <div class="bg-white rounded-lg shadow-lg flex flex-col">
                        <!-- Card Header (Company Info) -->
                        <div class="flex items-center gap-4 p-6 border-b">
                            <div class="w-12 h-12 rounded-full overflow-hidden">
                                <?php if (empty($job->profile_pic)): ?>
                                    <!-- Display first name with a background color if profile_pic is null -->
                                    <div class="w-full h-full bg-gray-700 text-white flex items-center justify-center text-sm font-bold">
                                        <?php echo strtoupper(substr($job->company_name, 0, 1)); // Display the first letter of the company name 
                                        ?>
                                    </div>
                                <?php else: ?>
                                    <!-- Display profile picture -->
                                    <img src="<?= base_url($job->profile_pic) ?>" alt="<?= htmlspecialchars($job->company_name) ?>" class="w-full h-full object-cover">
                                <?php endif; ?>
                            </div>

                            <div>
                                <h3 class="text-xl font-semibold"><?= htmlspecialchars($job->title) ?></h3>
                                <p class="text-sm text-gray-500"><?= htmlspecialchars($job->company_name) ?></p>
                            </div>
                        </div>

                        <div class="flex-grow p-6">
                            <?php
                            $description_words = explode(' ', $job->description);

                            if (count($description_words) > 15) {
                                $description = implode(' ', array_slice($description_words, 0, 15)) . '...';
                            } else {
                                $description = $job->description;
                            }
                            ?>

                            <p class="text-sm text-gray-700 mb-4 line-clamp-3"><?= $description ?></p>

                            <p class="text-sm text-gray-600 mb-2"><i class="fas fa-map-marker-alt mr-2 text-blue-700"></i><?= htmlspecialchars($job->location) ?></p>
                            <p class="text-sm text-gray-600 mb-2"><i class="fas fa-briefcase mr-2 text-blue-700"></i><?= htmlspecialchars($job->experience) ?> Years Experience</p>
                            <p class="text-sm text-gray-600 mb-2"><i class="fas fa-dollar-sign mr-2 text-blue-700"></i><?= htmlspecialchars($job->salary) ?> per month</p>

                            <!-- Skills Section (Comma Separated) -->
                            <div class="flex flex-wrap gap-2 mt-2">
                                <?php
                                $skills = explode(',', $job->skills);
                                foreach ($skills as $skill): ?>
                                    <span class="bg-blue-100 text-blue-600 py-1 px-3 rounded-full text-sm"><?= trim($skill) ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Card Footer (Buttons) -->
                        <div class="flex justify-between p-6 border-t">
                            <a href="<?= base_url('job-detail/' . base64_encode($job->id)) ?>" class="text-black border p-2 rounded hover:bg-black hover:text-white">View Details</a>
                            <a href="<?= base_url('job-detail/' . base64_encode($job->id)) ?>" class=" border p-2 rounded bg-black text-white">Apply</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-gray-600 text-center">No recent jobs available at the moment.</p>
        <?php endif; ?>
    </div>
</section>

<!-- Job Site Stats Section -->
<section class="py-20 bg-white text-center">
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold mb-6">JOB SITE STATS</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <!-- Job Seekers -->
            <div class="stat-item bg-white p-6 rounded-lg shadow-lg hover:bg-blue-100 transition-all duration-300">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-users text-4xl text-blue-500"></i>
                </div>
                <h3 class="text-4xl font-bold text-blue-500">1000 +</h3>
                <p class="text-lg text-gray-600">Job Seekers</p>
            </div>

            <!-- Recruiters -->
            <div class="stat-item bg-white p-6 rounded-lg shadow-lg hover:bg-blue-100 transition-all duration-300">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-briefcase text-4xl text-blue-500"></i>
                </div>
                <h3 class="text-4xl font-bold text-blue-500">500 +</h3>
                <p class="text-lg text-gray-600">Recruiters</p>
            </div>

            <!-- Active Jobs -->
            <div class="stat-item bg-white p-6 rounded-lg shadow-lg hover:bg-blue-100 transition-all duration-300">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-clipboard-list text-4xl text-blue-500"></i>
                </div>
                <h3 class="text-4xl font-bold text-blue-500">1000 +</h3>
                <p class="text-lg text-gray-600">Active Jobs</p>
            </div>

            <!-- Companies -->
            <div class="stat-item bg-white p-6 rounded-lg shadow-lg hover:bg-blue-100 transition-all duration-300">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-building text-4xl text-blue-500"></i>
                </div>
                <h3 class="text-4xl font-bold text-blue-500">400 +</h3>
                <p class="text-lg text-gray-600">Companies</p>
            </div>
        </div>
    </div>
</section>