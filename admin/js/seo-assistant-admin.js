jQuery(document).ready(function($){
	function all_in_one_google_getUrlVars(){
		var vars = [], hash;
		var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
		for(var i = 0; i < hashes.length; i++)
		{
			hash = hashes[i].split('=');
			vars.push(hash[0]);
			vars[hash[0]] = hash[1];
		}
		return vars;
	}
	function all_in_one_google_setting( identifier, textarea_id) {
		
		var editor_html = ace.edit(identifier);
			textarea_html = jQuery(textarea_id).hide();
			editor_html.setTheme("ace/theme/monokai");

			editor_html.$blockScrolling = Infinity;
			
			editor_html.getSession().setMode("ace/mode/text");	
			editor_html.getSession().setOptions({
				autoScrollEditorIntoView: true,
				copyWithEmptySelection: true,
			});	
			editor_html.getSession().setValue(textarea_html.val());
			editor_html.getSession().on('change', function(){
				textarea_html.text(editor_html.getSession().getValue());
			});
	}


});
