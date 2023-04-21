<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EmailAlerts extends Model
{
    /**
     * @var string $table
     */
    protected $table = 'user_email_alert';
    /**
     * @var array $fillable
     */
    protected $fillable = [
        'module_id',
        'frequency',
        'enabled',
        'user_id',
        'time'
    ];

    public $timestamps = false;

    // List of available times that user can select for 'Daily' email alerts
    const DAILY_TIME_OPTIONS = [
        '00:00',
        '09:00',
        '12:00',
        '14:00',
        '17:00',
        '21:00'
    ];

    /**
     * @return Collection
     */
    public static function getEmailAlerts()
    {
        return DB::table('user_email_alert')->where('user_id', Auth::user()->id)->get();
    }

    /**
     * @var int $id
     * @return Collection
     */
    public static function getEmailAlert($id)
    {
        return DB::table('user_email_alert')
            ->where('id', $id)
            ->where('user_id', Auth::user()->id)
            ->get();
    }

    /**
     * @var array $data
     * @return Collection
     */
    public static function createEmailAlert($data)
    {
        $alert = null;
        $exists = DB::table('user_email_alert')->where(['user_id' => Auth::user()->id])->get();
        if(count($exists) < 3) {
            $alert = self::create(
                [
                    'module_id' => $data['module_id'],
                    'frequency' => $data['frequency'],
                    'enabled' => $data['enabled'],
                    'user_id' => Auth::user()->id,
                    'time' => $data['time']
                ]
            );
        }

        return $alert;
    }


    /**
     * @var array $data
     * @return Collection
     * @throws \Exception
     */
    public static function updateEmailAlert($id, $data)
    {
        $record = DB::table('user_email_alert')->where('id', $id)->first();
        if (!$record) {
            throw new \Exception(trans('exception.recordNotFound', ['item' => 'EmailAlerts', 'id' => $id]));
        }
        return self::find($id)->update(array_merge(
            [
                'module_id' => $record->module_id,
                'frequency' => $record->frequency,
                'enabled' => $record->enabled,
                'time' => $record->time
            ],
            $data
        ));
    }


    /**
     * @var int $id
     * @return Collection
     */
    public static function deleteEmailAlert($id)
    {
        return DB::table('user_email_alert')
            ->where('id', $id)
            ->delete();
    }

    public function user() {
        return $this->hasOne(User::Class, 'id', 'user_id');
    }
}
