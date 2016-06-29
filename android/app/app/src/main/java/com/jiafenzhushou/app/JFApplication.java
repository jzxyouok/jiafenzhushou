package com.jiafenzhushou.app;

import android.app.Application;
import android.content.Context;
import android.content.SharedPreferences;
import android.preference.PreferenceManager;

/**
 * Created by rocks on 16/4/8.
 */
public class JFApplication extends Application {

    public static Context mContext;
    public static SharedPreferences mPref;
    private static final String TAG = JFApplication.class.getSimpleName();
    public static JFApplication instance;

    @Override
    public void onCreate() {
        super.onCreate();
        mContext = this.getApplicationContext();
        mPref = PreferenceManager.getDefaultSharedPreferences(this);
        instance = this;


    }

}



