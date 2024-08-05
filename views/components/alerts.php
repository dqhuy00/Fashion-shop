<div class="w-100">
    <?php if (!empty($message['success']) || !empty($message['error'])) : ?>
        <div class="alert <?= !empty($message['success']) ? 'alert-success' : 'alert-danger ' ?> alert-dismissible" role="alert">
            <?= $message['success'] ?? $message['error'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif ?>
</div>