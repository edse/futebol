<?php

/**
 * Feed form base class.
 *
 * @method Feed getObject() Returns the current form's model object
 *
 * @package    futebol
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFeedForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'name'             => new sfWidgetFormInputText(),
      'description'      => new sfWidgetFormInputText(),
      'type'             => new sfWidgetFormInputText(),
      'url'              => new sfWidgetFormInputText(),
      'site_name'        => new sfWidgetFormInputText(),
      'site_url'         => new sfWidgetFormInputText(),
      'date_import'      => new sfWidgetFormDateTime(),
      'is_active'        => new sfWidgetFormInputCheckbox(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
      'slug'             => new sfWidgetFormInputText(),
      'tournaments_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Tournament')),
      'teams_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Team')),
      'games_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Game')),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'             => new sfValidatorString(array('max_length' => 255)),
      'description'      => new sfValidatorString(array('max_length' => 255)),
      'type'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'url'              => new sfValidatorString(array('max_length' => 255)),
      'site_name'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'site_url'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'date_import'      => new sfValidatorDateTime(array('required' => false)),
      'is_active'        => new sfValidatorBoolean(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
      'slug'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'tournaments_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Tournament', 'required' => false)),
      'teams_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Team', 'required' => false)),
      'games_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Game', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Feed', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('feed[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Feed';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['tournaments_list']))
    {
      $this->setDefault('tournaments_list', $this->object->Tournaments->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['teams_list']))
    {
      $this->setDefault('teams_list', $this->object->Teams->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['games_list']))
    {
      $this->setDefault('games_list', $this->object->Games->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveTournamentsList($con);
    $this->saveTeamsList($con);
    $this->saveGamesList($con);

    parent::doSave($con);
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
