package com.jiafenzhushou.app.fragment;

import android.content.ContentProviderOperation;
import android.content.ContentProviderResult;
import android.content.ContentResolver;
import android.content.ContentUris;
import android.content.ContentValues;
import android.content.DialogInterface;
import android.database.Cursor;
import android.graphics.Color;
import android.provider.ContactsContract;
import android.provider.ContactsContract.CommonDataKinds.Phone;
import android.provider.ContactsContract.Data;
import android.view.KeyEvent;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.jiafenzhushou.app.R;
import com.jiafenzhushou.app.config.UserConfig;
import com.jiafenzhushou.app.event.StoreEvent;
import com.jiafenzhushou.app.util.FileUtil;

import org.androidannotations.annotations.AfterViews;
import org.androidannotations.annotations.Background;
import org.androidannotations.annotations.Click;
import org.androidannotations.annotations.EFragment;
import org.androidannotations.annotations.UiThread;
import org.androidannotations.annotations.ViewById;
import org.greenrobot.eventbus.EventBus;

import java.io.BufferedReader;
import java.io.FileInputStream;
import java.io.IOException;
import java.io.InputStreamReader;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

import cn.pedant.SweetAlert.SweetAlertDialog;

;

/**
 * Created by rocks on 16/4/6.
 */
@EFragment(R.layout.fragment_home)
public class FragmentHome extends BaseFragment {
    @ViewById(R.id.store_number)
    TextView storeNumberText;
    @ViewById(R.id.import_number)
    TextView importNumberText;
    @ViewById(R.id.import_number_text)
    EditText numberEditText;
    SweetAlertDialog pDialog;
    int number;
    int importNum;
    int storeNum;
    long groupId = 0;

    @AfterViews
    public void afterViews() {
        updateStore();
    }

    public void updateStore() {
        storeNum = UserConfig.getInt("store_number");
        storeNumberText.setText(String.valueOf(storeNum));
        importNum = UserConfig.getInt("import_number");
        importNumberText.setText(String.valueOf(importNum));
    }

    @Click({R.id.import_button, R.id.import_contact_button})
    public void importButton() {
        if (!isBuy()) {
            return;
        }
        String numberText = numberEditText.getText().toString().trim();
        if (numberText.equals("")) {
            Toast.makeText(getActivity(), "请先输入导入数量", Toast.LENGTH_SHORT).show();
            return;
        }
        number = Integer.parseInt(numberText);
        if (number > (UserConfig.getInt("store_number")-UserConfig.getInt("import_number"))) {
            Toast.makeText(getActivity(), "请先增加号码库", Toast.LENGTH_SHORT).show();
            return;
        }
        if (number > 2000) {
            Toast.makeText(getActivity(), "每次不要超过2000", Toast.LENGTH_SHORT).show();
            return;
        }
        pDialog = new SweetAlertDialog(getActivity(), SweetAlertDialog.PROGRESS_TYPE);
        pDialog.getProgressHelper().setBarColor(Color.parseColor("#A5DC86"));
        pDialog.setTitleText("导入中...");
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
        importNumber();
    }

    public void showGetPhoneError() {
        Toast.makeText(getActivity(), "请先生成号码库", Toast.LENGTH_SHORT).show();
    }

    @Background
    public void importNumber() {
        List<String> phoneNumbers = new ArrayList<>();
        try {
            InputStreamReader reader = new InputStreamReader(new FileInputStream(FileUtil.PHONE_TXT));
            BufferedReader bufferedReader = new BufferedReader(reader);
            String line;
            while ((line = bufferedReader.readLine()) != null) {
                String[] lineData = ((String) line).split(" ");
                phoneNumbers.addAll(Arrays.asList(lineData));
            }
            reader.close();
            bufferedReader.close();

        } catch (IOException exception) {
            showGetPhoneError();
            return;
        }
        ContentResolver contentResolver = getActivity().getContentResolver();
        Cursor cursor = contentResolver.query(ContactsContract.Groups.CONTENT_URI, new String[]{"_id"}, "title=?", new String[]{"加粉助手"}, null);
        if (!cursor.isAfterLast()) {
            cursor.moveToLast();
            groupId = cursor.getLong(cursor.getColumnIndex("_id"));
            cursor.close();
        }
        if (groupId == 0) {
            ContentValues values = new ContentValues();
            values.put(ContactsContract.Groups.TITLE, "加粉助手");
            groupId = ContentUris.parseId(getActivity().getContentResolver().insert(ContactsContract.Groups.CONTENT_URI, values));
        }

        try {
            int rawContactInsertIndex = 0;
            ArrayList<ContentProviderOperation> ops = new ArrayList<ContentProviderOperation>();
            for (int i = 1; i <= number; i++) {
                String phoneNumber = phoneNumbers.get(importNum + i);
                rawContactInsertIndex = ops.size();

                //初始化
                ops.add(ContentProviderOperation
                        .newInsert(ContactsContract.RawContacts.CONTENT_URI)
                        .withYieldAllowed(true)
                        .withValue(ContactsContract.RawContacts.ACCOUNT_TYPE, null)
                        .withValue(ContactsContract.RawContacts.ACCOUNT_NAME, null).build());
                // 添加姓名
                ops.add(ContentProviderOperation
                        .newInsert(Data.CONTENT_URI)
                        .withYieldAllowed(true)
                        .withValueBackReference(Data.RAW_CONTACT_ID, rawContactInsertIndex)
                        .withValue(Data.MIMETYPE, ContactsContract.CommonDataKinds.StructuredName.CONTENT_ITEM_TYPE)
                        .withValue(ContactsContract.CommonDataKinds.StructuredName.DISPLAY_NAME, phoneNumber).build());
                //添加号码
                ops.add(ContentProviderOperation
                        .newInsert(Data.CONTENT_URI)
                        .withValueBackReference(Data.RAW_CONTACT_ID, rawContactInsertIndex)
                        .withValue(Data.MIMETYPE, Phone.CONTENT_ITEM_TYPE)
                        .withValue(Phone.NUMBER, phoneNumber)
                        .withYieldAllowed(true)
                        .withValue(Phone.TYPE, Phone.TYPE_MOBILE).build());
                //添加群组
                ops.add(ContentProviderOperation
                        .newInsert(Data.CONTENT_URI)
                        .withValueBackReference(Data.RAW_CONTACT_ID, rawContactInsertIndex)
                        .withValue(Data.MIMETYPE, ContactsContract.CommonDataKinds.GroupMembership.CONTENT_ITEM_TYPE)
                        .withValue(ContactsContract.CommonDataKinds.GroupMembership.GROUP_ROW_ID, groupId)
                        .withYieldAllowed(true).build());

            }
            ContentProviderResult[] results = getActivity()
                    .getContentResolver().applyBatch(ContactsContract.AUTHORITY, ops);


            showInsertSuccess();

        } catch (Exception exception) {
            showInsertError();
        }

    }

    @UiThread
    public void showInsertSuccess() {
        if (pDialog != null && pDialog.isShowing()) {
            pDialog.dismiss();
        }
        storeNum = storeNum - number;
        importNum = importNum + number;
        UserConfig.setInt("store_number", storeNum);
        UserConfig.setInt("import_number", importNum);
        updateStore();
        Toast.makeText(getActivity(), "添加联系人成功", Toast.LENGTH_SHORT).show();
    }

    @UiThread
    public void showInsertError() {
        if (pDialog != null && pDialog.isShowing()) {
            pDialog.dismiss();
        }

        Toast.makeText(getActivity(), "添加联系人失败！请到设置》权限管理》新建联系人和删除联系人赋予权限", Toast.LENGTH_SHORT).show();

    }

    @Click(R.id.clear_contact_button)
    public void clearContactButton() {
        if (!isBuy()) {
            return;
        }
        pDialog = new SweetAlertDialog(getActivity(), SweetAlertDialog.PROGRESS_TYPE);
        pDialog.getProgressHelper().setBarColor(Color.parseColor("#A5DC86"));
        pDialog.setTitleText("清空中...");
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
        clearContacts();
    }

    @Background
    public void clearContacts() {
        ContentResolver contentResolver = getActivity().getContentResolver();
        Cursor cursor = contentResolver.query(ContactsContract.Groups.CONTENT_URI, new String[]{"_id"}, "title=?", new String[]{"加粉助手"}, null);
        if (!cursor.isAfterLast()) {
            cursor.moveToLast();
            groupId = cursor.getLong(cursor.getColumnIndex("_id"));
            cursor.close();
        }
        cursor.close();
        if (groupId == 0) {
            return;
        }

        try {

            String[] RAW_PROJECTION = new String[]{ContactsContract.Data.RAW_CONTACT_ID,};
            String DELETE_CONTACTS_WHERE = ContactsContract.CommonDataKinds.GroupMembership.GROUP_ROW_ID
                    + "=?"
                    + " and "
                    + ContactsContract.Data.MIMETYPE
                    + "="
                    + "'"
                    + ContactsContract.CommonDataKinds.GroupMembership.CONTENT_ITEM_TYPE
                    + "'";
            // 通过分组的id 查询得到RAW_CONTACT_ID
            Cursor delCursor = getActivity().getContentResolver().query(
                    ContactsContract.Data.CONTENT_URI, RAW_PROJECTION,
                    DELETE_CONTACTS_WHERE, new String[]{groupId + ""}, "data1 asc");

            ArrayList<ContentProviderOperation> ops = new ArrayList<ContentProviderOperation>();

            while (delCursor.moveToNext()) {
                int col = delCursor.getColumnIndex("raw_contact_id");
                int raw_contact_id = delCursor.getInt(col);
                ops.add(ContentProviderOperation.newDelete(ContactsContract.RawContacts.CONTENT_URI)
                        .withSelection(ContactsContract.RawContacts.CONTACT_ID + "=" + raw_contact_id, null)
                        .build());
                ops.add(ContentProviderOperation.newDelete(ContactsContract.Data.CONTENT_URI)
                        .withSelection(ContactsContract.Data.CONTACT_ID + "=" + raw_contact_id, null)
                        .build());
            }
            delCursor.close();

            ContentProviderResult results[] =
                    contentResolver.applyBatch(ContactsContract.AUTHORITY, ops);
            int deleteResult = contentResolver.delete(
                    ContactsContract.Data.CONTENT_URI,
                    DELETE_CONTACTS_WHERE, new String[]{String.valueOf(groupId)});

            clearSuccess();
        } catch (Exception e) {
            clearContactError();
        }


    }

    @UiThread
    public void clearSuccess() {
        if (pDialog != null && pDialog.isShowing()) {
            pDialog.dismiss();
        }
        Toast.makeText(getActivity(), "清理成功", Toast.LENGTH_SHORT).show();
    }

    @UiThread
    public void clearContactError() {
        if (pDialog != null && pDialog.isShowing()) {
            pDialog.dismiss();
        }
        Toast.makeText(getActivity(), "是否没有生成", Toast.LENGTH_SHORT).show();
    }

    @Click(R.id.clear_history_button)
    public void clearHistoryButton() {
        if (!isBuy()) {
            return;
        }
        UserConfig.setInt("import_number", 0);
        updateStore();
        Toast.makeText(getActivity(), "清理成功", Toast.LENGTH_SHORT).show();

    }

    @Click(R.id.import_store_button)
    public void importStoreButton() {

        if (!isBuy()) {
            return;
        }
        EventBus.getDefault().post(new StoreEvent());
    }

    @Override
    public void onResume() {
        super.onResume();
        updateStore();
    }
}
