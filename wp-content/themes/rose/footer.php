			<?php 

			?>
			<footer id="footer">
				<div class="container">


					<?php rose_framework::rose_footer_instagram(); ?>

					<div class="row widget-col bg-gray">

						<?php if(is_active_sidebar( 'footer_left' )) : ?>
							<div class="col-sm-6 bg-black">
								<div class="widget_footer_left">
									<?php dynamic_sidebar( 'footer_left' ); ?>
								</div>
							</div>
						<?php endif; ?>

						<?php if(is_active_sidebar( 'footer_right' )) : ?>
							<div class="col-sm-6">
								<div class="widget_footer_right">
									<?php dynamic_sidebar( 'footer_right' ); ?>
								</div>
							</div>
						<?php endif; ?>
					</div>

					<?php rose_framework::rose_copyright(); ?>
					
					<span class="scroll-top"><i class="fa fa-angle-up"></i></span>
				

				</div>
			</footer>
		</div>

		<?php wp_footer(); ?>

	</body>
</html>