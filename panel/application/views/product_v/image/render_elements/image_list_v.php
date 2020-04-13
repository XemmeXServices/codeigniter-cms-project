<?php if (empty($item_images)): ?>

  <div class="alert alert-info text-center">
    <p>Burada herhangi bir resim bulunmamaktadır.</p>
  </div>

<?php else: ?>

  <table class="table table-bordered table-striped table-hover pictures_list">
    <thead>
    <th><i class="fa fa-reorder"></i></th>
    <th>#id</th>
    <th>Görsel</th>
    <th>Resim Adı</th>
    <th>Durumu</th>
    <th>Kapak</th>
    <th>İşlem</th>
    </thead>
    <tbody class="sortable" data-url="<?= base_url("product/imageRankSetter") ?>">
    <?php foreach ($item_images as $image): ?>
      <tr id="ord-<?= $image->id ?>">
        <td class="w40"><i class="fa fa-reorder"></i></td>
        <td class="w100 text-center"># <?= $image->id ?></td>
        <td class="w100">
          <img width="30" src="<?= base_url("uploads/{$viewFolder}/$image->img_url") ?>"
               alt="" class="img-responsive">
        </td>
        <td><?= $image->img_url ?></td>
        <td class="w100 text-center">
          <input
            data-url="<?= base_url("product/imageActiveSetter/$image->id"); ?>"
            class="isActive"
            type="checkbox"
            data-switchery
            data-color="#10c469"
            <?php echo ($image->isActive) ? "checked" : ""; ?>
          />
        </td>
        <td class="w100 text-center">
          <input
            data-url="<?= base_url("product/isCoverSetter/$image->id/$image->product_id"); ?>"
            class="isCover"
            type="checkbox"
            data-switchery
            data-color="#ff5b5b"
            <?php echo ($image->isCover) ? "checked" : ""; ?>
          />
        </td>
        <td class="w100 text-center">
          <button
            data-url="<?= base_url("product/delete") ?>"
            class="btn btn-sm btn-danger btn-outline remove-btn btn-block"
          >
            <i class="fa fa-trash"></i> Sil
          </button>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>

<?php endif; ?>