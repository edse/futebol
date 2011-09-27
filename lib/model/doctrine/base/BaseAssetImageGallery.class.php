<?php

/**
 * BaseAssetImageGallery
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $asset_id
 * @property string $headline
 * @property clob $text
 * @property string $source
 * @property Asset $Asset
 * 
 * @method integer           getAssetId()  Returns the current record's "asset_id" value
 * @method string            getHeadline() Returns the current record's "headline" value
 * @method clob              getText()     Returns the current record's "text" value
 * @method string            getSource()   Returns the current record's "source" value
 * @method Asset             getAsset()    Returns the current record's "Asset" value
 * @method AssetImageGallery setAssetId()  Sets the current record's "asset_id" value
 * @method AssetImageGallery setHeadline() Sets the current record's "headline" value
 * @method AssetImageGallery setText()     Sets the current record's "text" value
 * @method AssetImageGallery setSource()   Sets the current record's "source" value
 * @method AssetImageGallery setAsset()    Sets the current record's "Asset" value
 * 
 * @package    futebol
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseAssetImageGallery extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('asset_image_gallery');
        $this->hasColumn('asset_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('headline', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('text', 'clob', null, array(
             'type' => 'clob',
             ));
        $this->hasColumn('source', 'string', 255, array(
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
    }
}