<?php

/**
 * BaseAssetQuestionnaire
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $asset_id
 * @property string $name
 * @property string $headline
 * @property Asset $Asset
 * @property AssetQuestion $AssetQuestionnaire
 * 
 * @method integer            getAssetId()            Returns the current record's "asset_id" value
 * @method string             getName()               Returns the current record's "name" value
 * @method string             getHeadline()           Returns the current record's "headline" value
 * @method Asset              getAsset()              Returns the current record's "Asset" value
 * @method AssetQuestion      getAssetQuestionnaire() Returns the current record's "AssetQuestionnaire" value
 * @method AssetQuestionnaire setAssetId()            Sets the current record's "asset_id" value
 * @method AssetQuestionnaire setName()               Sets the current record's "name" value
 * @method AssetQuestionnaire setHeadline()           Sets the current record's "headline" value
 * @method AssetQuestionnaire setAsset()              Sets the current record's "Asset" value
 * @method AssetQuestionnaire setAssetQuestionnaire() Sets the current record's "AssetQuestionnaire" value
 * 
 * @package    futebol
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAssetQuestionnaire extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('asset_questionnaire');
        $this->hasColumn('asset_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('headline', 'string', 255, array(
             'type' => 'string',
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

        $this->hasOne('AssetQuestion as AssetQuestionnaire', array(
             'local' => 'id',
             'foreign' => 'asset_questionnaire_id'));
    }
}