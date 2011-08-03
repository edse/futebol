<?php

/**
 * Game form base class.
 *
 * @method Game getObject() Returns the current form's model object
 *
 * @package    futebol
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseGameForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'tournament_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tournament'), 'add_empty' => true)),
      'game_ext_id'             => new sfWidgetFormInputText(),
      'date_start'              => new sfWidgetFormDateTime(),
      'date'                    => new sfWidgetFormInputText(),
      'time'                    => new sfWidgetFormInputText(),
      'round'                   => new sfWidgetFormInputText(),
      'home_team_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('HomeTeam'), 'add_empty' => true)),
      'home_team_ext_id'        => new sfWidgetFormInputText(),
      'home_team_logo'          => new sfWidgetFormInputText(),
      'home_team_name'          => new sfWidgetFormInputText(),
      'home_team_initials'      => new sfWidgetFormInputText(),
      'home_team_slug'          => new sfWidgetFormInputText(),
      'home_team_score'         => new sfWidgetFormInputText(),
      'home_team_penalty_score' => new sfWidgetFormInputText(),
      'away_team_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AwayTeam'), 'add_empty' => true)),
      'away_team_ext_id'        => new sfWidgetFormInputText(),
      'away_team_logo'          => new sfWidgetFormInputText(),
      'away_team_name'          => new sfWidgetFormInputText(),
      'away_team_initials'      => new sfWidgetFormInputText(),
      'away_team_slug'          => new sfWidgetFormInputText(),
      'away_team_score'         => new sfWidgetFormInputText(),
      'away_team_penalty_score' => new sfWidgetFormInputText(),
      'stadium_name'            => new sfWidgetFormInputText(),
      'stadium_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Stadium'), 'add_empty' => true)),
      'stadium_ext_id'          => new sfWidgetFormInputText(),
      'url'                     => new sfWidgetFormInputText(),
      'views'                   => new sfWidgetFormInputText(),
      'created_at'              => new sfWidgetFormDateTime(),
      'updated_at'              => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'tournament_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tournament'), 'required' => false)),
      'game_ext_id'             => new sfValidatorInteger(array('required' => false)),
      'date_start'              => new sfValidatorDateTime(),
      'date'                    => new sfValidatorString(array('max_length' => 255)),
      'time'                    => new sfValidatorString(array('max_length' => 255)),
      'round'                   => new sfValidatorString(array('max_length' => 255)),
      'home_team_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('HomeTeam'), 'required' => false)),
      'home_team_ext_id'        => new sfValidatorInteger(array('required' => false)),
      'home_team_logo'          => new sfValidatorString(array('max_length' => 255)),
      'home_team_name'          => new sfValidatorString(array('max_length' => 255)),
      'home_team_initials'      => new sfValidatorString(array('max_length' => 255)),
      'home_team_slug'          => new sfValidatorString(array('max_length' => 255)),
      'home_team_score'         => new sfValidatorInteger(array('required' => false)),
      'home_team_penalty_score' => new sfValidatorInteger(array('required' => false)),
      'away_team_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AwayTeam'), 'required' => false)),
      'away_team_ext_id'        => new sfValidatorInteger(array('required' => false)),
      'away_team_logo'          => new sfValidatorString(array('max_length' => 255)),
      'away_team_name'          => new sfValidatorString(array('max_length' => 255)),
      'away_team_initials'      => new sfValidatorString(array('max_length' => 255)),
      'away_team_slug'          => new sfValidatorString(array('max_length' => 255)),
      'away_team_score'         => new sfValidatorInteger(array('required' => false)),
      'away_team_penalty_score' => new sfValidatorInteger(array('required' => false)),
      'stadium_name'            => new sfValidatorString(array('max_length' => 255)),
      'stadium_id'              => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Stadium'), 'required' => false)),
      'stadium_ext_id'          => new sfValidatorInteger(array('required' => false)),
      'url'                     => new sfValidatorString(array('max_length' => 255)),
      'views'                   => new sfValidatorInteger(array('required' => false)),
      'created_at'              => new sfValidatorDateTime(),
      'updated_at'              => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('game[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Game';
  }

}
