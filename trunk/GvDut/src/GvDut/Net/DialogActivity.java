package GvDut.Net;

import java.util.Calendar;
import java.util.List;


import GvDut.services.LichbaobuJson;
import GvDut.services.PhongJson;
import GvDut.services.TkbieuJson;
import android.app.AlertDialog;
import android.app.DatePickerDialog;
import android.app.Dialog;
import android.app.DialogFragment;
import android.content.Context;
import android.content.DialogInterface;
import android.graphics.Color;
import android.os.Bundle;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.TableLayout;
import android.widget.TableRow;
import android.widget.TextView;
import android.view.View.OnClickListener;

public class DialogActivity extends DialogFragment {

	public List<TkbieuJson> tkbieuJsons;
	Context context;
	int type;
	public EditText depatureDate;
	public TkbieuJson tkbieuJson;
	public LichbaobuJson lichbaobuJson;
	public List<PhongJson>phongJsons;
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
			if(tkbieuJson!=null)
				tkbieuJson.setNgaynghi(depatureDate.getText().toString());
			if(lichbaobuJson!=null){
				lichbaobuJson.setNgayday(depatureDate.getText().toString());
			}
		}
	};

	@Override
	public Dialog onCreateDialog(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		final AlertDialog.Builder builder = new AlertDialog.Builder(getActivity());
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
		case 2:
			v = inflater.inflate(R.layout.danhsachphong_layout, null);
			TableLayout danhsachphong=(TableLayout)v.findViewById(R.id.danhsachphong);
			int i = 1;
			
			TableRow.LayoutParams tableRowParams = new TableRow.LayoutParams();
			tableRowParams.setMargins(1, 1, 1, 1);
			tableRowParams.weight = 1;
			for (final PhongJson phong : phongJsons) {
				TableRow tableRow = new TableRow(context);
				TextView tvStt = new TextView(context);
				tvStt.setBackgroundColor(Color.parseColor("#bae8f4"));
				tvStt.setGravity(Gravity.LEFT);
				tvStt.setText(i+"");
				final TextView tvmaphong = new TextView(context);
				tvmaphong.setBackgroundColor(Color.parseColor("#bae8f4"));
				tvmaphong.setGravity(Gravity.LEFT);
				tvmaphong.setText(phong.getMaphong());
				tvmaphong.setLayoutParams(tableRowParams);
				TextView tvsoghe = new TextView(context);
				tvsoghe.setBackgroundColor(Color.parseColor("#bae8f4"));
				tvsoghe.setGravity(Gravity.LEFT);
				tvsoghe.setText(phong.getSoluong()+"");
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
			builder.setView(v)
					.setPositiveButton("Đóng",
							new DialogInterface.OnClickListener() {

								public void onClick(DialogInterface dialog,
										int which) {
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
