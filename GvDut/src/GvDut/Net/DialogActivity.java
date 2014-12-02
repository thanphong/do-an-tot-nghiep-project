package GvDut.Net;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;

import GvDut.services.LichbaobuJson;
import GvDut.services.PhongJson;
import GvDut.services.TkbieuJson;
import GvDut.services.ValueJson;
import android.app.AlertDialog;
import android.app.DatePickerDialog;
import android.app.Dialog;
import android.app.DialogFragment;
import android.content.Context;
import android.content.DialogInterface;
import android.graphics.Color;
import android.os.Bundle;
import android.util.Log;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ArrayAdapter;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.TableLayout;
import android.widget.TableRow;
import android.widget.TextView;


public class DialogActivity extends DialogFragment {

	public List<TkbieuJson> tkbieuJsons;
	Context context;
	int type;
	public EditText depatureDate;
	public TkbieuJson tkbieuJson;
	public LichbaobuJson lichbaobuJson;
	public List<PhongJson> phongJsons;
	public Dialog dialog;
	private DatePickerDialog.OnDateSetListener datePickerListener = new DatePickerDialog.OnDateSetListener() {
		// when dialog box is closed, below method will be called.
		public void onDateSet(DatePicker view, int selectedYear,
				int selectedMonth, int selectedDay) {
			int year = selectedYear;
			int month = selectedMonth;
			int day = selectedDay;
			depatureDate.setText(new StringBuilder().append(year).append("-")
					.append(month + 1).append("-").append(day).append(" "));
			if (tkbieuJson != null)
				tkbieuJson.setNgaynghi(depatureDate.getText().toString());
			if (lichbaobuJson != null) {
				lichbaobuJson.setNgayday(depatureDate.getText().toString());
			}
		}
	};

	@Override
	public Dialog onCreateDialog(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		final AlertDialog.Builder builder = new AlertDialog.Builder(
				getActivity());
		// Get the layout inflater
		LayoutInflater inflater = getActivity().getLayoutInflater();
		View v;
		switch (type) {
		case 0:
			v = inflater.inflate(R.layout.comfirm_layout, null);
			TextView txtAlert = (TextView) v.findViewById(R.id.comfirm);
			txtAlert.setText(R.string.cofimbaonghi);
			builder.setView(v)
					.setPositiveButton("Cancel",
							new DialogInterface.OnClickListener() {

								public void onClick(DialogInterface dialog,
										int which) {
									// TODO Auto-generated method stub
									dialog.cancel();
								}
							})
					.setNegativeButton("Ok",
							new DialogInterface.OnClickListener() {

								public void onClick(DialogInterface dialog,
										int which) {
									// TODO Auto-generated method stub

								}

							});
			dialog = builder.create();
			return dialog;
			// break;
		case 1:
			// year=
			final Calendar calendar = Calendar.getInstance();
			int year = calendar.get(Calendar.YEAR);
			int month = calendar.get(Calendar.MONTH);
			int day = calendar.get(Calendar.DAY_OF_MONTH);
			return new DatePickerDialog(context, datePickerListener, year,
					month, day);
		case 3:
			SimpleDateFormat formatter = new SimpleDateFormat("yyyy-MM-dd");
			final List<ValueJson> valueJsons = new ArrayList<ValueJson>();
			try {
				Date ngaykethuc = formatter.parse(tkbieuJson.getNgayketthuc());
				Calendar date = Calendar.getInstance();
				int thu = date.get(Calendar.DAY_OF_WEEK);
				int delta = tkbieuJson.getThu() - thu;
				date.add(Calendar.DATE,  delta);
				Log.d("date:", date.getTime().toString()+"-"+ngaykethuc.toString());
				while (date.getTime().compareTo(ngaykethuc)<0) {
					ValueJson valueJson = new ValueJson();
					valueJson.setValue1("Thứ "+date.get(Calendar.DAY_OF_WEEK)+" "+date.get(Calendar.DAY_OF_MONTH)+"-"+ (date.get(Calendar.MONTH)+1) +"-"+date.get(Calendar.YEAR));
					valueJson.setValue2(date.get(Calendar.YEAR) + "-"
							+( date.get(Calendar.MONTH) +1)+ "-"
							+ date.get(Calendar.DAY_OF_MONTH));
					valueJsons.add(valueJson);
					date.add(Calendar.DATE,  7);
				}
				v = inflater.inflate(R.layout.customer_listview, null);
				ListView lv = (ListView) v.findViewById(R.id.listView1);
				ArrayAdapter<ValueJson> adapter = new ArrayAdapter<ValueJson>(
						context, android.R.layout.simple_dropdown_item_1line,
						valueJsons);
				adapter.setDropDownViewResource(android.R.layout.simple_dropdown_item_1line);
				lv.setAdapter(adapter);
				lv.setOnItemClickListener(new OnItemClickListener() {

					@Override
					public void onItemClick(AdapterView<?> parent, View view,
							int position, long id) {
						// TODO Auto-generated method stub
						depatureDate.setText(valueJsons.get(position).getValue2());
						tkbieuJson.setNgaynghi(valueJsons.get(position).getValue2());
						dialog.dismiss();
					}
				});
				builder.setView(v).setPositiveButton("Cancel",
						new DialogInterface.OnClickListener() {

							public void onClick(DialogInterface dialog,
									int which) {
								// TODO Auto-generated method stub
								dialog.cancel();
							}
						});
				builder.setTitle("Danh sách các ngày dạy");
				dialog = builder.create();
				return dialog;
			} catch (ParseException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}

			break;
		case 2:
			v = inflater.inflate(R.layout.danhsachphong_layout, null);
			TableLayout danhsachphong = (TableLayout) v
					.findViewById(R.id.danhsachphong);
			int i = 1;
			TableRow.LayoutParams tableRowParams = new TableRow.LayoutParams();
			tableRowParams.setMargins(1, 1, 1, 1);
			tableRowParams.weight = 1;
			for (final PhongJson phong : phongJsons) {
				TableRow tableRow = new TableRow(context);
				TextView tvStt = new TextView(context);
				tvStt.setBackgroundColor(Color.parseColor("#bae8f4"));
				tvStt.setGravity(Gravity.LEFT);
				tvStt.setText(i + "");
				final TextView tvmaphong = new TextView(context);
				tvmaphong.setBackgroundColor(Color.parseColor("#bae8f4"));
				tvmaphong.setGravity(Gravity.LEFT);
				tvmaphong.setText(phong.getMaphong());
				tvmaphong.setLayoutParams(tableRowParams);
				TextView tvsoghe = new TextView(context);
				tvsoghe.setBackgroundColor(Color.parseColor("#bae8f4"));
				tvsoghe.setGravity(Gravity.LEFT);
				tvsoghe.setText(phong.getSoluong() + "");
				tvsoghe.setLayoutParams(tableRowParams);
				tableRow.addView(tvStt);
				tableRow.addView(tvmaphong);
				tableRow.addView(tvsoghe);
				tableRow.setOnClickListener(new OnClickListener() {
					@Override
					public void onClick(View v) {
						// TODO Auto-generated method stub
						depatureDate.setText(tvmaphong.getText().toString());
						lichbaobuJson.setIdphong(phong.getId());
						dialog.dismiss();
					}
				});
				danhsachphong.addView(tableRow);
				i++;
			}
			builder.setView(v).setPositiveButton("Đóng",
					new DialogInterface.OnClickListener() {

						public void onClick(DialogInterface dialog, int which) {
							// TODO Auto-generated method stub
							dialog.cancel();
						}

					});
			dialog = builder.create();
			return dialog;
		default:
			break;
		}
		return null;
	}
	//
}
