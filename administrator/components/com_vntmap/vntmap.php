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

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_vntmap'))
{
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::registerPrefix('Vntmap', JPATH_COMPONENT_ADMINISTRATOR);
JLoader::register('VntmapHelper', JPATH_COMPONENT_ADMINISTRATOR . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'vntmap.php');

$controller = JControllerLegacy::getInstance('Vntmap');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
