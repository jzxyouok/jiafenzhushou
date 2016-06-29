package com.jiafenzhushou.app.activity;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.content.Context;
import android.os.Build.VERSION_CODES;
import android.os.Bundle;
import android.support.v4.app.FragmentActivity;
import android.view.ViewGroup;
import android.view.Window;
import android.view.WindowManager;
import android.widget.LinearLayout.LayoutParams;
import android.widget.TextView;

import com.jiafenzhushou.app.R;
import com.umeng.onlineconfig.OnlineConfigAgent;

import java.lang.reflect.Field;

/**
 * Created by rocks on 14-11-24.
 */
public class BaseActivity extends FragmentActivity {

    boolean isFull = true;
    //状态栏沉浸模式使用
    /*statusbar view*/
    private ViewGroup view;
    /*沉浸颜色*/
    private TextView textView;
    int defaultNavColor = 0;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        OnlineConfigAgent.getInstance().updateOnlineConfig(this);
        if (isFull) {
            if (defaultNavColor != 0) {
                //沉浸模式功能代码
                initStatusbar(this, defaultNavColor);
            } else {
                initStatusbar(this, R.color.nav_background);
            }
        }
    }


    /**
     * 沉浸模式状态栏初始化
     *
     * @param context 上下文
     * @param
     * @return
     */
    @SuppressLint("NewApi")
    public void initStatusbar(Context context, int statusbar_bg) {
        //4.4版本及以上可用
        if (android.os.Build.VERSION.SDK_INT >= VERSION_CODES.KITKAT) {
            // 状态栏沉浸效果
            Window window = ((Activity) context).getWindow();
            window.setFlags(WindowManager.LayoutParams.FLAG_TRANSLUCENT_STATUS,
                    WindowManager.LayoutParams.FLAG_TRANSLUCENT_STATUS);
            window.setFlags(
                    WindowManager.LayoutParams.FLAG_TRANSLUCENT_NAVIGATION,
                    WindowManager.LayoutParams.FLAG_TRANSLUCENT_NAVIGATION);
            //decorview实际上就是activity的外层容器，是一层framlayout
            view = (ViewGroup) ((Activity) context).getWindow().getDecorView();
            LayoutParams lParams = new LayoutParams(
                    LayoutParams.MATCH_PARENT, getStatusBarHeight());
            //textview是实际添加的状态栏view，颜色可以设置成纯色，也可以加上shape，添加gradient属性设置渐变色
            textView = new TextView(this);
            textView.setBackgroundResource(statusbar_bg);
            textView.setLayoutParams(lParams);
            view.addView(textView);
        }
    }

    /**
     * 获取状态栏高度
     *
     * @return
     */
    public int getStatusBarHeight() {
        Class<?> c = null;
        Object obj = null;
        Field field = null;
        int x = 0, statusBarHeight = 0;
        try {
            c = Class.forName("com.android.internal.R$dimen");
            obj = c.newInstance();
            field = c.getField("status_bar_height");
            x = Integer.parseInt(field.get(obj).toString());
            statusBarHeight = getResources().getDimensionPixelSize(x);
        } catch (Exception e1) {
            e1.printStackTrace();
        }
        return statusBarHeight;
    }

    /**
     * 如果项目中用到了slidingmenu,根据slidingmenu滑动百分比设置statusbar颜色：渐变色效果
     *
     * @param alpha
     */
    @SuppressLint("NewApi")
    public void changeStatusBarColor(float alpha) {
        //textview是slidingmenu关闭时显示的颜色
        //textview2是slidingmenu打开时显示的颜色
        textView.setAlpha(1 - alpha);

    }


}
