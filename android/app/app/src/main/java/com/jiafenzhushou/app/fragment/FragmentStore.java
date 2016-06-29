package com.jiafenzhushou.app.fragment;

import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Color;
import android.view.KeyEvent;
import android.view.View;
import android.widget.EditText;
import android.widget.GridView;
import android.widget.TextView;
import android.widget.Toast;

import com.jiafenzhushou.app.JFApplication;
import com.jiafenzhushou.app.R;
import com.jiafenzhushou.app.activity.ChoseCityActivity_;
import com.jiafenzhushou.app.adapter.ProvinceGridAdapter;
import com.jiafenzhushou.app.config.UserConfig;
import com.jiafenzhushou.app.util.FileUtil;

import org.androidannotations.annotations.AfterViews;
import org.androidannotations.annotations.Background;
import org.androidannotations.annotations.Click;
import org.androidannotations.annotations.EFragment;
import org.androidannotations.annotations.ItemClick;
import org.androidannotations.annotations.UiThread;
import org.androidannotations.annotations.ViewById;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileWriter;
import java.io.IOException;
import java.io.InputStreamReader;
import java.text.DecimalFormat;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;
import java.util.Random;

import cn.pedant.SweetAlert.SweetAlertDialog;

/**
 * Created by rocks on 16/4/6.
 */
@EFragment(R.layout.fragment_store)
public class FragmentStore extends BaseFragment {


    @ViewById(R.id.city_text)
    TextView cityText;

    @ViewById(R.id.hot_city_grid)
    GridView gridView;
    @ViewById(R.id.loadingBar)
    View loadingBar;

    @ViewById(R.id.gen_num_text)
    EditText genNumText;

    List<String> cities;
    List<String> provinces;

    String currentCity;
    String currentProvince;
    int totalNum = 0;
    SweetAlertDialog pDialog;

    @AfterViews
    public void afterViews() {
        this.provinces = new ArrayList<>();
        this.cities = new ArrayList<>();
        getCities();
    }

    @Background
    public void getCities() {
        try {
            InputStreamReader reader = new InputStreamReader(getActivity().getResources().getAssets().open("city.txt"));
            BufferedReader bufferedReader = new BufferedReader(reader);
            String line;
            while ((line = bufferedReader.readLine()) != null) {
                String[] lineData = ((String) line).split("=");
                if ((lineData != null) && (lineData.length == 2)) {
                    provinces.add(lineData[0]);
                    String cityStr = lineData[1];
                    String[] cityData = ((String) cityStr).split(" ");
                    if (cityData != null) {
                        cities.add(cityData[0]);
                    }
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
        Toast.makeText(getActivity(), "请联系管理员", Toast.LENGTH_SHORT).show();
    }

    @UiThread
    public void getSuccess() {
        showGridView();
        ProvinceGridAdapter provinceGridAdapter = new ProvinceGridAdapter(getActivity(), cities);
        gridView.setAdapter(provinceGridAdapter);

    }

    @ItemClick(R.id.hot_city_grid)
    public void itemClick(int position) {
        ((ProvinceGridAdapter) gridView.getAdapter()).setSeclection(position);
        ((ProvinceGridAdapter) gridView.getAdapter()).notifyDataSetChanged();
        currentCity = (String) gridView.getAdapter().getItem(position);
        currentProvince = provinces.get(position);
        cityText.setText(currentCity);

    }

    @Click({R.id.city_text, R.id.chose_city_button, R.id.more_album_video_btn})
    public void choseCity() {
        if (!isBuy()) {
            return;
        }
        ((ProvinceGridAdapter) gridView.getAdapter()).setSeclection(-1);
        ((ProvinceGridAdapter) gridView.getAdapter()).notifyDataSetChanged();
        Intent intent = new Intent(getActivity(), ChoseCityActivity_.class);
        startActivityForResult(intent, 0);
    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, Intent data) {
        if (resultCode == 1) {
            currentProvince = data.getStringExtra("province");
            currentCity = data.getStringExtra("city");
            ((ProvinceGridAdapter) gridView.getAdapter()).setSeclection(-1);
            ((ProvinceGridAdapter) gridView.getAdapter()).notifyDataSetChanged();
            cityText.setText(currentCity);
        }
    }

    @Click(R.id.gen_button)
    public void genButton() {
        if (!isBuy()) {
            return;
        }
        String numText = genNumText.getText().toString();
        if (numText.equals("")) {
            Toast.makeText(getActivity(), "请输入生成数量", Toast.LENGTH_SHORT).show();
            return;
        }
        totalNum = Integer.parseInt(numText);
        if (currentCity == null || currentCity.equals("") || currentProvince == null || currentProvince.equals("")) {
            Toast.makeText(getActivity(), "请选择城市", Toast.LENGTH_SHORT).show();
            return;
        }

        if ((totalNum == 0) || (totalNum > 100000)) {
            Toast.makeText(getActivity(), "请输入生成数量1-10000", Toast.LENGTH_SHORT).show();
            return;
        }
        pDialog = new SweetAlertDialog(getActivity(), SweetAlertDialog.PROGRESS_TYPE);
        pDialog.getProgressHelper().setBarColor(Color.parseColor("#A5DC86"));
        pDialog.setTitleText("生成中...");
        pDialog.setCancelable(true);
        pDialog.setCanceledOnTouchOutside(false);
        pDialog.setOnKeyListener(new DialogInterface.OnKeyListener() {
            @Override
            public boolean onKey(DialogInterface dialog, int keyCode, KeyEvent event) {
                if (keyCode == KeyEvent.KEYCODE_BACK && event.getRepeatCount() == 0) {
                    return true;
                } else {
                    return false;
                }
            }
        });
        pDialog.show();
        initPhoneNumber();

    }

    @Background
    public void initPhoneNumber() {
        List<String> baseNums = new ArrayList<>();
        File cityNumText = new File(FileUtil.DATA_DIR + File.separator + currentProvince + File.separator + currentCity + ".txt");
        if (!cityNumText.exists()) {
            try {
                FileUtil.copy(getActivity(), "num.zip", FileUtil.APP_DIR, "num.zip");
                FileUtil.unZipFile(FileUtil.APP_DIR + File.separator + "num.zip", FileUtil.DATA_DIR);
            } catch (IOException e) {
                moveFailed();
                return;
            }
        }
        try {
            InputStreamReader reader = new InputStreamReader(new FileInputStream(cityNumText));
            BufferedReader bufferedReader = new BufferedReader(reader);
            String line;
            while ((line = bufferedReader.readLine()) != null) {
                String[] lineData = ((String) line).split(" ");
                baseNums.addAll(Arrays.asList(lineData));
            }
            reader.close();
            bufferedReader.close();

        } catch (IOException exception) {
            showReadCityError();
            return;
        }
        int numListSize = baseNums.size();
        String genNums = "";
        for (int i = 0; i < totalNum; i++) {
            Random random = new Random(System.nanoTime());
            int numberPos = random.nextInt(numListSize);
            int endNum = random.nextInt(10000);
            DecimalFormat format = new DecimalFormat("0000");
            String phoneNumber = baseNums.get(numberPos) + format.format(endNum);
            genNums = genNums + phoneNumber + " ";
        }

        try {
            File file = new File(FileUtil.PHONE_TXT);
            if (file.exists()) {
                file.delete();
            }
            file.createNewFile();
            FileWriter fileWritter = new FileWriter(file, true);
            BufferedWriter bufferWritter = new BufferedWriter(fileWritter);
            bufferWritter.write(genNums);
            bufferWritter.close();
        } catch (IOException exception) {
            showReadCityError();
            return;
        }
        showGenSuccess();

    }

    @UiThread
    public void showGenSuccess() {
        UserConfig.setInt("store_number", totalNum);
        UserConfig.setInt("import_number", 0);
        if (pDialog != null && pDialog.isShowing()) {
            pDialog.dismiss();
        }
        Toast.makeText(getActivity(), "生成成功", Toast.LENGTH_SHORT).show();
    }


    @UiThread
    public void showReadCityError() {
        if (pDialog != null && pDialog.isShowing()) {
            pDialog.dismiss();
        }
        Toast.makeText(getActivity(), "请联系管理员", Toast.LENGTH_SHORT).show();
    }

    @UiThread
    public void moveFailed() {
        if (pDialog != null && pDialog.isShowing()) {
            pDialog.dismiss();
        }
        Toast.makeText(JFApplication.mContext, "生成失败,检查SD卡是否已满", Toast.LENGTH_SHORT).show();
    }

}