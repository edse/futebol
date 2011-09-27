<?php

/**
 * BaseAssetQuestion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $asset_id
 * @property integer $asset_questionnaire_id
 * @property string $question
 * @property Asset $Asset
 * @property AssetQuestionnaire $AssetQuestionnaire
 * @property Doctrine_Collection $Answers
 * 
 * @method integer             getAssetId()                Returns the current record's "asset_id" value
 * @method integer             getAssetQuestionnaireId()   Returns the current record's "asset_questionnaire_id" value
 * @method string              getQuestion()               Returns the current record's "question" value
 * @method Asset               getAsset()                  Returns the current record's "Asset" value
 * @method AssetQuestionnaire  getAssetQuestionnaire()     Returns the current record's "AssetQuestionnaire" value
 * @method Doctrine_Collection getAnswers()                Returns the current record's "Answers" collection
 * @method AssetQuestion       setAssetId()                Sets the current record's "asset_id" value
 * @method AssetQuestion       setAssetQuestionnaireId()   Sets the current record's "asset_questionnaire_id" value
 * @method AssetQuestion       setQuestion()               Sets the current record's "question" value
 * @method AssetQuestion       setAsset()                  Sets the current record's "Asset" value
 * @method AssetQuestion       setAssetQuestionnaire()     Sets the current record's "AssetQuestionnaire" value
 * @method AssetQuestion       setAnswers()                Sets the current record's "Answers" collection
 * 
 * @package    futebol
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAssetQuestion extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('asset_question');
        $this->hasColumn('asset_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('asset_questionnaire_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('question', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));

        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Asset', array(
             'local' => 'asset_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('AssetQuestionnaire', array(
             'local' => 'asset_questionnaire_id',
             'foreign' => 'id'));

        $this->hasMany('AssetAnswer as Answers', array(
             'local' => 'id',
             'foreign' => 'asset_question_id'));
    }
}