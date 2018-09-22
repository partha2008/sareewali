<link href="<?php echo base_url(); ?>assets/styles/MultiNestedList.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/scripts/MultiNestedList.js"></script>

<div class="container" id="relation_tree">
	<?php
		function printTree($tree) {
			if(!is_null($tree) && count($tree) > 0) {
	            echo '<ul>';
	            foreach($tree as $node) {
	                echo '<li><a href="#">'.$node['name'].'</a>';
	                printTree($node['children']);
	                echo '</li>';
	            }
	            echo '</ul>';
	        }
	    }
	    printTree($final_tree);
	?>
</div>