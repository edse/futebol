<?php

/**
 * TournamentPhaseGroupTeam form base class.
 *
 * @method TournamentPhaseGroupTeam getObject() Returns the current form's model object
 *
 * @package    futebol
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTournamentPhaseGroupTeamForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                                 => new sfWidgetFormInputHidden(),
      'tournament_phase_group_team_ext_id' => new sfWidgetFormInputText(),
      'tournament_phase_group_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TournamentPhaseGroup'), 'add_empty' => true)),
      'team_id'                            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Team'), 'add_empty' => true)),
      'label'                              => new sfWidgetFormInputText(),
      'display_order'                      => new sfWidgetFormInputText(),
      'rank'                               => new sfWidgetFormInputText(),
      'created_at'                         => new sfWidgetFormDateTime(),
      'updated_at'                         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'tournament_phase_group_team_ext_id' => new sfValidatorInteger(array('required' => false)),
      'tournament_phase_group_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TournamentPhaseGroup'), 'required' => false)),
      'team_id'                            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Team'), 'required' => false)),
      'label'                              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'display_order'                      => new sfValidatorInteger(array('required' => false)),
      'rank'                               => new sfValidatorInteger(array('required' => false)),
      'created_at'                         => new sfValidatorDateTime(),
      'updated_at'                         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('tournament_phase_group_team[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TournamentPhaseGroupTeam';
  }

}
