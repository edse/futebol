<?php

/**
 * BaseGame
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $tournament_id
 * @property integer $tournament_edition_id
 * @property integer $game_ext_id
 * @property timestamp $date_start
 * @property string $date
 * @property string $time
 * @property string $round
 * @property integer $home_team_id
 * @property integer $home_team_ext_id
 * @property string $home_team_logo
 * @property string $home_team_name
 * @property string $home_team_initials
 * @property string $home_team_slug
 * @property integer $home_team_score
 * @property integer $home_team_penalty_score
 * @property integer $away_team_id
 * @property integer $away_team_ext_id
 * @property string $away_team_logo
 * @property string $away_team_name
 * @property string $away_team_initials
 * @property string $away_team_slug
 * @property integer $away_team_score
 * @property integer $away_team_penalty_score
 * @property string $stadium_name
 * @property integer $stadium_id
 * @property integer $stadium_ext_id
 * @property string $url
 * @property TournamentEdition $TournamentEdition
 * @property Tournament $Tournament
 * @property Team $HomeTeam
 * @property Team $AwayTeam
 * @property Stadium $Stadium
 * @property Doctrine_Collection $Feed
 * @property Doctrine_Collection $Feeds
 * @property Doctrine_Collection $Asset
 * 
 * @method integer             getTournamentId()            Returns the current record's "tournament_id" value
 * @method integer             getTournamentEditionId()     Returns the current record's "tournament_edition_id" value
 * @method integer             getGameExtId()               Returns the current record's "game_ext_id" value
 * @method timestamp           getDateStart()               Returns the current record's "date_start" value
 * @method string              getDate()                    Returns the current record's "date" value
 * @method string              getTime()                    Returns the current record's "time" value
 * @method string              getRound()                   Returns the current record's "round" value
 * @method integer             getHomeTeamId()              Returns the current record's "home_team_id" value
 * @method integer             getHomeTeamExtId()           Returns the current record's "home_team_ext_id" value
 * @method string              getHomeTeamLogo()            Returns the current record's "home_team_logo" value
 * @method string              getHomeTeamName()            Returns the current record's "home_team_name" value
 * @method string              getHomeTeamInitials()        Returns the current record's "home_team_initials" value
 * @method string              getHomeTeamSlug()            Returns the current record's "home_team_slug" value
 * @method integer             getHomeTeamScore()           Returns the current record's "home_team_score" value
 * @method integer             getHomeTeamPenaltyScore()    Returns the current record's "home_team_penalty_score" value
 * @method integer             getAwayTeamId()              Returns the current record's "away_team_id" value
 * @method integer             getAwayTeamExtId()           Returns the current record's "away_team_ext_id" value
 * @method string              getAwayTeamLogo()            Returns the current record's "away_team_logo" value
 * @method string              getAwayTeamName()            Returns the current record's "away_team_name" value
 * @method string              getAwayTeamInitials()        Returns the current record's "away_team_initials" value
 * @method string              getAwayTeamSlug()            Returns the current record's "away_team_slug" value
 * @method integer             getAwayTeamScore()           Returns the current record's "away_team_score" value
 * @method integer             getAwayTeamPenaltyScore()    Returns the current record's "away_team_penalty_score" value
 * @method string              getStadiumName()             Returns the current record's "stadium_name" value
 * @method integer             getStadiumId()               Returns the current record's "stadium_id" value
 * @method integer             getStadiumExtId()            Returns the current record's "stadium_ext_id" value
 * @method string              getUrl()                     Returns the current record's "url" value
 * @method TournamentEdition   getTournamentEdition()       Returns the current record's "TournamentEdition" value
 * @method Tournament          getTournament()              Returns the current record's "Tournament" value
 * @method Team                getHomeTeam()                Returns the current record's "HomeTeam" value
 * @method Team                getAwayTeam()                Returns the current record's "AwayTeam" value
 * @method Stadium             getStadium()                 Returns the current record's "Stadium" value
 * @method Doctrine_Collection getFeed()                    Returns the current record's "Feed" collection
 * @method Doctrine_Collection getFeeds()                   Returns the current record's "Feeds" collection
 * @method Doctrine_Collection getAssets()                  Returns the current record's "Assets" collection
 * @method Doctrine_Collection getAsset()                   Returns the current record's "Asset" collection
 * @method Game                setTournamentId()            Sets the current record's "tournament_id" value
 * @method Game                setTournamentEditionId()     Sets the current record's "tournament_edition_id" value
 * @method Game                setGameExtId()               Sets the current record's "game_ext_id" value
 * @method Game                setDateStart()               Sets the current record's "date_start" value
 * @method Game                setDate()                    Sets the current record's "date" value
 * @method Game                setTime()                    Sets the current record's "time" value
 * @method Game                setRound()                   Sets the current record's "round" value
 * @method Game                setHomeTeamId()              Sets the current record's "home_team_id" value
 * @method Game                setHomeTeamExtId()           Sets the current record's "home_team_ext_id" value
 * @method Game                setHomeTeamLogo()            Sets the current record's "home_team_logo" value
 * @method Game                setHomeTeamName()            Sets the current record's "home_team_name" value
 * @method Game                setHomeTeamInitials()        Sets the current record's "home_team_initials" value
 * @method Game                setHomeTeamSlug()            Sets the current record's "home_team_slug" value
 * @method Game                setHomeTeamScore()           Sets the current record's "home_team_score" value
 * @method Game                setHomeTeamPenaltyScore()    Sets the current record's "home_team_penalty_score" value
 * @method Game                setAwayTeamId()              Sets the current record's "away_team_id" value
 * @method Game                setAwayTeamExtId()           Sets the current record's "away_team_ext_id" value
 * @method Game                setAwayTeamLogo()            Sets the current record's "away_team_logo" value
 * @method Game                setAwayTeamName()            Sets the current record's "away_team_name" value
 * @method Game                setAwayTeamInitials()        Sets the current record's "away_team_initials" value
 * @method Game                setAwayTeamSlug()            Sets the current record's "away_team_slug" value
 * @method Game                setAwayTeamScore()           Sets the current record's "away_team_score" value
 * @method Game                setAwayTeamPenaltyScore()    Sets the current record's "away_team_penalty_score" value
 * @method Game                setStadiumName()             Sets the current record's "stadium_name" value
 * @method Game                setStadiumId()               Sets the current record's "stadium_id" value
 * @method Game                setStadiumExtId()            Sets the current record's "stadium_ext_id" value
 * @method Game                setUrl()                     Sets the current record's "url" value
 * @method Game                setTournamentEdition()       Sets the current record's "TournamentEdition" value
 * @method Game                setTournament()              Sets the current record's "Tournament" value
 * @method Game                setHomeTeam()                Sets the current record's "HomeTeam" value
 * @method Game                setAwayTeam()                Sets the current record's "AwayTeam" value
 * @method Game                setStadium()                 Sets the current record's "Stadium" value
 * @method Game                setFeed()                    Sets the current record's "Feed" collection
 * @method Game                setFeeds()                   Sets the current record's "Feeds" collection
 * @method Game                setAssets()                  Sets the current record's "Assets" collection
 * @method Game                setAsset()                   Sets the current record's "Asset" collections
 * @property Doctrine_Collection $Asset
 * 
 * @method integer             getTournamentId()            Returns the current record's "tournament_id" value
 * @method integer             getTournamentEditionId()     Returns the current record's "tournament_edition_id" value
 * @method integer             getGameExtId()               Returns the current record's "game_ext_id" value
 * @method timestamp           getDateStart()               Returns the current record's "date_start" value
 * @method string              getDate()                    Returns the current record's "date" value
 * @method string              getTime()                    Returns the current record's "time" value
 * @method string              getRound()                   Returns the current record's "round" value
 * @method integer             getHomeTeamId()              Returns the current record's "home_team_id" value
 * @method integer             getHomeTeamExtId()           Returns the current record's "home_team_ext_id" value
 * @method string              getHomeTeamLogo()            Returns the current record's "home_team_logo" value
 * @method string              getHomeTeamName()            Returns the current record's "home_team_name" value
 * @method string              getHomeTeamInitials()        Returns the current record's "home_team_initials" value
 * @method string              getHomeTeamSlug()            Returns the current record's "home_team_slug" value
 * @method integer             getHomeTeamScore()           Returns the current record's "home_team_score" value
 * @method integer             getHomeTeamPenaltyScore()    Returns the current record's "home_team_penalty_score" value
 * @method integer             getAwayTeamId()              Returns the current record's "away_team_id" value
 * @method integer             getAwayTeamExtId()           Returns the current record's "away_team_ext_id" value
 * @method string              getAwayTeamLogo()            Returns the current record's "away_team_logo" value
 * @method string              getAwayTeamName()            Returns the current record's "away_team_name" value
 * @method string              getAwayTeamInitials()        Returns the current record's "away_team_initials" value
 * @method string              getAwayTeamSlug()            Returns the current record's "away_team_slug" value
 * @method integer             getAwayTeamScore()           Returns the current record's "away_team_score" value
 * @method integer             getAwayTeamPenaltyScore()    Returns the current record's "away_team_penalty_score" value
 * @method string              getStadiumName()             Returns the current record's "stadium_name" value
 * @method integer             getStadiumId()               Returns the current record's "stadium_id" value
 * @method integer             getStadiumExtId()            Returns the current record's "stadium_ext_id" value
 * @method string              getUrl()                     Returns the current record's "url" value
 * @method TournamentEdition   getTournamentEdition()       Returns the current record's "TournamentEdition" value
 * @method Tournament          getTournament()              Returns the current record's "Tournament" value
 * @method Team                getHomeTeam()                Returns the current record's "HomeTeam" value
 * @method Team                getAwayTeam()                Returns the current record's "AwayTeam" value
 * @method Stadium             getStadium()                 Returns the current record's "Stadium" value
 * @method Doctrine_Collection getFeed()                    Returns the current record's "Feed" collection
 * @method Doctrine_Collection getFeeds()                   Returns the current record's "Feeds" collection
 * @method Doctrine_Collection getAssets()                  Returns the current record's "Assets" collection
 * @method Doctrine_Collection getAsset()                   Returns the current record's "Asset" collection
 * @method Game                setTournamentId()            Sets the current record's "tournament_id" value
 * @method Game                setTournamentEditionId()     Sets the current record's "tournament_edition_id" value
 * @method Game                setGameExtId()               Sets the current record's "game_ext_id" value
 * @method Game                setDateStart()               Sets the current record's "date_start" value
 * @method Game                setDate()                    Sets the current record's "date" value
 * @method Game                setTime()                    Sets the current record's "time" value
 * @method Game                setRound()                   Sets the current record's "round" value
 * @method Game                setHomeTeamId()              Sets the current record's "home_team_id" value
 * @method Game                setHomeTeamExtId()           Sets the current record's "home_team_ext_id" value
 * @method Game                setHomeTeamLogo()            Sets the current record's "home_team_logo" value
 * @method Game                setHomeTeamName()            Sets the current record's "home_team_name" value
 * @method Game                setHomeTeamInitials()        Sets the current record's "home_team_initials" value
 * @method Game                setHomeTeamSlug()            Sets the current record's "home_team_slug" value
 * @method Game                setHomeTeamScore()           Sets the current record's "home_team_score" value
 * @method Game                setHomeTeamPenaltyScore()    Sets the current record's "home_team_penalty_score" value
 * @method Game                setAwayTeamId()              Sets the current record's "away_team_id" value
 * @method Game                setAwayTeamExtId()           Sets the current record's "away_team_ext_id" value
 * @method Game                setAwayTeamLogo()            Sets the current record's "away_team_logo" value
 * @method Game                setAwayTeamName()            Sets the current record's "away_team_name" value
 * @method Game                setAwayTeamInitials()        Sets the current record's "away_team_initials" value
 * @method Game                setAwayTeamSlug()            Sets the current record's "away_team_slug" value
 * @method Game                setAwayTeamScore()           Sets the current record's "away_team_score" value
 * @method Game                setAwayTeamPenaltyScore()    Sets the current record's "away_team_penalty_score" value
 * @method Game                setStadiumName()             Sets the current record's "stadium_name" value
 * @method Game                setStadiumId()               Sets the current record's "stadium_id" value
 * @method Game                setStadiumExtId()            Sets the current record's "stadium_ext_id" value
 * @method Game                setUrl()                     Sets the current record's "url" value
 * @method Game                setTournamentEdition()       Sets the current record's "TournamentEdition" value
 * @method Game                setTournament()              Sets the current record's "Tournament" value
 * @method Game                setHomeTeam()                Sets the current record's "HomeTeam" value
 * @method Game                setAwayTeam()                Sets the current record's "AwayTeam" value
 * @method Game                setStadium()                 Sets the current record's "Stadium" value
 * @method Game                setFeed()                    Sets the current record's "Feed" collection
 * @method Game                setFeeds()                   Sets the current record's "Feeds" collection
 * @method Game                setAssets()                  Sets the current record's "Assets" collection
 * @method Game                setAsset()                   Sets the current record's "Asset" collection
 * 
 * @package    futebol
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseGame extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('game');
        $this->hasColumn('tournament_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('tournament_edition_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('game_ext_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('date_start', 'timestamp', null, array(
             'type' => 'timestamp',
             'notnull' => true,
             ));
        $this->hasColumn('date', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('time', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('round', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('home_team_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('home_team_ext_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('home_team_logo', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('home_team_name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('home_team_initials', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('home_team_slug', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('home_team_score', 'integer', null, array(
             'type' => 'integer',
             'default' => 0,
             ));
        $this->hasColumn('home_team_penalty_score', 'integer', null, array(
             'type' => 'integer',
             'default' => 0,
             ));
        $this->hasColumn('away_team_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('away_team_ext_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('away_team_logo', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('away_team_name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('away_team_initials', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('away_team_slug', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('away_team_score', 'integer', null, array(
             'type' => 'integer',
             'default' => 0,
             ));
        $this->hasColumn('away_team_penalty_score', 'integer', null, array(
             'type' => 'integer',
             'default' => 0,
             ));
        $this->hasColumn('stadium_name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('stadium_id', 'integer', 8, array(
             'type' => 'integer',
             'length' => 8,
             ));
        $this->hasColumn('stadium_ext_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('url', 'string', 255, array(
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
        $this->hasOne('TournamentEdition', array(
             'local' => 'tournament_edition_id',
             'foreign' => 'id'));

        $this->hasOne('Tournament', array(
             'local' => 'tournament_id',
             'foreign' => 'id'));

        $this->hasOne('Team as HomeTeam', array(
             'local' => 'home_team_id',
             'foreign' => 'id'));

        $this->hasOne('Team as AwayTeam', array(
             'local' => 'away_team_id',
             'foreign' => 'id'));

        $this->hasOne('Stadium', array(
             'local' => 'stadium_id',
             'foreign' => 'id'));

        $this->hasMany('Feed', array(
             'refClass' => 'GameFeed',
             'local' => 'game_id',
             'foreign' => 'feed_id'));

        $this->hasMany('GameFeed as Feeds', array(
             'local' => 'id',
             'foreign' => 'game_id'));

        $this->hasMany('GameAsset as Assets', array(
             'local' => 'id',
             'foreign' => 'game_id'));

        $this->hasMany('Asset', array(
             'refClass' => 'GameAsset',
             'local' => 'game_id',
             'foreign' => 'asset_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}