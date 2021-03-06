<?php

class Reference extends CI_Controller
{
  public $viewFolder = "";

  public function __construct()
  {
    parent::__construct();
    $this->viewFolder = "reference_v";
    $this->load->model("reference_model");
  }

  public function index()
  {
    $viewData = new stdClass();
    $items = $this->reference_model->get_all(
      array(),
      "rank ASC"
    );

    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "list";
    $viewData->items = $items;
    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function new_form()
  {
    $viewData = new stdClass();
    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "add";
    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function save()
  {
    $this->load->library("form_validation");

    $reference_type = $this->input->post("reference_type");

    if ($_FILES["img_url"]["name"] == "") {
      $alert = array(
        "title" => "İşlem başarısızdır",
        "text" => "Lütfen bir görsel seçiniz",
        "type" => "error"
      );
      $this->session->set_flashdata("alert", $alert);
      redirect(base_url("reference/new_form"));
      die();
    }

    $this->form_validation->set_rules("title", "Başlık", "required|trim");

    $this->form_validation->set_message(
      array(
        "required" => "<b>{field}</b> alanı doldurulmalıdır"
      )
    );

    $validate = $this->form_validation->run(); // run() -> true veya false döner.

    if ($validate) {

      $file_name = convertToSEO(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . '.' . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);

      $config = array(
        "allowed_types" => "jpg|jpeg|png",
        "upload_path" => "uploads/$this->viewFolder/",
        "file_name" => $file_name
      );

      $this->load->library("upload", $config);
      $upload = $this->upload->do_upload("img_url");

      if ($upload) {
        $uploaded_file = $this->upload->data("file_name");
        $insert = $this->reference_model->add(
          array(
            "title" => $this->input->post("title"),
            "description" => $this->input->post("description"),
            "url" => convertToSEO($this->input->post("title")),
            "img_url" => $uploaded_file,
            "rank" => 0,
            "isActive" => true,
            "createdAt" => date("Y-m-d H:i:s")
          )
        );

        if ($insert) {
          $alert = array(
            "title" => "İşlem başarılı",
            "text" => "Kayıt başarılı bir şekilde eklendi",
            "type" => "success"
          );
        } else {
          $alert = array(
            "title" => "İşlem başarısızdır",
            "text" => "Kayıt eklenirken bir hata oluştu",
            "type" => "error"
          );
        }

      } else {
        $alert = array(
          "title" => "İşlem başarısızdır",
          "text" => "Görsel yüklenirken bir problem oluştu",
          "type" => "error"
        );
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("reference/new_form"));
        die();
      }

      /** İşlemin sonucunu sessiona yazıyoruz */
      $this->session->set_flashdata("alert", $alert);
      redirect(base_url("reference"));
    } else {
      // Hata dönüşleri
      $viewData = new stdClass();
      $viewData->viewFolder = $this->viewFolder;
      $viewData->subViewFolder = "add";
      $viewData->form_error = true;
      $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

  }

  public function update_form($id)
  {
    $viewData = new stdClass();

    $item = $this->reference_model->get(
      array(
        "id" => $id
      )
    );
    $viewData->viewFolder = $this->viewFolder;
    $viewData->subViewFolder = "update";
    $viewData->item = $item;
    $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
  }

  public function update($id)
  {
    $this->load->library("form_validation");

    $this->form_validation->set_rules("title", "Başlık", "required|trim");

    $this->form_validation->set_message(
      array(
        "required" => "<b>{field}</b> alanı doldurulmalıdır"
      )
    );

    $validate = $this->form_validation->run(); // run() -> true veya false döner.

    if ($validate) {
      if ($_FILES["img_url"]["name"] !== "") {
        $file_name = convertToSEO(pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME)) . '.' . pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);

        $config = array(
          "allowed_types" => "jpg|jpeg|png",
          "upload_path" => "uploads/$this->viewFolder/",
          "file_name" => $file_name
        );

        $this->load->library("upload", $config);
        $upload = $this->upload->do_upload("img_url");

        if ($upload) {
          $uploaded_file = $this->upload->data("file_name");

          $data = array(
            "title" => $this->input->post("title"),
            "description" => $this->input->post("description"),
            "url" => convertToSEO($this->input->post("title")),
            "img_url" => $uploaded_file,
          );
        } else {
          $alert = array(
            "title" => "İşlem başarısızdır",
            "text" => "Görsel yüklenirken bir problem oluştu",
            "type" => "error"
          );
          $this->session->set_flashdata("alert", $alert);
          redirect(base_url("reference/update_form/$id"));
          die();
        }
      } else {
        $data = array(
          "title" => $this->input->post("title"),
          "description" => $this->input->post("description"),
          "url" => convertToSEO($this->input->post("title"))
        );
      }

      $update = $this->reference_model->update(array(
        "id" => $id
      ), $data);

      if ($update) {
        $alert = array(
          "title" => "İşlem başarılı",
          "text" => "Kayıt başarılı bir şekilde güncellendi",
          "type" => "success"
        );
      } else {
        $alert = array(
          "title" => "İşlem başarısızdır",
          "text" => "Kayıt güncellenirken bir hata oluştu",
          "type" => "error"
        );
      }

      /** İşlemin sonucunu sessiona yazıyoruz */
      $this->session->set_flashdata("alert", $alert);
      redirect(base_url("reference"));
    } else {
      // Hata dönüşleri
      $viewData = new stdClass();
      $viewData->viewFolder = $this->viewFolder;
      $viewData->subViewFolder = "update";
      $viewData->form_error = true;

      $item = $this->reference_model->get(
        array(
          "id" => $id
        )
      );
      $viewData->item = $item;
      $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

  }

  public function delete($id)
  {
    $delete = $this->reference_model->delete(
      array(
        "id" => $id
      )
    );
    // TODO alert sistemi gerçekleştirilecek
    if ($delete) {
      $alert = array(
        "title" => "İşlem başarılı",
        "text" => "Kayıt başarılı bir şekilde silindi",
        "type" => "success"
      );
    } else {
      $alert = array(
        "title" => "İşlem başarısızdır",
        "text" => "Kayıt silinirken bir hata oluştu",
        "type" => "error"
      );
    }

    /** İşlemin sonucunu sessiona yazıyoruz */
    $this->session->set_flashdata("alert", $alert);
    redirect(base_url("reference"));
  }

  public function isActiveSetter($id)
  {
    if ($id) {
      $isActive = ($this->input->post("data")) === "true" ? 1 : 0;

      $this->reference_model->update(array(
        "id" => $id
      ), array(
        "isActive" => $isActive
      ));
    }
  }

  public function rankSetter()
  {
    $data = $this->input->post("data");
    parse_str($data, $order);
    $items = $order["ord"];

    foreach ($items as $rank => $id) {
      $this->reference_model->update(
        array(
          "id" => $id,
          "rank !=" => $rank
        ),
        array(
          "rank" => $rank
        )
      );
    }
  }

}
