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

jimport('joomla.application.component.controllerform');

/**
 * Location controller class.
 *
 * @since  1.6
 */
class VntmapControllerLocation extends JControllerForm
{
	/**
	 * Constructor
	 *
	 * @throws Exception
	 */
	public function __construct()
	{
		$this->view_list = 'locations';
		parent::__construct();
	}
}
