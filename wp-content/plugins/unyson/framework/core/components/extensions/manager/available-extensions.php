<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$thumbnails_uri = fw_get_framework_directory_uri( '/core/components/extensions/manager/static/img/thumbnails' );
$github_account = 'ThemeFuse';

$extensions = array(
	'backups' => array(
		'display'     => true,
		'parent'      => null,
		'name'        => __( 'LT Backup & Demo Content', 'fw' ),
		'description' => __( 'This extension lets you create an automated backup schedule, import demo content or even create a demo content archive for migration purposes.', 'fw' ),
		'thumbnail'   => $thumbnails_uri . '/backups.jpg',
		'download'    => array(
			'source'	=>	'custom',
			'opts' => array(
				'remote' => 'http://updates.like-themes.com/plugins/unyson/lt-backups.zip',
			),
		),
	),
	'megamenu' => array(
		'display'     => true,
		'parent'      => null,
		'name'        => __( 'Mega Menu', 'fw' ),
		'description' => __( 'The Mega Menu extension adds a user-friendly drop down menu that will let you easily create highly customized menu configurations.', 'fw' ),
		'thumbnail'   => $thumbnails_uri . '/mega-menu.jpg',
		'download'    => array(
			'source'	=>	'custom',
			'opts' => array(
				'remote' => 'http://updates.like-themes.com/plugins/unyson/megamenu.zip',
			),
		),
	),
);

