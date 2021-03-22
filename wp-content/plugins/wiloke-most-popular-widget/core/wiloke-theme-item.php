<?php 
if ( !class_exists('WC_API_Client') )
{
	require_once( plugin_dir_path(__FILE__) . 'lib/woocommerce-api.php' ); 
}


$options = array(
    'ssl_verify'      => false,
);

try {

    $client = new WC_API_Client( 'https://wiloke.com', 'ck_5066dcfb2a5d3179aeab451af89cd8a25a3e6566', 'cs_6f6fb9efb03f422326245fbdb6e42bfd08f29993', $options );

} catch ( WC_API_Client_Exception $e ) {

    echo $e->getMessage() . PHP_EOL;
    echo $e->getCode() . PHP_EOL;

    if ( $e instanceof WC_API_Client_HTTP_Exception ) {

        print_r( $e->get_request() );
        print_r( $e->get_response() );
    }
}

$oProducts = $client->products->get();

?>
<div class="wiloke-importer-wrapper">
    <h1>Check out newest themes</h1>
    <div class="wrapper__inner">
        <?php 
        	foreach ( $oProducts->products as $key => $oDemo ) :  
     	?>
            <div class="wiloke-item">
                <div class="inner">

                    <div class="screenshot">
                    	<a href="<?php echo esc_url($oDemo->permalink); ?>" target="_blank">
                        	<img src="<?php echo esc_url($oDemo->featured_src); ?>" alt="<?php echo esc_url($oDemo->title); ?>" />
                        </a>
                    </div>
                    <div class="title-install-preview">
                        <h2><a href="<?php echo esc_url($oDemo->permalink); ?>" target="_blank"><?php echo esc_html($oDemo->title); ?></a></h2>
                        <div class="actions">
                            <a class="button button-primary" target="_blank" href="<?php echo esc_url($oDemo->permalink); ?>" target="_blank">Preview</a>
                        </div>
                    </div>

                </div>

            </div>
        <?php endforeach; ?>
    </div>
</div>