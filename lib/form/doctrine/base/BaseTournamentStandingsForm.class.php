<?php

/**
 * TournamentStandings form base class.
 *
 * @method TournamentStandings getObject() Returns the current form's model object
 *
 * @package    futebol
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTournamentStandingsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                        => new sfWidgetFormInputHidden(),
      'team_id'                   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Team'), 'add_empty' => true)),
      'tournament_phase_strip_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TournamentPhaseStrip'), 'add_empty' => true)),
      'rank'                      => new sfWidgetFormInputText(),
      'defeats'                   => new sfWidgetFormInputText(),
      'draws'                     => new sfWidgetFormInputText(),
      'wins'                      => new sfWidgetFormInputText(),
      'points'                    => new sfWidgetFormInputText(),
      'score_for'                 => new sfWidgetFormInputText(),
      'score_against'             => new sfWidgetFormInputText(),
      'score_difference'          => new sfWidgetFormInputText(),
      'games'                     => new sfWidgetFormInputText(),
      'variation'                 => new sfWidgetFormInputText(),
      'display_order'             => new sfWidgetFormInputText(),
      'created_at'                => new sfWidgetFormDateTime(),
      'updated_at'                => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'team_id'                   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Team'), 'required' => false)),
      'tournament_phase_strip_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('TournamentPhaseStrip'), 'required' => false)),
      'rank'                      => new sfValidatorNumber(array('required' => false)),
      'defeats'                   => new sfValidatorInteger(array('required' => false)),
      'draws'                     => new sfValidatorInteger(array('required' => false)),
      'wins'                      => new sfValidatorInteger(array('required' => false)),
      'points'                    => new sfValidatorNumber(array('required' => false)),
      'score_for'                 => new sfValidatorInteger(array('required' => false)),
      'score_against'             => new sfValidatorInteger(array('required' => false)),
      'score_difference'          => new sfValidatorInteger(array('required' => false)),
      'games'                     => new sfValidatorInteger(array('required' => false)),
      'variation'                 => new sfValidatorInteger(array('required' => false)),
      'display_order'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'                => new sfValidatorDateTime(),
      'updated_at'                => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('tournament_standings[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TournamentStandings';
  }

}
