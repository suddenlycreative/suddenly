<script type="text/template" id="tpcore-liteTemplateLibrary_templates">
	<div id="liteTemplateLibrary_toolbar">
		<div id="liteTemplateLibrary_toolbar-search">
			<label for="liteTemplateLibrary_search" class="elementor-screen-only"><?php esc_html_e( 'Search Templates:', 'tpcore' ); ?></label>
			<input id="liteTemplateLibrary_search" placeholder="<?php esc_attr_e( 'Search', 'tpcore' ); ?>">
			<i class="eicon-search"></i>
		</div>
		<div id="liteTemplateLibrary_toolbar-counter"></div>
		
		<div id="liteTemplateLibrary_toolbar-filter" class="liteTemplateLibrary_toolbar-filter">
			<# if (tpcore.library.getTypeTags()) { var selectedTag = tpcore.library.getFilter( 'tags' ); #>
				<# if ( selectedTag ) { #>
				<span class="liteTemplateLibrary_filter-btn">{{{ tpcore.library.getTags()[selectedTag] }}} <i class="eicon-caret-right"></i></span>
				<# } else { #>
				<span class="liteTemplateLibrary_filter-btn"><?php esc_html_e( 'Filter', 'tpcore' ); ?> <i class="eicon-caret-right"></i></span>
				<# } #>
				<ul id="liteTemplateLibrary_filter-tags" class="liteTemplateLibrary_filter-tags">
					<li data-tag="">All</li>
					<# _.each(tpcore.library.getTypeTags(), function(slug) {
						var selected = selectedTag === slug ? 'active' : '';
						#>
						<li data-tag="{{ slug }}" class="{{ selected }}">{{{ tpcore.library.getTags()[slug] }}}</li>
					<# } ); #>
				</ul>
			<# } #>
		</div>
	</div>

	<div class="liteTemplateLibrary_templates-window">
		<div id="liteTemplateLibrary_templates-list"></div>
	</div>
</script>