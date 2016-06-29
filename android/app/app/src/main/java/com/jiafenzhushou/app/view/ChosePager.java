package com.jiafenzhushou.app.view;

import android.content.Context;
import android.support.v4.view.ViewPager;
import android.util.AttributeSet;
import android.view.MotionEvent;

/**
 * Created by rocks on 15-1-23.
 */
public class ChosePager extends ViewPager {


    public ChosePager(Context context) {
        super(context);
    }

    public ChosePager(Context context, AttributeSet attrs) {
        super(context, attrs);
    }


    @Override
    public boolean onTouchEvent(MotionEvent ev) {
        return false;
    }
    @Override
    public boolean onInterceptTouchEvent(MotionEvent event) {
        return false;
    }

    @Override
    public void scrollTo(int x, int y){
            super.scrollTo(x, y);
    }
}
