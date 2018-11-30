<script src="<?php echo JAVASCRIPT_LIBRARY_DIR.'jquery.lazy.min.js'; ?>"></script>
<script>
$(document).ready(function($) {
	$('.lazy').lazy({
		threshold: 0,
		beforeLoad: function(element) {
			$(element).removeClass('lazy_loader');
		}
	});
});
</script>