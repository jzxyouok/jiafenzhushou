package com.jiafenzhushou.app.activity;

import android.content.Intent;
import android.view.View;
import android.widget.GridView;
import android.widget.TextView;
import android.widget.Toast;

import com.jiafenzhushou.app.R;
import com.jiafenzhushou.app.adapter.ProvinceGridAdapter;
import com.umeng.analytics.MobclickAgent;

import org.androidannotations.annotations.AfterViews;
import org.androidannotations.annotations.Background;
import org.androidannotations.annotations.Click;
import org.androidannotations.annotations.EActivity;
import org.androidannotations.annotations.ItemClick;
import org.androidannotations.annotations.UiThread;
import org.androidannotations.annotations.ViewById;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

/**
 * Created by rocks on 16/4/8.
 */
@EActivity(R.layout.activity_chose_city)
public class ChoseCityActivity extends BaseActivity {
    @ViewById(R.id.loadingBar)
    View loadingBar;
    @ViewById(R.id.grid_view)
    GridView gridView;
    @ViewById(R.id.province_button)
    TextView provinceButton;
    @ViewById(R.id.city_button)
    TextView cityButton;

    List<String> provinces = new ArrayList<>();
    Map<String, List<String>> cityMap = new HashMap();
    String currentProvince;
    String currentCity;
    String currentSelect;

    @AfterViews
    public void afterViews() {
        currentSelect = "province";
        provinceButton.setSelected(true);
        getCities();
    }

    @Background
    public void getCities() {
        try {
            InputStreamReader reader = new InputStreamReader(this.getResources().getAssets().open("city.txt"));
            BufferedReader bufferedReader = new BufferedReader(reader);
            String line;
            while ((line = bufferedReader.readLine()) != null) {
                String[] lineData = ((String) line).split("=");
                if ((lineData != null) && (lineData.length == 2)) {
                    String province = lineData[0];
                    provinces.add(lineData[0]);
                    String cityStr = lineData[1];
                    String[] cityArray = ((String) cityStr).split(" ");
                    List<String> cityList = Arrays.asList(cityArray);
                    cityMap.put(province, cityList);
                }
            }
            reader.close();
            bufferedReader.close();
            getSuccess();

        } catch (IOException exception) {
            showReaderError();
        }

    }

    private void showGridView() {
        loadingBar.setVisibility(View.GONE);
    }

    @UiThread
    public void showReaderError() {
        showGridView();
        Toast.makeText(this, "请联系管理员", Toast.LENGTH_SHORT).show();
    }

    @UiThread
    public void getSuccess() {
        showGridView();
        setCurrentProvince();
    }

    public void setCurrentProvince() {
        currentSelect = "province";
        ProvinceGridAdapter provinceGridAdapter = new ProvinceGridAdapter(this, provinces);
        gridView.setAdapter(provinceGridAdapter);
        provinceButton.setSelected(true);
        cityButton.setSelected(false);
    }

    public void setCurrentCity() {
        currentSelect = "city";
        List<String> cities = cityMap.get(currentProvince);
        ProvinceGridAdapter provinceGridAdapter = new ProvinceGridAdapter(this, cities);
        gridView.setAdapter(provinceGridAdapter);
        provinceButton.setSelected(false);
        cityButton.setSelected(true);
    }

    @ItemClick(R.id.grid_view)
    public void itemClick(int position) {
        ((ProvinceGridAdapter) gridView.getAdapter()).setSeclection(position);
        ((ProvinceGridAdapter) gridView.getAdapter()).notifyDataSetChanged();
        if (currentSelect.equals("province")) {
            currentProvince = (String) gridView.getAdapter().getItem(position);
            setCurrentCity();
        } else {
            currentCity = (String) gridView.getAdapter().getItem(position);
        }
    }

    @Click(R.id.back_button)
    public void backButton() {
        if (currentSelect.equals("city")) {
            setCurrentProvince();
        } else {
            noSelectFinish();
        }
    }

    public void onBackPressed() {
        if (currentSelect.equals("city")) {
            setCurrentProvince();
        } else {
            noSelectFinish();
        }
    }

    public void noSelectFinish() {
        setResult(0);
        finish();
    }

    @Click(R.id.ok_button)
    public void okButton() {
        Intent intent = new Intent();
        intent.putExtra("province", currentProvince);
        intent.putExtra("city", currentCity);
        setResult(1, intent);
        finish();
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

