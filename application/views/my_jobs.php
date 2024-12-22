<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold text-blue-600 mb-6">My Jobs</h1>

    <?php if ($this->session->flashdata('success')): ?>
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="bg-red-500 text-white p-3 rounded mb-4">
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

    <!-- DataTable -->
    <div class="bg-white rounded p-4 shadow-md">
        <table id="jobsTable" class="display w-full text-sm text-left text-gray-700">
            <thead>
                <tr>
                    <th class="py-2 px-4">Job Title</th>
                    <th class="py-2 px-4">Description</th>
                    <th class="py-2 px-4">Location</th>
                    <th class="py-2 px-4">Salary</th>
                    <th class="py-2 px-4">Skills</th>
                    <th class="py-2 px-4">Created On</th>
                    <th class="py-2 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jobs as $job): ?>
                    <tr>
                        <td class="py-2 px-4"><?= htmlspecialchars($job->title) ?></td>
                        <td class="py-2 px-4">
                            <?php
                                // Trim the description to 40 words
                                $trimmed_description = implode(' ', array_slice(explode(' ', $job->description), 0, 10)) . '...';
                            ?>
                            <?= $trimmed_description ?>
                        </td>
                        <td class="py-2 px-4"><?= htmlspecialchars($job->location) ?></td>
                        <td class="py-2 px-4"><?= htmlspecialchars($job->salary) ?></td>
                        <td class="py-2 px-4">
                            <?php
                                // Explode skills and display the first 3
                                $skills = explode(',', $job->skills);
                                foreach (array_slice($skills, 0, 3) as $skill): ?>
                                    <span class="inline-block bg-blue-100 text-blue-600 text-xs font-medium px-2 py-1 rounded-full mr-2">
                                        <?= htmlspecialchars(trim($skill)) ?>
                                    </span>
                            <?php endforeach; ?>
                        </td>
                        <td class="py-2 px-4"><?= date('M d, Y', strtotime($job->created_at)) ?></td>
                        <td class="py-2 px-4">
                            <a href="<?= base_url('jobs/edit/' . base64_encode($job->id)) ?>" class="text-blue-600 hover:text-blue-800">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Include jQuery and DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#jobsTable').DataTable({
            responsive: true
        });
    });
</script>
