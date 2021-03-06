<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      <strong><?= $item->title ?></strong> kaydını düzenliyorsunuz
    </h4>
  </div><!-- END column -->
  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?php echo base_url("reference/update/$item->id"); ?>" method="post"
              enctype="multipart/form-data">
          <div class="form-group">
            <label>Başlık</label>
            <input class="form-control" placeholder="Başlık" name="title" value="<?= $item->title ?>">
            <?php if (isset($form_error)): ?>
              <small class="pull-right input-form-error"><?= form_error("title") ?></small>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <label>Açıklama</label>
            <textarea name="description" class="m-0" data-plugin="summernote"
                      data-options="{height: 250}"><?= $item->description ?></textarea>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-md-2 image_upload_container">
                <img
                  style="width: 100px; height: 100px;"
                  src="<?= base_url("uploads/$viewFolder/$item->img_url") ?>"
                  alt=""
                  class="img-responsive">
              </div>
              <div class="col-md-10 form-group image_upload_container">
                <label>Görsel Seçiniz</label>
                <input type="file" class="form-control" name="img_url">
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-success btn-md btn-outline">Güncelle</button>
          <a href="<?php echo base_url("reference"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
        </form>
      </div><!-- .widget-body -->
    </div><!-- .widget -->
  </div><!-- END column -->
</div>