package com.jiafenzhushou.app.fragment;


import android.content.ClipboardManager;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Color;
import android.net.Uri;
import android.provider.Settings.Secure;
import android.view.KeyEvent;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.jiafenzhushou.app.JFApplication;
import com.jiafenzhushou.app.R;
import com.jiafenzhushou.app.config.UserConfig;
import com.jiafenzhushou.app.encode.Decode;
import com.jiafenzhushou.app.util.FileUtil;
import com.umeng.onlineconfig.OnlineConfigAgent;
import com.umeng.update.UmengUpdateAgent;

import org.androidannotations.annotations.AfterViews;
import org.androidannotations.annotations.Background;
import org.androidannotations.annotations.Click;
import org.androidannotations.annotations.EFragment;
import org.androidannotations.annotations.UiThread;
import org.androidannotations.annotations.ViewById;

import java.io.File;
import java.io.IOException;

import cn.pedant.SweetAlert.SweetAlertDialog;

/**
 * Created by rocks on 16/4/6.
 */
@EFragment(R.layout.fragment_setting)
public class FragmentSetting extends BaseFragment {
    @ViewById(R.id.activate_button_text)
    EditText codeEditText;
    @ViewById(R.id.input_code_area)
    View codeArea;

    @ViewById(R.id.device_status_area)
    View deviceStatusArea;


    @ViewById(R.id.device_number_area)
    View deviceNumberArea;

    @ViewById(R.id.device_number_text)
    TextView deviceNumberText;
    SweetAlertDialog pDialog;
    String uuid;
    String code;

    @AfterViews
    public void afterViews() {
        uuid = Secure.getString(getActivity().getContentResolver(), Secure.ANDROID_ID);
        deviceNumberText.setText(uuid);

        boolean isRegister = UserConfig.getBoolean("register");
        if (isRegister) {
            showInfoArea();
        }

    }

    @Click(R.id.activate_button)
    public void activiteButton() {
        code = codeEditText.getText().toString();
        if (code.equals("")) {
            Toast.makeText(getActivity(), "请输入激活码", Toast.LENGTH_LONG).show();
            return;
        }
        boolean result = false;
        try {
            String encode = Decode.encode(uuid);
            result = encode.equals(code);
        } catch (Exception ex) {
            result = false;
        }

        if (!result) {
            Toast.makeText(getActivity(), "激活码不正确请重新输入", Toast.LENGTH_LONG).show();
            return;
        }
        pDialog = new SweetAlertDialog(getActivity(), SweetAlertDialog.PROGRESS_TYPE);
        pDialog.getProgressHelper().setBarColor(Color.parseColor("#A5DC86"));
        pDialog.setTitleText("激活中...");
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
        moveFile();
    }

    @Background
    public void moveFile() {
        try {
            FileUtil.copy(getActivity(), "num.zip", FileUtil.APP_DIR, "num.zip");
            FileUtil.unZipFile(FileUtil.APP_DIR + File.separator + "num.zip", FileUtil.DATA_DIR);
            moveSuccess();
        } catch (IOException e) {
            moveFailed();
        }
    }

    public void showInfoArea() {
        codeArea.setVisibility(View.GONE);
        deviceStatusArea.setVisibility(View.VISIBLE);
        deviceNumberArea.setVisibility(View.GONE);

    }

    @UiThread
    public void moveSuccess() {
        try {
            if (pDialog != null && pDialog.isShowing()) {
                pDialog.dismiss();
            }
            UserConfig.setBoolean("register", true);
            UserConfig.set("code", code);
            showInfoArea();
            Toast.makeText(JFApplication.mContext, "激活完成", Toast.LENGTH_SHORT).show();
        } catch (Exception e) {
            Toast.makeText(JFApplication.mContext, "页面未正常关闭", Toast.LENGTH_SHORT).show();
        }

    }

    @UiThread
    public void moveFailed() {
        if (pDialog != null && pDialog.isShowing()) {
            pDialog.dismiss();
        }
        Toast.makeText(JFApplication.mContext, "激活失败,检查SD卡是否已满", Toast.LENGTH_SHORT).show();
    }

    @Click({R.id.qun_button, R.id.feed_back})
    public void qunButton() {
        String qun = OnlineConfigAgent.getInstance().getConfigParams(getActivity(), "qun");
        if (qun == null || qun == "") {
            qun = "U8337ekcQN1TArk-N4FEvt7Pf8cTSm6U";
        }
        joinQQGroup(qun);
    }

    /****************
     * 发起添加群流程。群号：群挑网-寒冰射手(214084535) 的 key 为： U8337ekcQN1TArk-N4FEvt7Pf8cTSm6U
     * 调用 joinQQGroup(U8337ekcQN1TArk-N4FEvt7Pf8cTSm6U) 即可发起手Q客户端申请加群 群挑网-寒冰射手(214084535)
     *
     * @param key 由官网生成的key
     * @return 返回true表示呼起手Q成功，返回fals表示呼起失败
     ******************/
    public boolean joinQQGroup(String key) {
        Intent intent = new Intent();
        intent.setData(Uri.parse("mqqopensdkapi://bizAgent/qm/qr?url=http%3A%2F%2Fqm.qq.com%2Fcgi-bin%2Fqm%2Fqr%3Ffrom%3Dapp%26p%3Dandroid%26k%3D" + key));
        // 此Flag可根据具体产品需要自定义，如设置，则在加群界面按返回，返回手Q主界面，不设置，按返回会返回到呼起产品界面    //intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK)
        try {
            startActivity(intent);
            return true;
        } catch (Exception e) {
            // 未安装手Q或安装的版本不支持
            return false;
        }
    }

    @Click(R.id.update_button)
    public void updateButton() {
        Toast.makeText(JFApplication.mContext, "正在检查...", Toast.LENGTH_SHORT).show();
        UmengUpdateAgent.forceUpdate(getActivity());
    }


    @Click(R.id.buy_button)
    public void buyButton() {
        String shop = OnlineConfigAgent.getInstance().getConfigParams(getActivity(), "shop");
        if (shop == null || shop == "") {
            shop = "https://shop114044304.taobao.com";
        }
        Uri uri = Uri.parse(shop);
        Intent it = new Intent(Intent.ACTION_VIEW, uri);
        startActivity(it);
    }

    @Click(R.id.copy_button)
    public void copy() {
        ClipboardManager cmb = (ClipboardManager) getActivity()
                .getSystemService(Context.CLIPBOARD_SERVICE);
        cmb.setText(uuid.trim());
        Toast.makeText(getActivity(), "复制成功", Toast.LENGTH_SHORT).show();
    }

}
