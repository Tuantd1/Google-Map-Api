<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Vntmap
 * @author     Trịnh Đình Tuấn <trinhtuanqx@gmail.com>
 * @copyright  2018 Trịnh Đình Tuấn
 * @license    bản quyền mã nguồn mở GNU phiên bản 2
 */


// No direct access.
defined('_JEXEC') or die;

/**
 * Locations list controller class.
 *
 * @since  1.6
 */
class VntmapControllerLocations extends VntmapController
{
	/**
	 * Proxy for getModel.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional
	 * @param   array   $config  Configuration array for model. Optional
	 *
	 * @return object	The model
	 *
	 * @since	1.6
	 */
	public function &getModel($name = 'Locations', $prefix = 'VntmapModel', $config = array())
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));

		return $model;
	}
}
