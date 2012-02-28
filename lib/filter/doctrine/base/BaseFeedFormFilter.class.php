<?php

/**
 * Feed filter form base class.
 *
 * @package    futebol
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFeedFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'type'             => new sfWidgetFormFilterInput(),
      'url'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'site_name'        => new sfWidgetFormFilterInput(),
      'site_url'         => new sfWidgetFormFilterInput(),
      'date_import'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'is_active'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'slug'             => new sfWidgetFormFilterInput(),
      'tournaments_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Tournament')),
      'teams_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Team')),
      'games_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Game')),
    ));

    $this->setValidators(array(
      'name'             => new sfValidatorPass(array('required' => false)),
      'description'      => new sfValidatorPass(array('required' => false)),
      'type'             => new sfValidatorPass(array('required' => false)),
      'url'              => new sfValidatorPass(array('required' => false)),
      'site_name'        => new sfValidatorPass(array('required' => false)),
      'site_url'         => new sfValidatorPass(array('required' => false)),
      'date_import'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'is_active'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'slug'             => new sfValidatorPass(array('required' => false)),
      'tournaments_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Tournament', 'required' => false)),
      'teams_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Team', 'required' => false)),
      'games_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Game', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('feed_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addTournamentsListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.TournamentFeed TournamentFeed')
      ->andWhereIn('TournamentFeed.tournament_id', $values)
    ;
  }

  public function addTeamsListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.TeamFeed TeamFeed')
      ->andWhereIn('TeamFeed.team_id', $values)
    ;
  }

  public function addGamesListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('GameFeed.game_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Feed';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'name'             => 'Text',
      'description'      => 'Text',
      'type'             => 'Text',
      'url'              => 'Text',
      'site_name'        => 'Text',
      'site_url'         => 'Text',
      'date_import'      => 'Date',
      'is_active'        => 'Boolean',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
      'slug'             => 'Text',
      'tournaments_list' => 'ManyKey',
      'teams_list'       => 'ManyKey',
      'games_list'       => 'ManyKey',
    );
  }
}
