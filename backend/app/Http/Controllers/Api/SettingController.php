<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    // --------------------------------------------------------------------------
    /**
     * Fetch Settings
     * @desc This method is for getting settings of user customization for news feed
     * @access private
     * @method POST
     * @param [userId as user]
     */
    public function getSetting(Request $request)
    {
        $sources = Setting::select('name')->where(['user_id' => $request->input('user'), 'type' => 'source'])->get()->toArray();
        $authors = Setting::select('name')->where(['user_id' => $request->input('user'), 'type' => 'author'])->get()->toArray();
        $categories = Setting::select('name')->where(['user_id' => $request->input('user'), 'type' => 'category'])->get()->toArray();

        return response()->json([
            'sources' => $sources,
            'authors' => $authors,
            'categories' => $categories
        ], 200);
    }

    // --------------------------------------------------------------------------
    /**
     * Add Setting
     * @desc This method adds the user's preference want to see in the news feed
     * @access private
     * @method POST
     * @param [userId, name, type]
     */
    public function addSetting(Request $request)
    {
        $data = Setting::where($request->all())->get();
        if (count($data) < 1) {
            $res = DB::table('settings')->insert($request->all());
        }
        return response($res);
    }

    // --------------------------------------------------------------------------
    /**
     * Add Setting
     * @desc This method removes the user's preference not to see in the news feed
     * @access private
     * @method POST
     * @param [userId, name, type]
     */
    public function deleteSetting(Request $request)
    {
        $res = DB::table('settings')->where($request->all())->delete();
        return response($res);
    }
}
