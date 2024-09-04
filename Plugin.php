<?php

namespace Kanboard\Plugin\Greenwing;

use Kanboard\Core\Plugin\Base;

class Plugin extends Base {
	public static $name = 'Greenwing';

	public function initialize() {

		global $GreenwingConfig;

		require_once __DIR__ . DIRECTORY_SEPARATOR . 'Config.php';

		if (isset($GreenwingConfig['logo'])) {
			$this->template->setTemplateOverride('header/title', self::$name . ':logo');
		}

		$this->template->setTemplateOverride( 'board/table_column', self::$name . ':table_column' );
		$this->template->setTemplateOverride( 'board/table_container', self::$name . ':table_container' );
		$this->template->setTemplateOverride( 'board/table_tasks', self::$name . ':table_tasks' );
		$this->template->setTemplateOverride( 'board/task_footer', self::$name . ':task_footer' );
		$this->template->setTemplateOverride( 'board/task_private', self::$name . ':task_private' );
		$this->template->setTemplateOverride( 'board/task_public', self::$name . ':task_public' );
		$this->template->setTemplateOverride( 'comment/show', self::$name . ':comment_show' );
		$this->template->setTemplateOverride( 'dashboard/projects', self::$name . ':projects' );
		$this->template->setTemplateOverride( 'group/users', self::$name . ':group_users' );
		$this->template->setTemplateOverride( 'plugin/show', self::$name . ':plugin/show' );
		$this->template->setTemplateOverride( 'project_header/header', self::$name . ':project_header' );
		$this->template->setTemplateOverride( 'project_header/search', self::$name . ':search' );
		$this->template->setTemplateOverride( 'project_list/listing', self::$name . ':projects_listing' );
		$this->template->setTemplateOverride( 'project_overview/columns', self::$name . ':columns' );
		$this->template->setTemplateOverride( 'task/show', self::$name . ':show' );
		$this->template->setTemplateOverride( 'twofactor/check', self::$name . ':check' );
		$this->template->setTemplateOverride( 'user_list/listing', self::$name . ':users_listing' );
		$this->template->setTemplateOverride( 'user_list/user_title', self::$name . ':user_title' );
		$this->template->setTemplateOverride( 'user_view/profile', self::$name . ':profile' );

		$this->template->hook->attach('template:auth:login-form:before', self::$name . ':login');

		$this->container['colorModel'] = $this->container->factory( function ( $c ) {
			return new Model\ColorModel( $c );
		} );

		$this->container['taskCreationModel'] = $this->container->factory( function ( $c ) {
			return new Model\TaskCreationModel( $c );
		} );

		/**
		 * Extending and overriding default avatar helper to limit number of
		 * template overrides required.
		 */
		$this->helper->register( 'avatar', Helper\MyAvatarHelper::class );
		$this->helper->register( 'projectHeader', Helper\MyProjectHeaderHelper::class );

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
		return '1.4.0';
	}

	public function getPluginHomepage() {
		return 'https://github.com/BCLibCoop/kanboard-plugin-Greenwing';
	}

	public function getPluginDescription() {
		return t( 'This plugin adds a new stylesheet and overrides default styles.' );
	}
}
