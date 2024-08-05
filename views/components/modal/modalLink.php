<!-- Modal -->
<div class="modal fade" id="<?= $id ?>" tabindex="-1" aria-hidden="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="<?= $id ?>"><?= $title ?? 'delete' ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= $content ?>
            </div>
            <div class="modal-footer">
                <a id="clickBtn" type="button" class="btn btn-primary">đồng ý</a>
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    không
                </button>
            </div>
        </div>
    </div>
</div>
<!-- sử lý modal -->
<script>
    const modalLink = document.getElementById('<?= $id ?>')
    const btnList = document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target="#<?= $id ?>"]');
    btnList.forEach(function(btn) {
        btn.onclick = function(e) {
            if (e.currentTarget.classList.contains('active')) {
                e.currentTarget.classList.remove('active')
            }
            e.target.classList.add('active');
        }
    })
    modalLink.addEventListener('shown.bs.modal', () => {
        const btnModalLink = document.querySelector('[data-bs-toggle="modal"][data-bs-target="#<?= $id ?>"].active');
        console.log(btnModalLink.dataset.value);
        modalLink.querySelector('#clickBtn').href = btnModalLink.dataset.value;
    })
</script>