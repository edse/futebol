<?php

/**
 * BaseAssetVote
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $asset_id
 * @property string $ip
 * @property Asset $Asset
 * 
 * @method integer   getAssetId()  Returns the current record's "asset_id" value
 * @method string    getIp()       Returns the current record's "ip" value
 * @method Asset     getAsset()    Returns the current record's "Asset" value
 * @method AssetVote setAssetId()  Sets the current record's "asset_id" value
 * @method AssetVote setIp()       Sets the current record's "ip" value
 * @method AssetVote setAsset()    Sets the current record's "Asset" value
 * 
 * @package    futebol
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAssetVote extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('asset_vote');
        $this->hasColumn('asset_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('ip', 'string', 255, array(
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
    }
}