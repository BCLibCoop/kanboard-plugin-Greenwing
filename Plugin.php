<?php

namespace Kanboard\Plugin\Greenwing;

use Kanboard\Core\Plugin\Base;

class Plugin extends Base {
	public static $name = 'Greenwing';

	public function initialize() {
		/**
		 * Extending and overriding default helper to limit number of template  overrides required.
		 */
		$this->helper->register( 'avatar', Helper\AvatarHelper::class );

		$this->container['colorModel'] = $this->container->factory( function ( $c ) {
			return new Model\ColorModel( $c );
		} );

		$this->template->setTemplateOverride( 'board/table_column', self::$name . ':board/table_column' );
		$this->template->setTemplateOverride( 'board/table_tasks', self::$name . ':board/table_tasks' );
		$this->template->setTemplateOverride( 'project_header/search', self::$name . ':project_header/search' );

		$this->template->hook->attach('template:auth:login-form:before', self::$name . ':hook/login');
		$this->template->hook->attach('template:project:header:filters:after', self::$name . ':hook/color_filter', [
			'colors_list' => $this->container['colorModel']->getList(false, true),
		]);
		$this->template->hook->attach('template:layout:head', self::$name . ':hook/hide_search');
		$this->template->hook->attach('template:task:layout:top', self::$name . ':hook/task_header_color');

		$this->template->hook->attach('template:board:task:footer', 'kanboard:board/task_avatar');

		$this->hook->on( 'template:layout:css', array( 'template' => $this->assetPath('main.css') ) );
	}

	private function assetPath($asset_filename)
	{
		static $manifest = json_decode( file_get_contents( __DIR__ . '/dist/rev-manifest.json', true ), true );

		return implode(
			DIRECTORY_SEPARATOR,
			array(
				basename(PLUGINS_DIR),
				self::$name,
				'dist',
				$manifest[$asset_filename]
			)
		);
	}

	public function getPluginName() {
		return self::$name;
	}

	public function getPluginAuthor() {
		return 'Cloud Temple, BC Libraries Coop';
	}

	public function getPluginVersion() {
		return '1.5.0';
	}

	public function getPluginHomepage() {
		return 'https://github.com/BCLibCoop/kanboard-plugin-Greenwing';
	}

	public function getPluginDescription() {
		return t( 'This plugin adds a new stylesheet and overrides default styles.' );
	}
}
