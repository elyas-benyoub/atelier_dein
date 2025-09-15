<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1><?= e($title) ?></h1>
            <p>Modifier le livre</p>
        </div>

        <form method="POST" enctype="multipart/form-data" action="<?= url('book/handle_edit_book?id=' . $book['id']); ?>" class="auth-form">
            <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">

            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" id="title" name="title" value="<?= e($book['title']); ?>" required>
            </div>

            <div class="form-group">
                <label for="author">Auteur</label>
                <input type="text" id="author" name="author" value="<?= e($book['author']); ?>" required>
            </div>

            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="number" id="isbn" name="isbn" value="<?= e($book['isbn']); ?>" required>
            </div>

            <div class="form-group">
                <label for="pages">Nombre de pages</label>
                <input type="number" id="pages" name="pages" value="<?= e($book['pages']); ?>" required>
            </div>

            <div class="form-group">
                <label for="resume">Résumé</label>
                <textarea id="resume" name="resume" required><?= e($book['resume']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="pb_year">Année de publication</label>
                <input type="number" id="pb_year" name="pb_year" min="1900" max="9999" value="<?= e($book['pb_year']); ?>" required>
            </div>

            <div class="form-group">
                <label for="img_cover">Image de couverture</label>
                <input type="file" id="img_cover" name="img_cover">
                <?php if (!empty($book['image_path'])): ?>
                    <p>Image actuelle: <img src="<?= BASE_URL . $book['image_path']; ?>" style="width:60px;height:auto;border-radius:4px;"></p>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label>Genres</label>
                <div class="checkbox-list">
                    <?php foreach ($genres as $id => $name): ?>
                        <label class="chk">
                            <input type="checkbox" name="genres[]" value="<?= $id ?>"
                                <?= (!empty($book_genres) && in_array($id, $book_genres)) ? 'checked' : '' ?>>
                            <?= e($name) ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <button type="submit" name="action" value="edit" class="btn btn-primary btn-full">
                <i class="fas fa-edit"></i>
                Modifier
            </button>
        </form>
    </div>
</div>
