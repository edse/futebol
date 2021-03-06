<?php

/**
 * Game filter form base class.
 *
 * @package    futebol
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseGameFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tournament_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tournament'), 'add_empty' => true)),
      'tournament_edition_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('TournamentEdition'), 'add_empty' => true)),
      'game_ext_id'             => new sfWidgetFormFilterInput(),
      'date_start'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'date'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'time'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'round'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'home_team_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('HomeTeam'), 'add_empty' => true)),
      'home_team_ext_id'        => new sfWidgetFormFilterInput(),
      'home_team_logo'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'home_team_name'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'home_team_initials'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'home_team_slug'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'home_team_score'         => new sfWidgetFormFilterInput(),
      'home_team_penalty_score' => new sfWidgetFormFilterInput(),
      'away_team_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AwayTeam'), 'add_empty' => true)),
      'away_team_ext_id'        => new sfWidgetFormFilterInput(),
      'away_team_logo'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'away_team_name'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'away_team_initials'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'away_team_slug'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'away_team_score'         => new sfWidgetFormFilterInput(),
      'away_team_penalty_score' => new sfWidgetFormFilterInput(),
      'stadium_name'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'stadium_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Stadium'), 'add_empty' => true)),
      'stadium_ext_id'          => new sfWidgetFormFilterInput(),
      'url'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'feed_list'               => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Feed')),
      'asset_list'              => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Asset')),
    ));

    $this->setValidators(array(
      'tournament_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Tournament'), 'column' => 'id')),
      'tournament_edition_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('TournamentEdition'), 'column' => 'id')),
      'game_ext_id'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'date_start'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'date'                    => new sfValidatorPass(array('required' => false)),
      'time'                    => new sfValidatorPass(array('required' => false)),
      'round'                   => new sfValidatorPass(array('required' => false)),
      'home_team_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('HomeTeam'), 'column' => 'id')),
      'home_team_ext_id'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'home_team_logo'          => new sfValidatorPass(array('required' => false)),
      'home_team_name'          => new sfValidatorPass(array('required' => false)),
      'home_team_initials'      => new sfValidatorPass(array('required' => false)),
      'home_team_slug'          => new sfValidatorPass(array('required' => false)),
      'home_team_score'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'home_team_penalty_score' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'away_team_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AwayTeam'), 'column' => 'id')),
      'away_team_ext_id'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'away_team_logo'          => new sfValidatorPass(array('required' => false)),
      'away_team_name'          => new sfValidatorPass(array('required' => false)),
      'away_team_initials'      => new sfValidatorPass(array('required' => false)),
      'away_team_slug'          => new sfValidatorPass(array('required' => false)),
      'away_team_score'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'away_team_penalty_score' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'stadium_name'            => new sfValidatorPass(array('required' => false)),
      'stadium_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Stadium'), 'column' => 'id')),
      'stadium_ext_id'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'url'                     => new sfValidatorPass(array('required' => false)),
      'created_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'feed_list'               => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Feed', 'required' => false)),
      'asset_list'              => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Asset', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('game_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addFeedListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.GameFeed GameFeed')
      ->andWhereIn('GameFeed.feed_id', $values)
    ;
  }

  public function addAssetListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.GameAsset GameAsset')
      ->andWhereIn('GameAsset.asset_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Game';
  }

  public function getFields()
  {
    return array(
      'id'                      => 'Number',
      'tournament_id'           => 'ForeignKey',
      'tournament_edition_id'   => 'ForeignKey',
      'game_ext_id'             => 'Number',
      'date_start'              => 'Date',
      'date'                    => 'Text',
      'time'                    => 'Text',
      'round'                   => 'Text',
      'home_team_id'            => 'ForeignKey',
      'home_team_ext_id'        => 'Number',
      'home_team_logo'          => 'Text',
      'home_team_name'          => 'Text',
      'home_team_initials'      => 'Text',
      'home_team_slug'          => 'Text',
      'home_team_score'         => 'Number',
      'home_team_penalty_score' => 'Number',
      'away_team_id'            => 'ForeignKey',
      'away_team_ext_id'        => 'Number',
      'away_team_logo'          => 'Text',
      'away_team_name'          => 'Text',
      'away_team_initials'      => 'Text',
      'away_team_slug'          => 'Text',
      'away_team_score'         => 'Number',
      'away_team_penalty_score' => 'Number',
      'stadium_name'            => 'Text',
      'stadium_id'              => 'ForeignKey',
      'stadium_ext_id'          => 'Number',
      'url'                     => 'Text',
      'created_at'              => 'Date',
      'updated_at'              => 'Date',
      'feed_list'               => 'ManyKey',
      'asset_list'              => 'ManyKey',
    );
  }
}
