package com.jiafenzhushou.app.config;

import android.app.Activity;
import android.content.SharedPreferences;

import com.jiafenzhushou.app.JFApplication;

/**
 * Created by rocks on 15-6-18.
 */
public class UserConfig {


    public static SharedPreferences getShare() {
        return JFApplication.mContext.getSharedPreferences("user", Activity.MODE_PRIVATE);
    }

    public static void set(String name, String value) {
        SharedPreferences.Editor editor = getShare().edit();
        editor.putString(name, value);
        editor.commit();
    }

    public static String get(String name) {
        String result = getShare().getString(name, "");
        return result;
    }

    public static void remove(String key) {
        SharedPreferences.Editor editor = getShare().edit();
        editor.remove(key);
        editor.commit();
    }

    public static void setInt(String name, int value) {
        SharedPreferences.Editor editor = getShare().edit();
        editor.putInt(name, value);
        editor.commit();
    }

    public static int getInt(String name) {
        int result = getShare().getInt(name, 0);
        return result;
    }

    public static void setBoolean(String name, boolean value) {
        SharedPreferences.Editor editor = getShare().edit();
        editor.putBoolean(name, value);
        editor.commit();
    }

    public static boolean getBoolean(String name) {
        boolean result = getShare().getBoolean(name, false);
        return result;
    }
}
