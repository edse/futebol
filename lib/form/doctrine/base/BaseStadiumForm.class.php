<?php

/**
 * Stadium form base class.
 *
 * @method Stadium getObject() Returns the current form's model object
 *
 * @package    futebol
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseStadiumForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'stadium_ext_id' => new sfWidgetFormInputText(),
      'official_name'  => new sfWidgetFormInputText(),
      'name'           => new sfWidgetFormInputText(),
      'nickname'       => new sfWidgetFormInputText(),
      'capacity'       => new sfWidgetFormInputText(),
      'address'        => new sfWidgetFormInputText(),
      'inauguration'   => new sfWidgetFormInputText(),
      'location'       => new sfWidgetFormInputText(),
      'geo_location'   => new sfWidgetFormInputText(),
      'views'          => new sfWidgetFormInputText(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
      'slug'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'stadium_ext_id' => new sfValidatorInteger(array('required' => false)),
      'official_name'  => new sfValidatorString(array('max_length' => 255)),
      'name'           => new sfValidatorString(array('max_length' => 255)),
      'nickname'       => new sfValidatorString(array('max_length' => 255)),
      'capacity'       => new sfValidatorString(array('max_length' => 255)),
      'address'        => new sfValidatorString(array('max_length' => 255)),
      'inauguration'   => new sfValidatorString(array('max_length' => 255)),
      'location'       => new sfValidatorString(array('max_length' => 255)),
      'geo_location'   => new sfValidatorString(array('max_length' => 255)),
      'views'          => new sfValidatorInteger(array('required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
      'slug'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Stadium', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('stadium[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Stadium';
  }

}
