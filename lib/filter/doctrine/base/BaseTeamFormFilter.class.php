<?php

/**
 * Team filter form base class.
 *
 * @package    futebol
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseTeamFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'team_ext_id'   => new sfWidgetFormFilterInput(),
      'official_name' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'name'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nickname'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'logo'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'initials'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'slug'          => new sfWidgetFormFilterInput(),
      'users_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
      'feed_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Feed')),
      'asset_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Asset')),
    ));

    $this->setValidators(array(
      'team_ext_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'official_name' => new sfValidatorPass(array('required' => false)),
      'name'          => new sfValidatorPass(array('required' => false)),
      'nickname'      => new sfValidatorPass(array('required' => false)),
      'logo'          => new sfValidatorPass(array('required' => false)),
      'initials'      => new sfValidatorPass(array('required' => false)),
      'description'   => new sfValidatorPass(array('required' => false)),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'slug'          => new sfValidatorPass(array('required' => false)),
      'users_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
      'feed_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Feed', 'required' => false)),
      'asset_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Asset', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('team_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addUsersListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.TeamUser TeamUser')
      ->andWhereIn('TeamUser.user_id', $values)
    ;
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
      ->leftJoin($query->getRootAlias().'.TeamFeed TeamFeed')
      ->andWhereIn('TeamFeed.feed_id', $values)
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
      ->leftJoin($query->getRootAlias().'.TeamAsset TeamAsset')
      ->andWhereIn('TeamAsset.asset_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Team';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'team_ext_id'   => 'Number',
      'official_name' => 'Text',
      'name'          => 'Text',
      'nickname'      => 'Text',
      'logo'          => 'Text',
      'initials'      => 'Text',
      'description'   => 'Text',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
      'slug'          => 'Text',
      'users_list'    => 'ManyKey',
      'feed_list'     => 'ManyKey',
      'asset_list'    => 'ManyKey',
    );
  }
}
