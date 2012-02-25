<?php

/**
 * Team form base class.
 *
 * @method Team getObject() Returns the current form's model object
 *
 * @package    futebol
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTeamForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'team_ext_id'   => new sfWidgetFormInputText(),
      'official_name' => new sfWidgetFormInputText(),
      'name'          => new sfWidgetFormInputText(),
      'nickname'      => new sfWidgetFormInputText(),
      'logo'          => new sfWidgetFormInputText(),
      'initials'      => new sfWidgetFormInputText(),
      'description'   => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
      'slug'          => new sfWidgetFormInputText(),
      'users_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser')),
      'feed_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Feed')),
      'asset_list'    => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Asset')),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'team_ext_id'   => new sfValidatorInteger(array('required' => false)),
      'official_name' => new sfValidatorString(array('max_length' => 255)),
      'name'          => new sfValidatorString(array('max_length' => 255)),
      'nickname'      => new sfValidatorString(array('max_length' => 255)),
      'logo'          => new sfValidatorString(array('max_length' => 255)),
      'initials'      => new sfValidatorString(array('max_length' => 255)),
      'description'   => new sfValidatorString(array('max_length' => 255)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
      'slug'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'users_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardUser', 'required' => false)),
      'feed_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Feed', 'required' => false)),
      'asset_list'    => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Asset', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Team', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('team[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Team';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['users_list']))
    {
      $this->setDefault('users_list', $this->object->Users->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['feed_list']))
    {
      $this->setDefault('feed_list', $this->object->Feed->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['asset_list']))
    {
      $this->setDefault('asset_list', $this->object->Asset->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveUsersList($con);
    $this->saveFeedList($con);
    $this->saveAssetList($con);

    parent::doSave($con);
  }

  public function saveUsersList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['users_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Users->getPrimaryKeys();
    $values = $this->getValue('users_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Users', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Users', array_values($link));
    }
  }

  public function saveFeedList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['feed_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Feed->getPrimaryKeys();
    $values = $this->getValue('feed_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Feed', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Feed', array_values($link));
    }
  }

  public function saveAssetList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['asset_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Asset->getPrimaryKeys();
    $values = $this->getValue('asset_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Asset', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Asset', array_values($link));
    }
  }

}
