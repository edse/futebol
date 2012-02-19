<?php

/**
 * TournamentStandings filter form base class.
 *
 * @package    futebol
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTournamentStandingsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'team_id'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Team'), 'add_empty' => true)),
      'tournament_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tournament'), 'add_empty' => true)),
      'tournament_phase_strip_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TournamentPhaseStrip'), 'add_empty' => true)),
      'rank'                      => new sfWidgetFormFilterInput(),
      'defeats'                   => new sfWidgetFormFilterInput(),
      'draws'                     => new sfWidgetFormFilterInput(),
      'wins'                      => new sfWidgetFormFilterInput(),
      'points'                    => new sfWidgetFormFilterInput(),
      'score_for'                 => new sfWidgetFormFilterInput(),
      'score_against'             => new sfWidgetFormFilterInput(),
      'score_difference'          => new sfWidgetFormFilterInput(),
      'games'                     => new sfWidgetFormFilterInput(),
      'variation'                 => new sfWidgetFormFilterInput(),
      'rate'                      => new sfWidgetFormFilterInput(),
      'display_order'             => new sfWidgetFormFilterInput(),
      'created_at'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'team_id'                   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Team'), 'column' => 'id')),
      'tournament_id'             => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tournament'), 'column' => 'id')),
      'tournament_phase_strip_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TournamentPhaseStrip'), 'column' => 'id')),
      'rank'                      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'defeats'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'draws'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'wins'                      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'points'                    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'score_for'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'score_against'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'score_difference'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'games'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'variation'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'rate'                      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'display_order'             => new sfValidatorPass(array('required' => false)),
      'created_at'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('tournament_standings_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TournamentStandings';
  }

  public function getFields()
  {
    return array(
      'id'                        => 'Number',
      'team_id'                   => 'ForeignKey',
      'tournament_id'             => 'ForeignKey',
      'tournament_phase_strip_id' => 'ForeignKey',
      'rank'                      => 'Number',
      'defeats'                   => 'Number',
      'draws'                     => 'Number',
      'wins'                      => 'Number',
      'points'                    => 'Number',
      'score_for'                 => 'Number',
      'score_against'             => 'Number',
      'score_difference'          => 'Number',
      'games'                     => 'Number',
      'variation'                 => 'Number',
      'rate'                      => 'Number',
      'display_order'             => 'Text',
      'created_at'                => 'Date',
      'updated_at'                => 'Date',
    );
  }
}
