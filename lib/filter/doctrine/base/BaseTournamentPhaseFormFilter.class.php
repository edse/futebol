<?php

/**
 * TournamentPhase filter form base class.
 *
 * @package    futebol
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTournamentPhaseFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tournament_phase_ext_id' => new sfWidgetFormFilterInput(),
      'name'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'display_order'           => new sfWidgetFormFilterInput(),
      'location'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'type'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'classification_type'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_active'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'slug'                    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'tournament_phase_ext_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'name'                    => new sfValidatorPass(array('required' => false)),
      'description'             => new sfValidatorPass(array('required' => false)),
      'display_order'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'location'                => new sfValidatorPass(array('required' => false)),
      'type'                    => new sfValidatorPass(array('required' => false)),
      'classification_type'     => new sfValidatorPass(array('required' => false)),
      'is_active'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'slug'                    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tournament_phase_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TournamentPhase';
  }

  public function getFields()
  {
    return array(
      'id'                      => 'Number',
      'tournament_phase_ext_id' => 'Number',
      'name'                    => 'Text',
      'description'             => 'Text',
      'display_order'           => 'Number',
      'location'                => 'Text',
      'type'                    => 'Text',
      'classification_type'     => 'Text',
      'is_active'               => 'Boolean',
      'created_at'              => 'Date',
      'updated_at'              => 'Date',
      'slug'                    => 'Text',
    );
  }
}
