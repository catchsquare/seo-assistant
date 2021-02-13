jQuery(function($){

	var  easy_tag_and_tracking_id_inserter_google_tag_manager_status = SEO_ASSISTANT_GOOGLE_ANALYTICAL.google_tag_manager['google-tag-manager-enable'],
	easy_tag_and_tracking_id_inserter_google_tag_manager_tpl = `
		<!-- Google Tag Manager (noscript) Added by Easy Tag and Tracking id inserter plugin --> \
		<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTMTAG" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> \
		<!-- End Google Tag Manager (noscript) --> `;
	
	easy_tag_and_tracking_id_inserter_google_tag_manager_tpl = easy_tag_and_tracking_id_inserter_google_tag_manager_tpl.replace('GTMTAG',SEO_ASSISTANT_GOOGLE_ANALYTICAL.google_tag_manager['google-tag-manager'] );
	
	
	if( "yes" ==easy_tag_and_tracking_id_inserter_google_tag_manager_status ){
		var s = document.body.firstChild;
		console.log(s)
		s.insertAdjacentHTML("beforebegin", easy_tag_and_tracking_id_inserter_google_tag_manager_tpl );
	}
	
});
