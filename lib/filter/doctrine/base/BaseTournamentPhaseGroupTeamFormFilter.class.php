<?php

/**
 * TournamentPhaseGroupTeam filter form base class.
 *
 * @package    futebol
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTournamentPhaseGroupTeamFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tournament_phase_group_team_ext_id' => new sfWidgetFormFilterInput(),
      'tournament_phase_group_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TournamentPhaseGroup'), 'add_empty' => true)),
      'team_id'                            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Team'), 'add_empty' => true)),
      'label'                              => new sfWidgetFormFilterInput(),
      'display_order'                      => new sfWidgetFormFilterInput(),
      'rank'                               => new sfWidgetFormFilterInput(),
      'created_at'                         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'tournament_phase_group_team_ext_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tournament_phase_group_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TournamentPhaseGroup'), 'column' => 'id')),
      'team_id'                            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Team'), 'column' => 'id')),
      'label'                              => new sfValidatorPass(array('required' => false)),
      'display_order'                      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rank'                               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'                         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('tournament_phase_group_team_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TournamentPhaseGroupTeam';
  }

  public function getFields()
  {
    return array(
      'id'                                 => 'Number',
      'tournament_phase_group_team_ext_id' => 'Number',
      'tournament_phase_group_id'          => 'ForeignKey',
      'team_id'                            => 'ForeignKey',
      'label'                              => 'Text',
      'display_order'                      => 'Number',
      'rank'                               => 'Number',
      'created_at'                         => 'Date',
      'updated_at'                         => 'Date',
    );
  }
}
