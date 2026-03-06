<div class="pc-container">
    <div class="pc-content">

        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h4 class="mb-0">My Profile</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5>User Details</h5>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-6">
                        <label>Name:</label>
                        <p><?= htmlspecialchars($user->name) ?></p>
                    </div>

                    <div class="col-md-6">
                        <label>Email:</label>
                        <p><?= htmlspecialchars($user->email) ?></p>
                    </div>

                    <div class="col-md-6">
                        <label>Phone:</label>
                        <p><?= htmlspecialchars($user->phone ?? '-') ?></p>
                    </div>

                    <div class="col-md-6">
                        <label>Role:</label>
                        <p><?= ucfirst($user->role ?? '-') ?></p>
                    </div>

                    <div class="col-md-6">
                        <label>Joined On:</label>
                        <p><?= date('d M, Y', strtotime($user->created_at)) ?></p>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>