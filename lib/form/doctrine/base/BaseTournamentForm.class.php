<?php

/**
 * Tournament form base class.
 *
 * @method Tournament getObject() Returns the current form's model object
 *
 * @package    futebol
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTournamentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'tournament_ext_id' => new sfWidgetFormInputText(),
      'name'              => new sfWidgetFormInputText(),
      'description'       => new sfWidgetFormInputText(),
      'rules'             => new sfWidgetFormInputText(),
      'edition_name'      => new sfWidgetFormInputText(),
      'edition_slug'      => new sfWidgetFormInputText(),
      'edition_ext_id'    => new sfWidgetFormInputText(),
      'views'             => new sfWidgetFormInputText(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
      'slug'              => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'tournament_ext_id' => new sfValidatorInteger(array('required' => false)),
      'name'              => new sfValidatorString(array('max_length' => 255)),
      'description'       => new sfValidatorString(array('max_length' => 255)),
      'rules'             => new sfValidatorPass(array('required' => false)),
      'edition_name'      => new sfValidatorString(array('max_length' => 255)),
      'edition_slug'      => new sfValidatorString(array('max_length' => 255)),
      'edition_ext_id'    => new sfValidatorInteger(array('required' => false)),
      'views'             => new sfValidatorInteger(array('required' => false)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
      'slug'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Tournament', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('tournament[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tournament';
  }

}
