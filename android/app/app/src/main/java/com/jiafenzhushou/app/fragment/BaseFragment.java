package com.jiafenzhushou.app.fragment;


import android.support.v4.app.Fragment;
import android.widget.Toast;

import com.jiafenzhushou.app.config.UserConfig;
import com.jiafenzhushou.app.event.ShowBuyEvent;
import com.umeng.analytics.MobclickAgent;

import org.greenrobot.eventbus.EventBus;

/**
 * Created by rocks on 16/4/6.
 */
public class BaseFragment extends Fragment {

    @Override
    public void onPause() {
        super.onPause();
        MobclickAgent.onPause(getActivity());
    }

    @Override
    public void onResume() {
        super.onResume();
        MobclickAgent.onResume(getActivity());
    }

    public boolean isBuy() {
        boolean isBuy = UserConfig.getBoolean("register");
        if (isBuy) {
            return true;
        } else {
            showBuy();
            return false;
        }
    }

    public void showBuy() {
        Toast.makeText(getActivity(), "请先购买", Toast.LENGTH_SHORT);
        EventBus.getDefault().post(new ShowBuyEvent());
    }
}
