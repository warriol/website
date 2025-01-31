<?php
$URL_segura = "http://";
if (isset($_SERVER['HTTPS'])) {
	$URL_segura = "https://";
}
		
$_URLBASE_ = $URL_segura  . $_SERVER["SERVER_NAME"]. "/";

?>
		<!-- Theme Base, Components and Settings -->
		<script src="<?php echo $_URLBASE_; ?>../app/js/theme.js"></script>
		
		<!-- Specific Page Vendor and Views -->

		
		<!-- Theme Custom -->
		<script src="<?php echo $_URLBASE_; ?>../app/js/custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="<?php echo $_URLBASE_; ?>../app/js/theme.init.js"></script>
<!--
		<script type="text/javascript">
		
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-42715764-4']);
			_gaq.push(['_trackPageview']);
		
			(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		
		</script>
-->