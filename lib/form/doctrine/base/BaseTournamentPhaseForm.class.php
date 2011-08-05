<?php

/**
 * TournamentPhase form base class.
 *
 * @method TournamentPhase getObject() Returns the current form's model object
 *
 * @package    futebol
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTournamentPhaseForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'tournament_phase_ext_id' => new sfWidgetFormInputText(),
      'name'                    => new sfWidgetFormInputText(),
      'description'             => new sfWidgetFormInputText(),
      'display_order'           => new sfWidgetFormInputText(),
      'location'                => new sfWidgetFormInputText(),
      'type'                    => new sfWidgetFormInputText(),
      'classification_type'     => new sfWidgetFormInputText(),
      'is_active'               => new sfWidgetFormInputCheckbox(),
      'created_at'              => new sfWidgetFormDateTime(),
      'updated_at'              => new sfWidgetFormDateTime(),
      'slug'                    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'tournament_phase_ext_id' => new sfValidatorInteger(array('required' => false)),
      'name'                    => new sfValidatorString(array('max_length' => 255)),
      'description'             => new sfValidatorString(array('max_length' => 255)),
      'display_order'           => new sfValidatorInteger(array('required' => false)),
      'location'                => new sfValidatorString(array('max_length' => 255)),
      'type'                    => new sfValidatorString(array('max_length' => 255)),
      'classification_type'     => new sfValidatorString(array('max_length' => 255)),
      'is_active'               => new sfValidatorBoolean(array('required' => false)),
      'created_at'              => new sfValidatorDateTime(),
      'updated_at'              => new sfValidatorDateTime(),
      'slug'                    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'TournamentPhase', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('tournament_phase[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TournamentPhase';
  }

}
