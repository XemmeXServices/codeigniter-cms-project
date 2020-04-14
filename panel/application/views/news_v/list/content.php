<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      Haber Listesi
      <a href="<?php echo base_url("news/new_form"); ?>" class="btn btn-outline btn-primary btn-xs pull-right">
        <i class="fa fa-plus"></i> Yeni Ekle
      </a>
    </h4>
  </div><!-- END column -->
  <div class="col-md-12">
    <div class="widget p-lg">

      <?php if (empty($items)): ?>

        <div class="alert alert-info text-center">
          <p>Burada herhangi bir veri bulunmamaktadır. Eklemek için lütfen <a
              href="<?php echo base_url("news/new_form"); ?>">tıklayınız</a></p>
        </div>

      <?php else: ?>

        <table class="table table-hover table-striped table-bordered content-container">
          <thead>
          <th><i class="fa fa-reorder"></i></th>
          <th>#id</th>
          <th>Başlık</th>
          <th>Haber Türü</th>
          <th>Görsel</th>
          <th>Durumu</th>
          <th>İşlem</th>
          </thead>
          <tbody class="sortable" data-url="<?= base_url("news/rankSetter") ?>">

          <?php foreach ($items as $item): ?>

            <tr id="ord-<?= $item->id ?>">
              <td class="order w40"><i class="fa fa-reorder"></i></td>
              <td class="order w40">#<?php echo $item->id; ?></td>
              <td><?php echo $item->title; ?></td>
              <td class="order w100"><?php echo $item->news_type ?></td>
              <td class="order">
                <?php if ($item->news_type == "image"): ?>
                  <img
                    width="50"
                    src="<?= base_url("uploads/$viewFolder/$item->img_url") ?>"
                    alt=""
                    class="img-rounded"
                  >
                <?php elseif ($item->news_type == "video"): ?>
                  <iframe
                    class="img-rounded"
                    width="50"
                    height="50"
                    src="https://www.youtube.com/embed/<?= $item->video_url ?>"
                    frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
                <?php endif; ?>
              </td>
              <td class="order w100">
                <input
                  data-url="<?= base_url("news/isActiveSetter/$item->id"); ?>"
                  class="isActive"
                  type="checkbox"
                  data-switchery
                  data-color="#10c469"
                  <?php echo ($item->isActive) ? "checked" : ""; ?>
                />
              </td>
              <td class="order w200">
                <button
                  data-url="<?= base_url("news/delete/$item->id") ?>"
                  class="btn btn-sm btn-danger btn-outline remove-btn"
                >
                  <i class="fa fa-trash"></i> Sil
                </button>
                <a href="<?= base_url("news/update_form/$item->id") ?>" class="btn btn-sm btn-info btn-outline">
                  <i class="fa fa-pencil-square-o"></i> Düzenle
                </a>
              </td>
            </tr>

          <?php endforeach; ?>

          </tbody>

        </table>

      <?php endif; ?>

    </div><!-- .widget -->
  </div><!-- END column -->
</div>