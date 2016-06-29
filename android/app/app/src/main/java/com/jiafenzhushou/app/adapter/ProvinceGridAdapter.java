package com.jiafenzhushou.app.adapter;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.jiafenzhushou.app.R;

import java.util.List;

/**
 * Created by rocks on 16/4/8.
 */
public class ProvinceGridAdapter extends BaseAdapter {
    List<String> provinces;
    Context context;
    LayoutInflater mInflater;
    int clickPosition = -1;

    public ProvinceGridAdapter(Context context, List<String> provinces) {
        this.context = context;
        mInflater = LayoutInflater.from(context);
        this.provinces = provinces;

    }

    public List<String> getProvinces() {
        return provinces;
    }

    public void setProvinces(List<String> provinces) {
        this.provinces = provinces;
    }

    @Override
    public int getCount() {
        return provinces.size();
    }

    @Override
    public Object getItem(int position) {
        return provinces.get(position);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    public void setSeclection(int position) {
        clickPosition = position;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        ViewHolder viewHolder;
        if (convertView == null) {
            convertView = mInflater.inflate(R.layout.item_city_grid, null);
            viewHolder = new ViewHolder();
            viewHolder.cityText = (TextView) convertView.findViewById(R.id.city_name);
            convertView.setTag(viewHolder);
        }
        viewHolder = (ViewHolder) convertView.getTag();
        if (position == clickPosition) {
            viewHolder.cityText.setSelected(true);
            viewHolder.cityText.setTextColor(context.getResources().getColor(R.color.white));
        } else {
            viewHolder.cityText.setSelected(false);
            viewHolder.cityText.setTextColor(context.getResources().getColor(R.color.item_selected_color));
        }
        String city = provinces.get(position);
        viewHolder.cityText.setText(city);
        return convertView;
    }

    class ViewHolder {
        private TextView cityText;
    }
}
