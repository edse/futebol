<?php

/**
 * Asset form base class.
 *
 * @method Asset getObject() Returns the current form's model object
 *
 * @package    futebol
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAssetForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'asset_type_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AssetType'), 'add_empty' => false)),
      'user_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => false)),
      'title'            => new sfWidgetFormInputText(),
      'description'      => new sfWidgetFormInputText(),
      'is_active'        => new sfWidgetFormInputCheckbox(),
      'views'            => new sfWidgetFormInputText(),
      'ugc'              => new sfWidgetFormInputCheckbox(),
      'date_start'       => new sfWidgetFormDateTime(),
      'date_end'         => new sfWidgetFormDateTime(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
      'slug'             => new sfWidgetFormInputText(),
      'teams_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Team')),
      'tournaments_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Tournament')),
      'games_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Game')),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'asset_type_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AssetType'))),
      'user_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'))),
      'title'            => new sfValidatorString(array('max_length' => 255)),
      'description'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_active'        => new sfValidatorBoolean(array('required' => false)),
      'views'            => new sfValidatorInteger(array('required' => false)),
      'ugc'              => new sfValidatorBoolean(array('required' => false)),
      'date_start'       => new sfValidatorDateTime(array('required' => false)),
      'date_end'         => new sfValidatorDateTime(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
      'slug'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'teams_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Team', 'required' => false)),
      'tournaments_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Tournament', 'required' => false)),
      'games_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Game', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Asset', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('asset[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Asset';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['teams_list']))
    {
      $this->setDefault('teams_list', $this->object->Teams->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['tournaments_list']))
    {
      $this->setDefault('tournaments_list', $this->object->Tournaments->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['games_list']))
    {
      $this->setDefault('games_list', $this->object->Games->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveTeamsList($con);
    $this->saveTournamentsList($con);
    $this->saveGamesList($con);

    parent::doSave($con);
  }

  public function saveTeamsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['teams_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Teams->getPrimaryKeys();
    $values = $this->getValue('teams_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Teams', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Teams', array_values($link));
    }
  }

  public function saveTournamentsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['tournaments_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Tournaments->getPrimaryKeys();
    $values = $this->getValue('tournaments_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Tournaments', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Tournaments', array_values($link));
    }
  }

  public function saveGamesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['games_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Games->getPrimaryKeys();
    $values = $this->getValue('games_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Games', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Games', array_values($link));
    }
  }

}
