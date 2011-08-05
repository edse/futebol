<?php

/**
 * TournamentPhaseStrip filter form base class.
 *
 * @package    futebol
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTournamentPhaseStripFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tournament_phase_strip_ext_id' => new sfWidgetFormFilterInput(),
      'tournament_phase_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TournamentPhase'), 'add_empty' => true)),
      'name'                          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'display_order'                 => new sfWidgetFormFilterInput(),
      'created_at'                    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'tournament_phase_strip_ext_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tournament_phase_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TournamentPhase'), 'column' => 'id')),
      'name'                          => new sfValidatorPass(array('required' => false)),
      'description'                   => new sfValidatorPass(array('required' => false)),
      'display_order'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'                    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('tournament_phase_strip_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TournamentPhaseStrip';
  }

  public function getFields()
  {
    return array(
      'id'                            => 'Number',
      'tournament_phase_strip_ext_id' => 'Number',
      'tournament_phase_id'           => 'ForeignKey',
      'name'                          => 'Text',
      'description'                   => 'Text',
      'display_order'                 => 'Number',
      'created_at'                    => 'Date',
      'updated_at'                    => 'Date',
    );
  }
}
