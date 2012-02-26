<?php

/**
 * BaseFeed
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property string $description
 * @property string $type
 * @property string $url
 * @property string $site_name
 * @property string $site_url
 * @property boolean $is_active
 * @property Doctrine_Collection $Tournaments
 * @property Doctrine_Collection $Teams
 * @property Doctrine_Collection $Games
 * 
 * @method string              getName()        Returns the current record's "name" value
 * @method string              getDescription() Returns the current record's "description" value
 * @method string              getType()        Returns the current record's "type" value
 * @method string              getUrl()         Returns the current record's "url" value
 * @method string              getSiteName()    Returns the current record's "site_name" value
 * @method string              getSiteUrl()     Returns the current record's "site_url" value
 * @method boolean             getIsActive()    Returns the current record's "is_active" value
 * @method Doctrine_Collection getTournaments() Returns the current record's "Tournaments" collection
 * @method Doctrine_Collection getTeams()       Returns the current record's "Teams" collection
 * @method Doctrine_Collection getGames()       Returns the current record's "Games" collection
 * @method Feed                setName()        Sets the current record's "name" value
 * @method Feed                setDescription() Sets the current record's "description" value
 * @method Feed                setType()        Sets the current record's "type" value
 * @method Feed                setUrl()         Sets the current record's "url" value
 * @method Feed                setSiteName()    Sets the current record's "site_name" value
 * @method Feed                setSiteUrl()     Sets the current record's "site_url" value
 * @method Feed                setIsActive()    Sets the current record's "is_active" value
 * @method Feed                setTournaments() Sets the current record's "Tournaments" collection
 * @method Feed                setTeams()       Sets the current record's "Teams" collection
 * @method Feed                setGames()       Sets the current record's "Games" collection
 * 
 * @package    futebol
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseFeed extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('feed');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('description', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('type', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('url', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('site_name', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('site_url', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('is_active', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => 0,
             ));


        $this->index('is_active_idx', array(
             'fields' => 
             array(
              0 => 'is_active',
             ),
             ));
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Tournament as Tournaments', array(
             'refClass' => 'TournamentFeed',
             'local' => 'feed_id',
             'foreign' => 'tournament_id'));

        $this->hasMany('Team as Teams', array(
             'refClass' => 'TeamFeed',
             'local' => 'feed_id',
             'foreign' => 'team_id'));

        $this->hasMany('Game as Games', array(
             'refClass' => 'GameFeed',
             'local' => 'feed_id',
             'foreign' => 'game_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $sluggable0 = new Doctrine_Template_Sluggable();
        $this->actAs($timestampable0);
        $this->actAs($sluggable0);
    }
}