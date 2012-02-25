<?php

/**
 * TeamAsset form base class.
 *
 * @method TeamAsset getObject() Returns the current form's model object
 *
 * @package    futebol
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTeamAssetForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'team_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Team'), 'add_empty' => false)),
      'asset_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Asset'), 'add_empty' => false)),
      'is_active'     => new sfWidgetFormInputCheckbox(),
      'display_order' => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'team_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Team'))),
      'asset_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Asset'))),
      'is_active'     => new sfValidatorBoolean(array('required' => false)),
      'display_order' => new sfValidatorInteger(array('required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('team_asset[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TeamAsset';
  }

}
