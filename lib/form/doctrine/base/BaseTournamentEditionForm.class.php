<?php

/**
 * TournamentEdition form base class.
 *
 * @method TournamentEdition getObject() Returns the current form's model object
 *
 * @package    futebol
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseTournamentEditionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                        => new sfWidgetFormInputHidden(),
      'tournament_edition_ext_id' => new sfWidgetFormInputText(),
      'tournament_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Tournament'), 'add_empty' => true)),
      'name'                      => new sfWidgetFormInputText(),
      'description'               => new sfWidgetFormInputText(),
      'rules'                     => new sfWidgetFormInputText(),
      'location'                  => new sfWidgetFormInputText(),
      'date_start'                => new sfWidgetFormDateTime(),
      'date_end'                  => new sfWidgetFormDateTime(),
      'created_at'                => new sfWidgetFormDateTime(),
      'updated_at'                => new sfWidgetFormDateTime(),
      'slug'                      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                        => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'tournament_edition_ext_id' => new sfValidatorInteger(array('required' => false)),
      'tournament_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Tournament'), 'required' => false)),
      'name'                      => new sfValidatorString(array('max_length' => 255)),
      'description'               => new sfValidatorString(array('max_length' => 255)),
      'rules'                     => new sfValidatorPass(array('required' => false)),
      'location'                  => new sfValidatorString(array('max_length' => 255)),
      'date_start'                => new sfValidatorDateTime(),
      'date_end'                  => new sfValidatorDateTime(),
      'created_at'                => new sfValidatorDateTime(),
      'updated_at'                => new sfValidatorDateTime(),
      'slug'                      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'TournamentEdition', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('tournament_edition[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'TournamentEdition';
  }

}
