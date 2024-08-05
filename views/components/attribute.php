<?php
if (!empty($attribute) && count($attribute) > 0) : ?>
    <?php foreach ($attribute as $valueParent) : ?>
        <div class="flex-w flex-r-m p-b-10">
            <div class="size-203 flex-c-m respon6">
                <?= $valueParent['name'] ?>
            </div>
            <div class="size-204 respon6-next attt-list">
                <?php foreach ($valueParent['children'] as $value) : ?>
                    <input type="radio" class="btn-check" name="attr[<?= $valueParent['id'] ?>]" id="<?= $value['value'] . $value['id'] ?>" autocomplete="off" value="<?= $value['id'] ?>" onchange="changeAttributes(event)">
                    <label class="btn" for="<?= $value['value'] . $value['id'] ?>"><?= $value['name'] ?></label>
                <?php endforeach ?>
            </div>
        </div>
    <?php endforeach ?>
<?php endif ?>
<script>
    function changeAttributes(e) {
        const listAttr = document.querySelectorAll('.attt-list');
        const currentIndex = Array.from(listAttr).indexOf(e.currentTarget.parentElement);
        fetch('?controller=Attribute&action=attributes_products&id=<?= $_GET['id'] ?>&attr=' + e.currentTarget.value)
            .then(res => res.json())
            .then((data) => {
                listAttr.forEach(function(attr, index) {
                    if (index !== currentIndex) {
                        attr.querySelectorAll('input[class="btn-check"]').forEach(function(inputAttr) {
                            const isValueArray = data.some(function(data) {
                                return data.attribute_id === Number(inputAttr.value);
                            })
                            console.log(isValueArray);
                            inputAttr.disabled = !Boolean(isValueArray);
                        })
                    }
                })
            });
    }
</script>