<?php

/**
 * GameFeed form base class.
 *
 * @method GameFeed getObject() Returns the current form's model object
 *
 * @package    futebol
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGameFeedForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'game_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Game'), 'add_empty' => false)),
      'feed_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Feed'), 'add_empty' => false)),
      'is_active'     => new sfWidgetFormInputCheckbox(),
      'display_order' => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'game_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Game'))),
      'feed_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Feed'))),
      'is_active'     => new sfValidatorBoolean(array('required' => false)),
      'display_order' => new sfValidatorInteger(array('required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('game_feed[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'GameFeed';
  }

}
