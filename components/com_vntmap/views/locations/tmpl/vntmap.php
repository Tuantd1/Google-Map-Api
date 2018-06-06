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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user       = JFactory::getUser();
$userId     = $user->get('id');
$listOrder  = $this->state->get('list.ordering');
$listDirn   = $this->state->get('list.direction');
$canCreate  = $user->authorise('core.create', 'com_vntmap') && file_exists(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'locationform.xml');
$canEdit    = $user->authorise('core.edit', 'com_vntmap') && file_exists(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'locationform.xml');
$canCheckin = $user->authorise('core.manage', 'com_vntmap');
$canChange  = $user->authorise('core.edit.state', 'com_vntmap');
$canDelete  = $user->authorise('core.delete', 'com_vntmap');
?>

<!-- Vị trí của hộp search -->
<input id="pac-input" class="controls" type="text" placeholder="Tìm ...">

<!-- Vị trí dành cho Map -->
<div id="map" class="map"></div>

<?php
$document   = JFactory::getDocument();
$language   = JFactory::getLanguage();

/**
* Lấy tham số thiết lập của component
* Hàm này sẽ chọn một số tham số cần thiết cho hiển thị bản đồ
*
* @param   mảng  &$params là một mảng chứa các tham số của component
*
* @return  mảng  Một mảng chứa các tham số cần thiết
*
*/
function getMapParams($params) {
    $mapapi = $params->get('api_key');
    if ($mapapi != 'YOUR_API_KEY' && strlen($mapapi) == 39) {
        $params = array(
            'center' => $params->get('center'),
            'zoom' => $params->get('zoom'),
            'maptypeid' => $params->get('maptypeid'),
            'styles' => $params->get('styles'),
            'header_height' => $params->get('header_height'),
            'height' => $params->get('height'),
            'api_key' => $mapapi,
            'url' => JURI::root(),
            'form_token' => JHtml::_('form.token'),
        );
        return $params;
    } else {
            JError::raiseWarning( 100, 'No Google Maps API Key entered in your configuration' );
    }
}

/**
 * Thêm bản đồ vào view và làm việc với bản đồ
 * Hàm này sẽ lấy tham số thiết lập bản đồ từ hàm getMapParams để thiết lập
 *
 * @param   mảng  &$params là một mảng chứa các tham số cần thiết cho bản đồ
 * 
 * @return  mảng  Một mảng chứa các tham số cần thiết
 *
 */
function addMap($params) {
    $document = JFactory::getDocument();
    $assetUrl = JURI::root().'components/com_vntmap/assets/';

    // Lấy dữ liệu tham số bản đồ để chuyển qua mã JavaScript (JS)
    $mapParams = getMapParams($params);

    // Lưu trữ các tham số từ php chuyển qua sử dụng trong JS
    // phía JS sử dụng: const params = Joomla.getOptions('params');
    $document->addScriptOptions('params', $mapParams);

    // Thêm định nghĩa style
    $document->addStyleSheet($assetUrl.'css/vntmap.css');

    // Thêm mã JS để hiển thị bản đồ làm việc với bản đồ.
    // Lưu ý: ?v1.1 ở cuối đường dẫn URL là báo cho phía client biết
    // có sự thay đổi mã nguồn từ phía server. Nếu không thì những thay đổi
    // mã từ phía server sẽ không có hiệu lực vì cơ chế cache từ client.
    // Các thay đổi mã JS phần toàn cục: biến, hằng, hàm thì nên thêm phiên
    // bản ví dụ: ?v1.2, ?v1.3,... những thay đổi mã trong nội bộ của một
    // hàm trước đó thì không cần sửa phiên bản.
    $document->addScript($assetUrl.'js/vntmap.js?v1.2');

    // Thêm Google Maps API
    $document->addScript('//maps.googleapis.com/maps/api/js?key='.$mapParams['api_key'].'&libraries=places,geometry,visualization&callback=initMap', true, true, true);
}

// Chuyển items qua JavaScript để hiển thị markers
$document->addScriptOptions('items', $this->items);

// Gọi hàm để thực thi những thay đổi
addMap($this->params);
