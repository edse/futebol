<?php

/**
 * AssetContent form.
 *
 * @package    futebol
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AssetContentForm extends BaseAssetContentForm
{
  public function configure()
  {
    unset($this['asset_id']);

    //$this->widgetSchema['content'] = new sfWidgetFormCKEditor();
    $this->widgetSchema['content'] = new sfWidgetFormCKEditor();

    $this->widgetSchema['headline'] = new sfWidgetFormInputText(array(), array('style' => 'width: 450px;'));
    
  }
}
