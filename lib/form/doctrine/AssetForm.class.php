<?php

/**
 * Asset form.
 *
 * @package    futebol
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AssetForm extends BaseAssetForm
{
  public function configure()
  {
    unset($this['games_list']);
    
    $q = Doctrine_Query::create()
      ->select('t.*')
      ->from('Tournament t')
      ->orderBy('t.name');
    $this->widgetSchema['tournaments_list'] = new sfWidgetFormDoctrineChoice(array(
      'model'        => 'Tournament',                  
      'renderer_class' => 'sfWidgetFormSelectDoubleList',
      'query' => $q,
      'renderer_options' => array(
        'label_unassociated' => 'Todos',
        'label_associated' => 'Relacionados',
        'associated_first' => false
       )
    ));
    $this->validatorSchema['tournaments_list'] = new sfValidatorPass();

    $q = Doctrine_Query::create()
      ->select('t.*')
      ->from('Team t')
      ->orderBy('t.name');
    $this->widgetSchema['teams_list'] = new sfWidgetFormDoctrineChoice(array(
      'model'        => 'Team',                  
      'renderer_class' => 'sfWidgetFormSelectDoubleList',
      'query' => $q,
      'renderer_options' => array(
        'label_unassociated' => 'Todos',
        'label_associated' => 'Relacionados',
        'associated_first' => false
       )
    ));
    $this->validatorSchema['teams_list'] = new sfValidatorPass();

    $this->widgetSchema['user_id'] = new sfWidgetFormDoctrineChoice(array(
      'model'     => 'sfGuardUser',
      'add_empty' => 'Select an user'
    ));

    $this->widgetSchema['asset_type_id'] = new sfWidgetFormDoctrineChoice(array(
      'model'     => 'AssetType',
      'add_empty' => 'Select the type of this asset'
    ));

    if($this->object->id > 0){
      //unset($this['asset_type_id']);
      $asset = Doctrine_Core::getTable('Asset')->find($this->object->id);
      $this->embedRelation('Asset'.$asset->getAssetType()->getModel());
    }

  }
}
