<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      Yeni Haber Ekle
    </h4>
  </div><!-- END column -->
  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?php echo base_url("news/save"); ?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label>Başlık</label>
            <input class="form-control" placeholder="Başlık" name="title">
            <?php if (isset($form_error)): ?>
              <small class="pull-right input-form-error"><?= form_error("title") ?></small>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <label>Açıklama</label>
            <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}"></textarea>
          </div>
          <div class="form-group">
            <label for="control-demo-6">Haber Türü</label>
            <div id="control-demo-6">
              <select class="form-control news_type_select" name="news_type">
                <option
                  <?= (isset($news_type) && ($news_type == "image")) ? " selected" : null ?>
                  value="image"
                >
                  Resim
                </option>
                <option
                  <?= (isset($news_type) && ($news_type == "video")) ? " selected" : null ?>
                  value="video"
                >
                  Video
                </option>
              </select>
            </div>
          </div>

          <?php if (isset($form_error)): ?>
            <div
              class="form-group image_upload_container"
              style="display: <?= ($news_type == "image") ? "block" : "none" ?>"
            >
              <label>Görsel Seçiniz</label>
              <input type="file" class="form-control" name="img_url">
            </div>

            <div
              class="form-group video_url_container"
              style="display: <?= ($news_type == "video") ? "block" : "none" ?>;"
            >
              <label>Video URL</label>
              <input class="form-control" placeholder="Video bağlantı keyini buraya yapıştırınız (Sadece Youtube Keyleri)" name="video_url">
              <?php if (isset($form_error)): ?>
                <small class="pull-right input-form-error"><?= form_error("video_url") ?></small>
              <?php endif; ?>
            </div>
          <?php else: ?>
            <div class="form-group image_upload_container">
              <label>Görsel Seçiniz</label>
              <input type="file" class="form-control" name="img_url">
            </div>

            <div class="form-group video_url_container">
              <label>Video URL</label>
              <input class="form-control" placeholder="Video bağlantı keyini buraya yapıştırınız (Sadece Youtube Keyleri)" name="video_url">
            </div>
          <?php endif; ?>


          <button type="submit" class="btn btn-primary btn-md btn-outline">Kaydet</button>
          <a href="<?php echo base_url("news"); ?>" class="btn btn-md btn-danger btn-outline">İptal</a>
        </form>
      </div><!-- .widget-body -->
    </div><!-- .widget -->
  </div><!-- END column -->
</div>