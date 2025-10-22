<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Manage Subcategories</h3>
    <a href="<?= base_url('admin/subcategories/add') ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Subcategory
    </a>
</div>

<div class="card">
    <div class="card-body">
        <?php if(!empty($subcategories)): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="25%">Category</th>
                            <th width="25%">Subcategory</th>
                            <th width="20%">Icon Preview</th>
                            <th width="20%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $current_category = '';
                        $subcategory_icons = array(
                            'shoes' => '👞', 'shirts' => '👔', 'pants' => '👖', 'watches' => '⌚',
                            'tops' => '👗', 'jeans' => '👖', 'necklaces' => '💍', 'makeup' => '💄',
                            'toys' => '🧸', 'clothes' => '👕', 'police' => '👮', 'mpsc' => '📘',
                            'upsc' => '📚', 'novels' => '📖', 'chairs' => '🪑', 'tables' => '🪑',
                            'beds' => '🛏️', 'mobiles' => '📱', 'laptops' => '💻', 'earphones' => '🎧'
                        );
                        ?>
                        <?php foreach($subcategories as $subcategory): ?>
                            <?php if($current_category != $subcategory->category_name): ?>
                                <?php $current_category = $subcategory->category_name; ?>
                                <tr class="table-primary">
                                    <td colspan="5" class="fw-bold">
                                        <i class="<?= $subcategory->category_icon ?>"></i>
                                        <?= strtoupper($subcategory->category_name) ?> CATEGORY
                                    </td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <td><?= $subcategory->id ?></td>
                                <td>
                                    <span class="badge bg-info">
                                        <i class="<?= $subcategory->category_icon ?>"></i>
                                        <?= ucfirst($subcategory->category_name) ?>
                                    </span>
                                </td>
                                <td>
                                    <strong><?= ucfirst($subcategory->name) ?></strong>
                                </td>
                                <td class="text-center">
                                    <span style="font-size: 2rem;">
                                        <?= isset($subcategory_icons[$subcategory->name]) ? $subcategory_icons[$subcategory->name] : '📦' ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= base_url('admin/subcategories/edit/' . $subcategory->id) ?>" 
                                           class="btn btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= base_url('admin/subcategories/delete/' . $subcategory->id) ?>" 
                                           class="btn btn-outline-danger" title="Delete"
                                           onclick="return confirm('Are you sure you want to delete this subcategory? All products under this subcategory will be affected.')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-sitemap fa-3x text-muted mb-3"></i>
                <h4>No subcategories found</h4>
                <p class="text-muted">Start by adding your first subcategory.</p>
                <a href="<?= base_url('admin/subcategories/add') ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Subcategory
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>