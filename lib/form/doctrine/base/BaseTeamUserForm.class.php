<?php

/**
 * TeamUser form base class.
 *
 * @method TeamUser getObject() Returns the current form's model object
 *
 * @package    futebol
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTeamUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'team_id' => new sfWidgetFormInputHidden(),
      'user_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'team_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('team_id')), 'empty_value' => $this->getObject()->get('team_id'), 'required' => false)),
      'user_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('user_id')), 'empty_value' => $this->getObject()->get('user_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('team_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TeamUser';
  }

}
