<?php
/**
 * Created by PhpStorm.
 * User: edi-r
 * Date: 6/8/2017
 * Time: 6:39 AM
 */

namespace App\Http\API\V1\Controllers;

use App\Http\API\V1\Requests\SettingRequest;
use App\Http\Controllers\ApiController;
use App\Models\Setting;
use App\Models\Theme;
use App\Services\ModelService;
use App\Services\SettingService;
use Illuminate\Support\Facades\Auth;

/**
 * Class SettingsController
 * @package App\Http\API\V1\Controllers
 */
class SettingsController extends ApiController
{
    /**
     * @var string $_for
     */
    protected $_for = "settings";

    /**
     * @var string $_modelClass
     */
    protected $_modelClass = Setting::class;

    /**
     * @var string $_requestClass
     */
    protected $_requestClass = SettingRequest::class;

    /**
     *
     * Override store method of parent class
     * Make additional changes and return parent store method
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store()
    {
        $this->_commonData_();
        $this->_data['user_id'] = Auth::id();

        return parent::store();
    }

    /**
     * @param int|null $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function update($id = null)
    {
        $key = request('key');
        $value = request('value');

        SettingService::validateSettingAssignment($key, $value);

        $setting = $this->_model->forUserOnly()
            ->key($key)
            ->first();

        if (!$setting) {
            $fieldData = SettingService::isSettingFieldAllowed($key);
            if (!is_null($fieldData)) {
                $this->_data['user_id'] = Auth::id();
                $this->_data['key'] = $fieldData['key'];
                $this->_data['title'] = $fieldData['title'];
                $this->_data['value'] = $value;
                return parent::store();
            }
            throw new \Exception(trans('exception.recordNotFound', ['item' => 'Setting', 'id' => $key]));
        } else {
            return parent::update($setting->id);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function changeTheme()
    {
        if (request()->filled('theme_abbreviation')) {
            $theme_abbreviation = request()->get('theme_abbreviation');
            $theme = Theme::where('abbreviation', $theme_abbreviation)->first();
            if ($theme) {
                $themeSetting = Setting::where(['user_id' => Auth::id(), 'key' => Setting::THEME_KEY])->first();
                if (!$themeSetting) {
                    $this->_data['user_id'] = Auth::id();
                    $this->_data['key'] = Setting::THEME_KEY;
                    $this->_data['title'] = Setting::THEME_LABEL;
                    $this->_data['value'] = $theme->id;
                    return parent::store();
                }

                $this->_data['value'] = $theme->id;
                return parent::update($themeSetting->id);

            }

            throw new \Exception(trans('message.themeNotFound', ['item' => $theme_abbreviation]));

        }

        throw new \Exception(trans('message.attrNotFound', ['item' => 'theme_abbreviation']));
    }

    /**
     * Add common fields to object _data property
     *
     * @return void
     */
    private function _commonData_()
    {
        $this->_data = [
            'title' => request()->get('title'),
            'key' => request()->get('key'),
        ];
    }
}
