<?php

/**
 * @version    CVS: 1.0.0
 * @package    Com_Vntmap
 * @author     Trịnh Đình Tuấn <trinhtuanqx@gmail.com>
 * @copyright  2018 Trịnh Đình Tuấn
 * @license    bản quyền mã nguồn mở GNU phiên bản 2
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

/**
 * Class VntmapController
 *
 * @since  1.6
 */
class VntmapController extends JControllerLegacy
{
	/**
	 * Method to display a view.
	 *
	 * @param   boolean $cachable  If true, the view output will be cached
	 * @param   mixed   $urlparams An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return  JController   This object to support chaining.
	 *
	 * @since    1.5
	 */
	public function display($cachable = false, $urlparams = false)
	{
        $app  = JFactory::getApplication();
        $view = $app->input->getCmd('view', 'locations');
		$app->input->set('view', $view);

		parent::display($cachable, $urlparams);

		return $this;
	}
}
