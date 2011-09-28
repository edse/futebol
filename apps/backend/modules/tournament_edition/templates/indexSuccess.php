<?php use_helper('I18N', 'Date') ?>

<div id="alerts"></div>
<div id="header"></div>
<div id="content">

<?php include_partial('tournament_edition/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Tournament editions', array(), 'messages') ?></h1>

  <?php include_partial('tournament_edition/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('tournament_edition/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_content">
    <form action="<?php echo url_for('tournament_edition_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('tournament_edition/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <ul class="sf_admin_actions">
      <?php include_partial('tournament_edition/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('tournament_edition/list_actions', array('helper' => $helper)) ?>
    </ul>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('tournament_edition/list_footer', array('pager' => $pager)) ?>
  </div>
</div>

</div>
