package GvDut.Net;

import java.util.Calendar;
import java.util.List;
import GvDut.services.TkbieuJson;
import android.app.AlertDialog;
import android.app.DatePickerDialog;
import android.app.Dialog;
import android.app.DialogFragment;
import android.content.Context;
import android.content.DialogInterface;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.TextView;

public class DialogActivity extends DialogFragment {

	public List<TkbieuJson> tkbieuJsons;
	Context context;
	int type;
	public EditText depatureDate;
	public TkbieuJson tkbieuJson;
	private DatePickerDialog.OnDateSetListener datePickerListener = new DatePickerDialog.OnDateSetListener() {
		// when dialog box is closed, below method will be called.
		public void onDateSet(DatePicker view, int selectedYear,
				int selectedMonth, int selectedDay) {
			int year = selectedYear;
			int month = selectedMonth;
			int day = selectedDay;
			depatureDate.setText(new StringBuilder().append(year).append("-")
					.append(month + 1).append("-").append(day).append(" "));
			tkbieuJson.setNgaynghi(depatureDate.getText().toString());
		}
	};

	@Override
	public Dialog onCreateDialog(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		switch (type) {
		case 0:
			AlertDialog.Builder builder = new AlertDialog.Builder(getActivity());
			// Get the layout inflater
			LayoutInflater inflater = getActivity().getLayoutInflater();
			View v = inflater.inflate(R.layout.comfirm_layout, null);
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
			final Dialog dialog = builder.create();
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
		default:
			break;
		}
		return null;
	}

}
