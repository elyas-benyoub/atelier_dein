<div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-title">
  <div class="modal__header">
    <h3 id="modal-title"><?= e($title ?? 'Message') ?></h3>
    <a href="#" class="modal__close" aria-label="Fermer">×</a>
  </div>

  <div class="modal__content">
    <p class="message"><?= nl2br(e($message ?? '')) ?></p>
  </div>

  <div class="modal__footer">
    <?php if (!empty($actions)): ?>
      <?php foreach ($actions as $btn):
        $label   = $btn['label']   ?? 'OK';
        $href    = $btn['href']    ?? '#';
        $variant = $btn['variant'] ?? 'primary';
      ?>
        <a class="btn btn--<?= e($variant) ?>" href="<?= e($href) ?>"><?= e($label) ?></a>
      <?php endforeach; ?>
    <?php else: ?>
      <a class="btn btn--primary" href="#">OK</a>
    <?php endif; ?>
  </div>
</div>