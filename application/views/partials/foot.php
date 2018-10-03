<!-- jquery latest version --> 
<script src="<?php echo base_url(); ?>resources/js/jquery-1.12.0.min.js"></script> 

<!-- bootstrap --> 
<script src="<?php echo base_url(); ?>resources/js/bootstrap.min.js"></script> 

<!-- owl.carousel js --> 
<script src="<?php echo base_url(); ?>resources/js/owl.carousel.min.js"></script> 

<?php
	if($tot_segments[1] == 'product-details'){
?>
<script src="<?php echo base_url(); ?>resources/js/modernizr.custom.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>resources/js/easyResponsiveTabs.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>resources/js/jquery.glasscase.minf195.js?v=2.1"></script>
<script src="<?php echo base_url(); ?>resources/js/magiczoomplus.js"></script>
<?php
	}elseif($tot_segments[1] == 'product-list'){
?>
<!-- responsiveslides.js --> 
<script src="<?php echo base_url(); ?>resources/js/responsiveslides.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>resources/js/CustomScrollbar.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>resources/js/jquery-ui.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url(); ?>resources/js/price_range_script.js" type="text/javascript"></script>  
<?php
	}else{
?>
<!-- responsiveslides.js --> 
<script src="<?php echo base_url(); ?>resources/js/responsiveslides.min.js" type="text/javascript"></script> 
<!-- wow --> 
<script src="<?php echo base_url(); ?>resources/js/wow.min.js"></script>
<?php
	}
?>

<!-- megamenu --> 
<script src="<?php echo base_url(); ?>resources/js/megamenu.js"></script> 

<!-- Swal -->
<script src="<?php echo base_url(); ?>resources/js/sweetalert.min.js"></script> 

 

<script src="<?php echo base_url(); ?>resources/js/custom.js"></script>
<script src="<?php echo base_url(); ?>resources/js/common.js"></script> 
<script async defer src="https://apis.google.com/js/api.js" onload="this.onload=function(){};HandleGoogleApiLibrary()" onreadystatechange="if (this.readyState === 'complete') this.onload()"></script>
</body>

</html>