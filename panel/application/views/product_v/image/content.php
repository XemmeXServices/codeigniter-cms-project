<div class="row">
  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <form action="<?= base_url("product/image_upload") ?>" class="dropzone" data-plugin="dropzone"
              data-options="{ url: '<?= base_url("product/image_upload") ?>'}">
          <div class="dz-message">
            <h3 class="m-h-lg">Yüklemek istediğiniz resimleri buraya sürükleyiniz.</h3>
            <p class="m-b-lg text-muted">(Yüklemek için dosyalarınızı sürükleyiniz yada buraya tıklayınız)</p>
          </div>
        </form>
      </div><!-- .widget-body -->
    </div><!-- .widget -->
  </div><!-- END column -->
</div>

<div class="row">
  <div class="col-md-12">
    <h4 class="m-b-lg">
      <strong><?= $item->title; ?></strong> Kaydına Ait Resimler
    </h4>
  </div><!-- END column -->
  <div class="col-md-12">
    <div class="widget">
      <div class="widget-body">
        <table class="table table-bordered table-striped table-hover pictures_list">
          <thead>
          <th>#id</th>
          <th>Görsel</th>
          <th>Resim Adı</th>
          <th>Durumu</th>
          <th>İşlem</th>
          </thead>
          <tbody>

          <tr>
            <td class="w100 text-center">#1</td>
            <td class="w100">
              <img width="30" src="https://kablosuzkedi.com/wp-content/uploads/2016/11/KablosuzKedi_2-917x1024.png"
                   alt="" class="img-responsive">
            </td>
            <td>deneme-urun.jpg</td>
            <td class="w100 text-center">
              <input
                data-url="<?= base_url("product/isActiveSetter"); ?>"
                class="isActive"
                type="checkbox"
                data-switchery
                data-color="#10c469"
                <?php echo (true) ? "checked" : ""; ?>
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

          </tbody>
        </table>
      </div><!-- .widget-body -->
    </div><!-- .widget -->
  </div><!-- END column -->
</div>