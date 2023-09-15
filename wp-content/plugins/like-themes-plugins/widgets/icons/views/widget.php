<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * @var string $before_widget
 * @var string $after_widget
 */

echo wp_kses_post( $before_widget );

if ( !empty($params['title']) )  {

	echo $before_title . esc_html( $params['title'] ) . $after_title;
}

?>
<?php if ( is_array( $params['items'] ) ) : ?>
<?php if ( $params['list-type'] == 'icons-list' ) : ?><ul class="social-icons-list"><?php endif; ?>
<?php if ( $params['list-type'] == 'icons-inline-large' ) : ?><ul class="social-big"><?php endif; ?>
<?php if ( $params['list-type'] == 'icons-inline-small' ) : ?><ul class="social-small"><?php endif; ?>
	<?php foreach ( $params['items'] as $item ) : ?>
		<?php
			if ( !empty($item['antispam']) ) {

				$item['text'] = antispambot($item['text']);
				$item['href'] = antispambot($item['href']);
			}
		?>
		<?php if ( $params['list-type'] == 'icons-list' ) : ?>
			<?php if ( empty( $item['href'] ) ) : ?>
			<li><span class="<?php echo esc_attr( $item['icon'] ); ?>"></span><?php echo esc_html( $item['text'] ); ?></li>
			<?php else : ?>
			<li><a href="<?php echo esc_attr( $item['href'] ); ?>"><span class="<?php echo esc_attr( $item['icon'] ); ?>"></span><?php echo esc_html( $item['text'] ); ?></a></li>
			<?php endif; ?>
		<?php elseif ( $params['list-type'] == 'icons-inline-large' ) : ?>
			<li><a href="<?php echo esc_attr( $item['href'] ); ?>" class="<?php echo esc_attr( $item['icon'] ); ?>"></a></li>
		<?php else : ?>
			<li><a href="<?php echo esc_attr( $item['href'] ); ?>" class="<?php echo esc_attr( $item['icon'] ); ?>"></a></li>
		<?php endif; ?>
	<?php endforeach; ?>
<?php if ( $params['list-type'] == 'icons-inline-small' ) : ?>	
</ul>
<?php else : ?>
</ul>
<?php endif; ?>
<?php endif; ?>
<?php echo wp_kses_post( $after_widget ) ?>
