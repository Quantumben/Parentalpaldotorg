<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after.
 *
 * @package Kindori
 */ 
$back_totop_on = kindori_get_opt('back_totop_on', true);
?>
	</div><!-- #content inner -->
</div><!-- #content -->

	<?php kindori_footer(); ?>
	<?php kindori_search_popup(); ?>
    <?php if (isset($back_totop_on) && $back_totop_on) : ?>
        <a href="#" class="scroll-top"><i class="zmdi zmdi-long-arrow-up"></i></a>
    <?php endif; ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>