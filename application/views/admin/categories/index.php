<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Manage Categories</h3>
    <a href="<?= base_url('admin/categories/add') ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Category
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Icon</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($categories as $category): ?>
                        <tr>
                            <td><?= $category->id ?></td>
                            <td><i class="<?= $category->icon ?> fa-2x"></i></td>
                            <td><?= ucfirst($category->name) ?></td>
                            <td>
                                <span class="badge bg-<?= $category->status == 'active' ? 'success' : 'secondary' ?>">
                                    <?= ucfirst($category->status) ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/categories/delete/' . $category->id) ?>" 
                                   class="btn btn-sm btn-outline-danger"
                                   onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>