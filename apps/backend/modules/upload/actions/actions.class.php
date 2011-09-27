<?php

/**
 * upload actions.
 *
 * @package    astolfo
 * @subpackage upload
 * @author     Emerson Estrella
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class uploadActions extends sfActions {
  /**
   * Executes index action
   *
   * @param sfRequest $request A request object
   */
  public function executeIndex(sfWebRequest $request) {
    //$this->forward('default', 'module');
    if(!$this->getUser()->isAuthenticated())
      $this->forward('index', 'login');
  }

  public function executeUpload(sfWebRequest $request) {
    set_time_limit(0);
    //ini_set("upload_max_filesize", "1700M");
    //ini_set("post_max_size", "1700M");
    //ini_set("memory_limit", "1700M");
    //ini_set("max_input_time", "3600");
    //ini_set("max_execution_time", "3600");
    //ini_set("display_errors", -1);

    if(!$this->getUser()->isAuthenticated())
      $this->forward('index', 'login');

    foreach($request->getFiles() as $fileName) {
      // Upload to server
      $fileSize = $fileName['size'];
      $fileType = $fileName['type'];
      $theFileName = @strtolower($fileName['name']);
      $theFileExtension = @strtolower(@end(@explode('.', $fileName['name'])));
      $theFileWithoutExtension = @current(@explode('.' . $theFileExtension, $theFileName));
      $theNewFileName = sha1(md5($theFileWithoutExtension.time())).".".$theFileExtension;
      $theNewFileNameWithoutExtension = @current(@explode('.'.$theFileExtension, $theNewFileName));

      // Retrieve a setting
      //var_dump(sfConfig::get('app_mediaextensions_video'));
      //var_dump(sfConfig::get('app_mediaextensions_audio'));
      //var_dump(sfConfig::get('app_mediaextensions_image'));

      $obj = new Asset();
      $obj->setTitle($theFileWithoutExtension);
      $obj->setUserId($this->getUser()->getGuardUser()->getId());

      if(in_array($theFileExtension, sfConfig::get('app_mediaextensions_video'))) {
        //video
        $uploadDir = sfConfig::get('sf_upload_dir') . '/assets/video';
        $uploadDirOriginal = sfConfig::get('sf_upload_dir') . '/assets/video/original';
        if(!is_dir($uploadDir))
          mkdir($uploadDir, 0777);
        if(!is_dir($uploadDirOriginal))
          mkdir($uploadDirOriginal, 0777);
        move_uploaded_file($fileName['tmp_name'], "$uploadDirOriginal/$theNewFileName");

        $obj->setAssetTypeId(Doctrine_Core::getTable('AssetType')->findoneBySlug('video')->getId());
        $obj->save();

        $vid = new AssetVideo();
        $vid->setAssetId($obj->getId());
        $vid->setFile($theNewFileNameWithoutExtension);
        $vid->setOriginalFile($theNewFileName);
        $vid->setOriginalFileSize($vid->formatBytes(filesize("$uploadDirOriginal/$theNewFileName")));
        $info = $vid->ffmpegVideoInfo("$uploadDirOriginal/$theNewFileName");
        if(isset($info["width"]))
          $vid->setWidth($info["width"]);
        if(isset($info["height"]))
          $vid->setHeight($info["height"]);
        if(isset($info["framerate"]))
          $vid->setFrameRate($info["framerate"]);
        if(isset($info["duration"]))
          $vid->setDuration($info["duration"]);
        $vid->setExtension($theFileExtension);
        $vid->save();

        $dropbox = new VideoDropbox();
        $dropbox->asset_video_id = $vid->getId();
        $dropbox->action = "Insert";
        $dropbox->status = "Pendding";
        $dropbox->save();

      } elseif(in_array($theFileExtension, sfConfig::get('app_mediaextensions_audio'))) {
        //audio

        $uploadDir = sfConfig::get('sf_upload_dir') . '/assets/audio';
        $uploadDirOriginal = sfConfig::get('sf_upload_dir') . '/assets/audio/original';
        if(!is_dir($uploadDir))
          mkdir($uploadDir, 0777);
        if(!is_dir($uploadDirOriginal))
          mkdir($uploadDirOriginal, 0777);
        move_uploaded_file($fileName['tmp_name'], "$uploadDirOriginal/$theNewFileName");

        $obj->setAssetTypeId(Doctrine_Core::getTable('AssetType')->findoneBySlug('audio')->getId());
        $obj->save();
        
        $audio = new AssetAudio();
        $audio->setAssetId($obj->getId());
        $audio->setFile($theNewFileNameWithoutExtension);
        $audio->setOriginalFile($theNewFileName);
        $audio->setOriginalFileSize($audio->formatBytes(filesize("$uploadDirOriginal/$theNewFileName")));
        $audio->setExtension($theFileExtension);
        $audio->save();
        $audio->convert();

      } elseif(in_array($theFileExtension, sfConfig::get('app_mediaextensions_image'))) {
        //image

        $uploadDir = sfConfig::get('sf_upload_dir') . '/assets/image';
        $uploadDirOriginal = sfConfig::get('sf_upload_dir') . '/assets/image/original';
        if(!is_dir($uploadDir))
          mkdir($uploadDir, 0777);
        if(!is_dir($uploadDirOriginal))
          mkdir($uploadDirOriginal, 0777);
        move_uploaded_file($fileName['tmp_name'], "$uploadDirOriginal/$theNewFileName");

        if(($theFileExtension == 'jpg') || ($theFileExtension == 'jpeg')) {
          $image_resource = imagecreatefromjpeg("$uploadDirOriginal/$theNewFileName");
        } elseif($theFileExtension == 'png') {
          $image_resource = imagecreatefrompng("$uploadDirOriginal/$theNewFileName");
        } elseif($theFileExtension == 'gif') {
          $image_resource = imagecreatefromgif("$uploadDirOriginal/$theNewFileName");
        } elseif($theFileExtension == 'bmp') {
          $image_resource = imagecreatefrombmp("$uploadDirOriginal/$theNewFileName");
        }

        $obj->setAssetTypeId(Doctrine_Core::getTable('AssetType')->findoneBySlug('image')->getId());
        $obj->save();
        $img = new AssetImage();
        $img->setAssetId($obj->getId());
        $img->setFile($theNewFileNameWithoutExtension);
        $img->setOriginalFile($theNewFileName);
        $img->setOriginalFileSize($img->formatBytes(filesize("$uploadDirOriginal/$theNewFileName")));
        $img->setWidth(imagesx($image_resource));
        $img->setHeight(imagesy($image_resource));
        $img->setExtension($theFileExtension);
        $img->save();
        
        $img->convertAndResize();
      } else {
        //other
        $uploadDir = sfConfig::get('sf_upload_dir') . '/assets/file';
        $uploadDirOriginal = sfConfig::get('sf_upload_dir') . '/assets/file/original';
        if(!is_dir($uploadDir))
          mkdir($uploadDir, 0777);
        if(!is_dir($uploadDirOriginal))
          mkdir($uploadDirOriginal, 0777);
        move_uploaded_file($fileName['tmp_name'], "$uploadDirOriginal/$theNewFileName");
        
        $obj->setAssetTypeId(Doctrine_Core::getTable('AssetType')->findoneBySlug('file')->getId());
        $obj->save();
        
        $file = new AssetFile();
        $file->setAssetId($obj->getId());
        //$file->setFile($theFileWithoutExtension);
        $file->setFile($theNewFileName);
        $file->setFileSize($file->formatBytes(filesize("$uploadDirOriginal/$theNewFileName")));
        $file->setExtension($theFileExtension);
        $file->save();
      }

    }

    // add todo taks
    $todo = new Todo();
    $todo->setUserId($this->getUser()->getGuardUser()->getId());
    $todo->setAssetId($obj->getId());
    $todo->setTitle("Adicionar metadados no asset: $theFileName");
    $todo->setStatus("Pendding");
    $todo->save();
    die($obj->getId());
    //return sfView::NONE;

  }

}
