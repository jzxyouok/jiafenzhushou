package com.jiafenzhushou.app.activity;

import android.support.v4.app.FragmentTabHost;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.TabHost;

import com.jiafenzhushou.app.R;
import com.jiafenzhushou.app.event.ShowBuyEvent;
import com.jiafenzhushou.app.event.StoreEvent;
import com.jiafenzhushou.app.fragment.FragmentHome_;
import com.jiafenzhushou.app.fragment.FragmentSetting_;
import com.jiafenzhushou.app.fragment.FragmentStore_;
import com.umeng.analytics.MobclickAgent;
import com.umeng.update.UmengUpdateAgent;

import org.androidannotations.annotations.AfterViews;
import org.androidannotations.annotations.EActivity;
import org.greenrobot.eventbus.EventBus;
import org.greenrobot.eventbus.Subscribe;

/**
 * Created by rocks on 16/4/5.
 */
@EActivity(R.layout.activity_main)
public class MainActivity extends BaseActivity {
    private FragmentTabHost mTabHost;
    private LayoutInflater layoutInflater;

    @AfterViews
    public void afterViews() {
        UmengUpdateAgent.update(this);
        if (!EventBus.getDefault().isRegistered(this)) {
            EventBus.getDefault().register(this);
        }
        layoutInflater = LayoutInflater.from(this);
        mTabHost = (FragmentTabHost)

                findViewById(android.R.id.tabhost);

        mTabHost.setup(this, getSupportFragmentManager(), R

                .id.realtabcontent);


        View homeView = layoutInflater.inflate(R.layout.tab_item_home, null);
        TabHost.TabSpec homeTab = mTabHost.newTabSpec("home").setIndicator(homeView);


        View storeView = layoutInflater.inflate(R.layout.tab_item_store, null);
        TabHost.TabSpec storeTab = mTabHost.newTabSpec("store").setIndicator(storeView);

        View settingView = layoutInflater.inflate(R.layout.tab_item_setting, null);
        TabHost.TabSpec settingTab = mTabHost.newTabSpec("profile").setIndicator(settingView);


        mTabHost.addTab(homeTab, FragmentHome_.class, null);
        mTabHost.addTab(storeTab, FragmentStore_.class, null);
        mTabHost.addTab(settingTab, FragmentSetting_.class, null);
    }

    @Subscribe
    public void onEvent(StoreEvent event) {
        mTabHost.setCurrentTabByTag("store");
    }

    @Subscribe
    public void onEvent(ShowBuyEvent event) {
        mTabHost.setCurrentTabByTag("profile");
    }

    @Override
    public void onDestroy() {
        super.onDestroy();

    }

    @Override
    public void onResume() {
        super.onResume();
        MobclickAgent.onResume(this);
    }

    @Override
    public void onPause() {
        super.onPause();
        MobclickAgent.onPause(this);
    }

}
