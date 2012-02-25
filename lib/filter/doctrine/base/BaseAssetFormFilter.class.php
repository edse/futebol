<?php

/**
 * Asset filter form base class.
 *
 * @package    futebol
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseAssetFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'asset_type_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AssetType'), 'add_empty' => true)),
      'user_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'title'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'      => new sfWidgetFormFilterInput(),
      'is_active'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'views'            => new sfWidgetFormFilterInput(),
      'ugc'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'date_start'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'date_end'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'slug'             => new sfWidgetFormFilterInput(),
      'teams_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Team')),
      'tournaments_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Tournament')),
      'games_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Game')),
    ));

    $this->setValidators(array(
      'asset_type_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AssetType'), 'column' => 'id')),
      'user_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('sfGuardUser'), 'column' => 'id')),
      'title'            => new sfValidatorPass(array('required' => false)),
      'description'      => new sfValidatorPass(array('required' => false)),
      'is_active'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'views'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ugc'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'date_start'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'date_end'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'slug'             => new sfValidatorPass(array('required' => false)),
      'teams_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Team', 'required' => false)),
      'tournaments_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Tournament', 'required' => false)),
      'games_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Game', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('asset_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
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
      ->leftJoin($query->getRootAlias().'.TeamAsset TeamAsset')
      ->andWhereIn('TeamAsset.team_id', $values)
    ;
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
      ->leftJoin($query->getRootAlias().'.TournamentAsset TournamentAsset')
      ->andWhereIn('TournamentAsset.tournament_id', $values)
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
      ->leftJoin($query->getRootAlias().'.GameAsset GameAsset')
      ->andWhereIn('GameAsset.game_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Asset';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'asset_type_id'    => 'ForeignKey',
      'user_id'          => 'ForeignKey',
      'title'            => 'Text',
      'description'      => 'Text',
      'is_active'        => 'Boolean',
      'views'            => 'Number',
      'ugc'              => 'Boolean',
      'date_start'       => 'Date',
      'date_end'         => 'Date',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
      'slug'             => 'Text',
      'teams_list'       => 'ManyKey',
      'tournaments_list' => 'ManyKey',
      'games_list'       => 'ManyKey',
    );
  }
}
