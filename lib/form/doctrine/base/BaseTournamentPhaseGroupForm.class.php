<?php

/**
 * TournamentPhaseGroup form base class.
 *
 * @method TournamentPhaseGroup getObject() Returns the current form's model object
 *
 * @package    futebol
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTournamentPhaseGroupForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                            => new sfWidgetFormInputHidden(),
      'tournament_phase_group_ext_id' => new sfWidgetFormInputText(),
      'tournament_phase_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TournamentPhase'), 'add_empty' => true)),
      'name'                          => new sfWidgetFormInputText(),
      'description'                   => new sfWidgetFormInputText(),
      'round'                         => new sfWidgetFormInputText(),
      'display_order'                 => new sfWidgetFormInputText(),
      'created_at'                    => new sfWidgetFormDateTime(),
      'updated_at'                    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'tournament_phase_group_ext_id' => new sfValidatorInteger(array('required' => false)),
      'tournament_phase_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TournamentPhase'), 'required' => false)),
      'name'                          => new sfValidatorString(array('max_length' => 255)),
      'description'                   => new sfValidatorString(array('max_length' => 255)),
      'round'                         => new sfValidatorString(array('max_length' => 255)),
      'display_order'                 => new sfValidatorInteger(array('required' => false)),
      'created_at'                    => new sfValidatorDateTime(),
      'updated_at'                    => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('tournament_phase_group[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TournamentPhaseGroup';
  }

}
