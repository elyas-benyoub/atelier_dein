<div class="page-header">
    <div class="container">
        <h1><?php e($title); ?></h1>
    </div>
</div>

<section class="content">
    <div class="container">
        <div class="content-grid">
            <div class="content-main">
                <h1><?php e($message); ?></h1>
                <ul>
                    <?php foreach($loans as $loan): ?>
                        <li><?= e($loan['title']) ?> : retour le => <?= e(format_date($loan['due_date'])) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>