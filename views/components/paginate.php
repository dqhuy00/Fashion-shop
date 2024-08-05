<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php if (count($page) > 0) : ?>
            <?php if ($page['current_page'] > 1) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= currentRouter([...$_GET, 'page' => 1]) ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php endif ?>
            <?php for ($i = 1; $i <= $page['total_pages']; $i++) : ?>
                <?php if ($i < $page['current_page'] + 3 && $i > $page['current_page'] - 3) : ?>
                    <li class="page-item  <?= (!empty($_GET['page']) && $_GET['page'] != '' ?? 1) == $i ? 'active' : '' ?> "><a class="page-link" href="<?= currentRouter([...$_GET, 'page' => $i]) ?>"><?= $i ?></a></li>
                <?php endif ?>
            <?php endfor; ?>
            <?php if ($page['current_page'] < $page['total_pages']) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= currentRouter([...$_GET, 'page' => $page['total_pages']]) ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php endif ?>
        <?php endif ?>

    </ul>
</nav>