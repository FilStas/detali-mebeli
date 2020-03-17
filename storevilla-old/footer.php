<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Store_Villa
 */

?>
</div><!-- #content -->

	<?php do_action( 'storevilla_before_footer' ); ?>
	
		<footer id="colophon" class="site-footer" role="contentinfo">

				<?php
					/**
					 * @hooked storevilla_pro_footer_widgets - 10
					 * @hooked storevilla_pro_credit - 20
					 * @hooked storevilla_pro_payment_logo - 40
					 */
					do_action( 'storevilla_footer' ); 
				?>		
			
		</footer><!-- #colophon -->
		
	<?php do_action( 'storevilla_before_footer' ); ?>

<a href="#" class="scrollup"><i class="fa fa-angle-up" aria-hidden="true"></i> </a>

</div><!-- #page -->

<?php wp_footer(); ?>

<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = 'YyF1MLujRO';var d=document;var w=window;function l(){
  var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;
  s.src = '//code.jivosite.com/script/widget/'+widget_id
    ; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}
  if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}
  else{w.addEventListener('load',l,false);}}})();
</script>
<!-- {/literal} END JIVOSITE CODE -->

</body>
</html>
