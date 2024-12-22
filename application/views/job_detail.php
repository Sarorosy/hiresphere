<div class="min-h-screen bg-gray-100">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <h1 class="text-3xl font-bold text-gray-900">Job Details</h1>

                <a href="<?= base_url('all-jobs') ?>" class="flex items-center text-primary hover:text-primary/80">
                    <i class="fas fa-long-arrow-alt-left mr-2 text-gray-800"></i>
                    Back to Job Listings
                </a>

            </div>
        </div>
    </header>
    <?php if ($this->session->flashdata('success')): ?>
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4 border border-green-300">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4 border border-red-300">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Job Details Section -->
                <div class="lg:w-2/3">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-4">
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
                                    <h2 class="text-2xl font-semibold"><?= $job->title ?></h2>
                                    <p class="text-gray-600"><?= $job->company_name ?></p>
                                </div>
                            </div>
                            <span class="px-4 py-2 text-sm bg-green-500 text-white rounded-full"><?= ucfirst($job->job_type) ?></span>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-map-marker-alt mr-2 text-gray-800"></i>
                                <?= $job->location ?>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-history mr-2"></i>
                                <?= $job->experience ?> years experience required
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-rupee-sign mr-2 text-gray-800"></i>
                                <?= $job->salary ?> per month
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-calendar-day mr-2 text-gray-800"></i>
                                Posted on: <?= date('d M Y', strtotime($job->created_at)) ?>
                            </div>
                        </div>

                        <div class="mt-6">
                            <h3 class="text-lg font-semibold">Description:</h3>
                            <p class="text-sm text-gray-600"><?= $job->description ?></p>
                        </div>

                        <div class="mt-6">
                            <h3 class="text-lg font-semibold">Skills:</h3>
                            <div class="flex flex-wrap gap-2">
                                <?php foreach (explode(',', $job->skills) as $skill): ?>
                                    <span class="inline-block px-4 py-2 text-sm text-white bg-blue-500 rounded-full"><?= trim($skill) ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Apply Section -->
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-semibold mb-4">Apply for this Job</h2>
                        <form action="<?= base_url('jobs/apply/' . base64_encode($job->id)) ?>" method="POST" class="space-y-4" enctype="multipart/form-data">
                            <div class="space-y-2">
                                <label for="name" class="block text-sm font-medium text-gray-700">Full Name <span class="text-sm text-red-500">*</span></label>
                                <input type="text" id="name" name="name" placeholder="John Doe" class="w-full p-2 border border-gray-300 rounded-lg" required>
                            </div>
                            <div class="space-y-2">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email <span class="text-sm text-red-500">*</span></label>
                                <input type="email" id="email" name="email" placeholder="john@example.com" class="w-full p-2 border border-gray-300 rounded-lg" required>
                            </div>
                            <div class="space-y-2">
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number <span class="text-sm text-red-500">*</span></label>
                                <input type="tel" id="phone" name="phone" placeholder="+1 987654321" class="w-full p-2 border border-gray-300 rounded-lg" required>
                            </div>
                            <div class="space-y-2">
                                <label for="resume" class="block text-sm font-medium text-gray-700">Resume/CV <span class="text-sm text-red-500">*</span></label>
                                <input type="file" id="resume" name="resume" class="w-full p-2 border border-gray-300 rounded-lg" required > 
                            </div>

                            <!-- Education -->
                            <div class="space-y-2">
                                <label for="education" class="block text-sm font-medium text-gray-700">Education</label>
                                <textarea id="education" name="education" placeholder="List your educational qualifications" class="w-full p-2 border border-gray-300 rounded-lg"></textarea>
                            </div>
                            <div class="space-y-2">
                                <label for="cover-letter" class="block text-sm font-medium text-gray-700">Cover Letter <span class="text-sm text-red-500">*</span></label>
                                <textarea id="cover-letter" name="cover-letter" placeholder="Why do you think you're a good fit for this role?" class="w-full p-2 border border-gray-300 rounded-lg" required></textarea>
                            </div>

                            <button type="submit" class="w-full py-2 px-4 text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                                Submit Application
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </main>
</div>