<?php

namespace Kanboard\Plugin\Greenwing\Helper;
/**
 * Project Header Helper
 *
 * @package helper
 * @author  Frederic Guillot
 */
class ProjectHeaderHelper extends \Kanboard\Helper\ProjectHeaderHelper
{
    /**
     * Render project header (views switcher and search box)
     *
     * @access public
     * @param  array  $project
     * @param  string $controller
     * @param  string $action
     * @param  bool   $boardView
     * @param  string $plugin
     * @return string
     */
    public function render(array $project, $controller, $action, $boardView = false, $plugin = '')
    {
        $filters = array(
            'controller' => $controller,
            'action' => $action,
            'project_id' => $project['id'],
            'search' => $this->getSearchQuery($project),
            'plugin' => $plugin,
        );

        $task = $this->taskFinderModel->getDetails($this->request->getIntegerParam('task_id'));

        return $this->template->render('project_header/header', array(
            'project' => $project,
            'task' => $task,
            'filters' => $filters,
            'categories_list' => $this->categoryModel->getList($project['id'], false),
            'colors_list' => $this->colorModel->getList(false, true),
            'users_list' => $this->projectUserRoleModel->getAssignableUsersList($project['id'], false),
            'custom_filters_list' => $this->customFilterModel->getAll($project['id'], $this->userSession->getId()),
            'board_view' => $boardView,
        ));
    }
}
