<?php use_helper('I18N', 'Date') ?>

        <div id="alerts">
        </div>
        <div id="header">
            <h1><?php echo __('Asset List', array(), 'messages') ?></h1>
        </div>

        <div id="content">
            <div id="dashboard-main">

<?php include_partial('asset/assets') ?>

<div id="sf_admin_container">

  <?php include_partial('asset/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('asset/list_header', array('pager' => $pager)) ?>
  </div>

  <div id="sf_admin_content">
    <form action="<?php echo url_for('asset_collection', array('action' => 'batch')) ?>" method="post">
    <ul class="sf_admin_actions">
      <?php include_partial('asset/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('asset/list_actions', array('helper' => $helper)) ?>
    </ul>
    <?php include_partial('asset/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    <ul class="sf_admin_actions">
      <?php include_partial('asset/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('asset/list_actions', array('helper' => $helper)) ?>
    </ul>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('asset/list_footer', array('pager' => $pager)) ?>
  </div>
</div>

            </div>
            <div id="dashboard-side">
                <div id="dashboard-blog" class="module">
                    <h3>Filtros</h3>
                    <div class="module-info">
					  <div id="sf_admin_bar">
					    <?php include_partial('asset/filters', array('form' => $filters, 'configuration' => $configuration)) ?>
					  </div>
                    </div>
                </div>
            </div>
