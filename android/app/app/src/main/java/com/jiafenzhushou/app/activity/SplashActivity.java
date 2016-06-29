package com.jiafenzhushou.app.activity;

import android.app.Activity;
import android.content.Intent;
import android.os.Handler;

import com.jiafenzhushou.app.R;
import com.umeng.analytics.MobclickAgent;

import org.androidannotations.annotations.AfterViews;
import org.androidannotations.annotations.EActivity;

@EActivity(R.layout.activity_splash)
public class SplashActivity extends Activity {

    @AfterViews
    public void afterViews() {
        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                jump();
            }
        }, 2000);
    }

    private void jump() {

        Intent intent = new Intent(this, MainActivity_.class);
        startActivity(intent);
        finish();

    }


    @Override
    protected void onResume() {
        super.onResume();
        MobclickAgent.onResume(this);
    }

    @Override
    protected void onPause() {
        super.onPause();
        MobclickAgent.onPause(this);
    }
}