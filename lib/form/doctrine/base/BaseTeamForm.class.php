<?php

/**
 * Team form base class.
 *
 * @method Team getObject() Returns the current form's model object
 *
 * @package    futebol
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTeamForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'team_ext_id'   => new sfWidgetFormInputText(),
      'official_name' => new sfWidgetFormInputText(),
      'name'          => new sfWidgetFormInputText(),
      'nickname'      => new sfWidgetFormInputText(),
      'logo'          => new sfWidgetFormInputText(),
      'initials'      => new sfWidgetFormInputText(),
      'description'   => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
      'slug'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'team_ext_id'   => new sfValidatorInteger(array('required' => false)),
      'official_name' => new sfValidatorString(array('max_length' => 255)),
      'name'          => new sfValidatorString(array('max_length' => 255)),
      'nickname'      => new sfValidatorString(array('max_length' => 255)),
      'logo'          => new sfValidatorString(array('max_length' => 255)),
      'initials'      => new sfValidatorString(array('max_length' => 255)),
      'description'   => new sfValidatorString(array('max_length' => 255)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
      'slug'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Team', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('team[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Team';
  }

}
