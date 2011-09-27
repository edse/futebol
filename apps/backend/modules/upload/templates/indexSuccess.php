        <div id="alerts">
        </div>
        <div id="header">
            <h1>Uploads</h1>
        </div>

        <div id="content">
            <div id="dashboard-main">
            	
<script>
$(function() {
	// Setup html5 version
	$("#html5_uploader").pluploadQueue({
		// General settings
		runtimes : 'html5',
		url : '<?php echo url_for('upload/upload') ?>',
		max_file_size : '1700mb',
		unique_names : true,
		filters : [
			{title : "Audio files", extensions : "mp3,wma,wav,aac"},
			{title : "Image files", extensions : "jpg,gif,png"},
			{title : "Video files", extensions : "ogg,mp4,flv,wmv,mpg,avi,m4v,mov"},
			{title : "Other files", extensions : "swf,zip,doc,docx,xls,xlsx,pdf"}
		],
		
    // Post init events, bound after the internal events
    init : {
      FileUploaded: function(up, file, info) {
        //console.log(info);
        //console.log(info.response)
        // Called when a file has finished uploading
        //log('[FileUploaded] File:', file, "Info:", info);
        //str = new String(file.id);
        $('#tasks').append("<li id='"+info.response+"'> <a href='./asset/"+info.response+"/edit'>Adicionar metadados no asset: "+file.name+"</a> </li>");
        $("#tasks").effect("pulsate", { times:3 }, 1000);
      }
      
    }

	});

});
</script>

<form method="post" action="">
	<div style="float: left; margin-right: 20px; width: 100%">
		<div id="html5_uploader" style="width: 100%; height: 330px;">Seu browser não suporta upload nativo. Tente realizar esta tarefa pelo Chrome.</div>
	</div>
	<br style="clear: both" />
</form>

<?php /*
<hr />
<h1>Large file upload:</h1>
<form enctype="multipart/form-data" method="post" action="/backend_dev.php/upload/upload">
  <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
  <input type="file" name="arquivo" id="arquivo" />
  <input type="submit">
</form>
*/ ?>

            </div>
            <div id="dashboard-side">
                <div id="dashboard-blog" class="module">
                    <h3>Tarefas Pendentes</h3>
                    <div class="module-info">
                      <ul id="tasks"></ul>
                    </div>
                </div>
            </div>
