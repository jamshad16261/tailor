<div class="pc-container">
    <div class="pc-content">

        <div class="page-header mb-4">
            <h4 class="text-primary"><?= $page_title ?></h4>
        </div>

        <div class="card shadow-sm">

            <div class="card-header bg-white text-primary">
                <h5 class="mb-0">Activity History</h5>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-primary">
                            <tr>
                                <th width="200">Date</th>
                                <th width="150">User</th>
                                <th width="150">Action</th>
                                <th width="150">Module</th>
                                <th>Description</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if (!empty($history)): ?>

                                <?php foreach ($history as $row): ?>

                                    <tr>

                                        <td>
                                            <?= date('d M Y h:i A', strtotime($row->created_at)) ?>
                                        </td>

                                        <td>
                                            <?= $row->name  ?>
                                        </td>

                                        <td>
                                            <span class="badge bg-primary">
                                                <?= ucfirst($row->action) ?>
                                            </span>
                                        </td>

                                        <td>
                                            <?= ucfirst($row->table_name) ?>
                                        </td>

                                        <td>
                                            <?= $row->description ?>
                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>
                                    <td colspan="5" class="text-center text-muted">
                                        No Activity Found
                                    </td>
                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
</div>