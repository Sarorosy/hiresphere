<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold text-blue-600 mb-6">Dashboard</h1>

    <!-- Jobs Posted Count -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Job Count Card -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-700 flex items-center">Jobs Posted <p class="text-4xl font-bold text-blue-600 ml-3"><?= $jobs_count ?></p></h3>
            

            <div class="bg-white p-2 rounded-lg shadow-md col-span-6">
            <h3 class="text-lg font-semibold text-gray-700">Recent Jobs</h3>
            <ul class="mt-4 space-y-3">
                <?php foreach ($recent_jobs as $job): ?>
                    <li class="bg-gray-100 p-4 rounded-lg shadow-sm">
                        <h4 class="text-xl font-semibold text-gray-800"><?= htmlspecialchars($job->title) ?></h4>
                        <p class="text-sm text-gray-600"><?= date('M d, Y', strtotime($job->created_at)) ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        </div>

        <!-- Recent Jobs Card -->
        
    </div>
</div>
