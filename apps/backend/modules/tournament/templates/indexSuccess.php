<?php use_helper('I18N', 'Date') ?>

<div id="alerts"></div>
<div id="header"></div>
<div id="content">
  <div id="dashboard-main">

<?php include_partial('tournament/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Tournaments', array(), 'messages') ?></h1>

  <?php include_partial('tournament/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('tournament/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_content">
    <form action="<?php echo url_for('tournament_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('tournament/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <ul class="sf_admin_actions">
      <?php include_partial('tournament/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('tournament/list_actions', array('helper' => $helper)) ?>
    </ul>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('tournament/list_footer', array('pager' => $pager)) ?>
  </div>
</div>

</div>
<div id="dashboard-side">
  <div id="dashboard-blog" class="module">
    <h3>Filtros</h3>
    <div class="module-info">
      <div id="sf_admin_bar">
      <?php include_partial('tournament/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
      </div>
    </div>
  </div>
</div>
