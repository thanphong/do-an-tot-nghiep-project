package GvDut.Net;

import java.util.ArrayList;
import java.util.List;

import GvDut.services.AccountJson;
import GvDut.services.GetDataJson;
import GvDut.services.NewsJson;
import GvDut.services.TkbieuJson;
import android.app.Fragment;
import android.app.FragmentManager;
import android.app.FragmentTransaction;
import android.content.Context;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.AsyncTask;
import android.os.Bundle;
import android.text.Editable;
import android.text.Html;
import android.text.InputType;
import android.text.TextWatcher;
import android.util.Log;
import android.util.TypedValue;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.TableLayout;
import android.widget.TableRow;
import android.widget.TextView;
import android.view.View.OnClickListener;

public class RiverFragment extends Fragment {

	public Context context;
	public Button btlogin;
	public EditText edUsername;
	public EditText edPass;
	public int mgv;

	public List<TkbieuJson> tkbieuJsons;
	public DialogFragment dialogframge;
	public OnClickListener lgonClickListener = new OnClickListener() {

		@Override
		public void onClick(View v) {
			// TODO Auto-generated method stub
			try {
				final AccountJson account = new AsyncTask<String, Void, AccountJson>() {
					@Override
					protected AccountJson doInBackground(String... params) {
						// TODO Auto-generated method stub
						return GetDataJson.checkLogin(edUsername.getText()
								.toString(), edPass.getText().toString());
					}
				}.execute("").get();
				if (account != null) {
					mgv = account.getAccountId();
					// Log.d("username", account.getAccountName());
				}
			} catch (Exception e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
		}
	};

	@Override
	public View onCreateView(final LayoutInflater inflater,
			final ViewGroup container, Bundle savedInstanceState) {

		// Retrieving the currently selected item number
		int position = getArguments().getInt("position");
		mgv = getArguments().getInt("magv");
		// List of rivers
		String[] rivers = getResources().getStringArray(R.array.Menu);
		View v;
		switch (position) {
		case 0:
			// Creating view correspoding to the fragment
			v = inflater.inflate(R.layout.home_layout, container, false);
			LinearLayout LinerlistNews = (LinearLayout) v
					.findViewById(R.id.linearNews);
			getListNews(inflater, LinerlistNews);
			break;
		case 1:
			// Creating view correspoding to the fragment
			v = inflater.inflate(R.layout.login_layout, container, false);
			btlogin = (Button) v.findViewById(R.id.btlogin);
			edUsername = (EditText) v.findViewById(R.id.username);
			edPass = (EditText) v.findViewById(R.id.pass);
			btlogin.setOnClickListener(lgonClickListener);
			break;
		case 2:

			v = inflater
					.inflate(R.layout.thoikhoabieu_layout, container, false);
			TableLayout tkbieu = (TableLayout) v.findViewById(R.id.TKbieu);
			getTkBieu(inflater, mgv, tkbieu);
			break;
		case 4:

			v = inflater.inflate(R.layout.baongi_layout, container, false);
			TableLayout tkbieubaonghi = (TableLayout) v
					.findViewById(R.id.TKbieuBaonghi);
			Button btbaongi = (Button) v.findViewById(R.id.btbaonghi);
			getTkBieuBaonghi(inflater, mgv, tkbieubaonghi);
			btbaongi.setOnClickListener(new OnClickListener() {

				@Override
				public void onClick(View v) {
					// TODO Auto-generated method stub
					RiverFragment rFragment = new RiverFragment();
					rFragment.tkbieuJsons = tkbieuJsons;
					rFragment.context = context;
					Bundle data = new Bundle();
					data.putInt("position", 10);
					data.putInt("magv", mgv);

					// Setting the position to the fragment
					rFragment.setArguments(data);
					FragmentManager fragmentManager = getFragmentManager();

					// Creating a fragment transaction
					FragmentTransaction ft = fragmentManager.beginTransaction();

					// Adding a fragment to the fragment transaction
					ft.replace(R.id.content_frame, rFragment);

					// Committing the transaction
					ft.commit();
					//
				}
			});
			break;
		case 10:
			v = inflater.inflate(R.layout.fom_baonghibu_layout, container,
					false);
			position = 4;
			TableLayout tbbaonghi = (TableLayout) v
					.findViewById(R.id.tableBaonghi);
			formbaongi(tbbaonghi);
			//
			final EditText lydo=(EditText)v.findViewById(R.id.lydo);
			Button btdkbu = (Button) v.findViewById(R.id.btdangkybu);
			btdkbu.setOnClickListener(new OnClickListener() {

				@Override
				public void onClick(View v) {
					tkbieuJsons.get(0).setLydo(lydo.getText().toString());
					// TODO Auto-generated method stub
					dialogframge = new DialogFragment();
					dialogframge.type = 1;
					dialogframge.context = context;
					FragmentManager fragmentManager = getFragmentManager();
					dialogframge.show(fragmentManager, "Ngày tháng");
					//baongi();
				}
			});
			//
			break;
		default:
			v = inflater.inflate(R.layout.fragment_layout, container, false);
			// Getting reference to the TextView of the Fragment
			TextView tv = (TextView) v.findViewById(R.id.tv_content);
			// Setting currently selected river name in the TextView
			tv.setText(rivers[position]);
			// Updating the action bar title
			break;
		}
		getActivity().getActionBar().setTitle(rivers[position]);
		return v;
	}

	//

	private void getTkBieuBaonghi(LayoutInflater inflater, int mgv2,
			TableLayout tkbieubaonghi) {
		// TODO Auto-generated method stub
		try {
			final List<TkbieuJson> tkbieu = new AsyncTask<String, Void, List<TkbieuJson>>() {
				@Override
				protected List<TkbieuJson> doInBackground(String... params) {
					// TODO Auto-generated method stub
					return (List<TkbieuJson>) GetDataJson.getThoikhoabieu(mgv);
				}
			}.execute("").get();
			tkbieuJsons = new ArrayList<TkbieuJson>();
			if (tkbieu != null) {
				int i = 0;
				TableRow.LayoutParams tableRowParams = new TableRow.LayoutParams();
				tableRowParams.setMargins(1, 1, 1, 1);
				tableRowParams.weight = 1;

				for (final TkbieuJson tkbieuJson : tkbieu) {
					i++;
					TableRow tableRow = new TableRow(context);
					tableRow.setBackgroundColor(Color.parseColor("#d0dee9"));

					final TextView tvstt = new TextView(context);
					tvstt.setBackgroundColor(Color.WHITE);
					tvstt.setGravity(Gravity.CENTER);
					tvstt.setLayoutParams(tableRowParams);
					tvstt.setText(i + "");

					TextView tvLhp = new TextView(context);
					tvLhp.setBackgroundColor(Color.WHITE);
					tvLhp.setGravity(Gravity.CENTER);
					tvLhp.setLayoutParams(tableRowParams);
					tvLhp.setText(tkbieuJson.getLophp());

					TextView tvtkb = new TextView(context);
					tvtkb.setBackgroundColor(Color.WHITE);
					tvtkb.setGravity(Gravity.CENTER);
					tvtkb.setLayoutParams(tableRowParams);
					tvtkb.setText("T" + tkbieuJson.getThu() + ","
							+ tkbieuJson.getTutiet() + "-"
							+ tkbieuJson.getDentiet() + ","
							+ tkbieuJson.getMaphong());

					TextView cobaongi = new TextView(context);
					cobaongi.setBackgroundColor(Color.WHITE);
					cobaongi.setGravity(Gravity.CENTER);
					cobaongi.setLayoutParams(tableRowParams);
					if (tkbieuJson.getBaongi() > 0)
						cobaongi.setBackgroundResource(R.drawable.check);

					tableRow.addView(tvstt, tableRowParams);
					tableRow.addView(tvLhp, tableRowParams);
					tableRow.addView(tvtkb, tableRowParams);
					tableRow.addView(cobaongi, tableRowParams);

					tableRow.setOnClickListener(new OnClickListener() {

						@Override
						public void onClick(View v) {
							// TODO Auto-generated method stub

							ColorDrawable txtcolor = (ColorDrawable) tvstt
									.getBackground();
							if (txtcolor.getColor() == Color.WHITE) {
								tkbieuJsons.add(tkbieuJson);
								tvstt.setBackgroundColor(Color.BLUE);
							} else {
								tkbieuJsons.remove(tkbieuJson);
								tvstt.setBackgroundColor(Color.WHITE);
							}
							
						}
					});
					tkbieubaonghi.addView(tableRow);
				}
			}
		} catch (Exception e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}

	//
	public void getListNews(LayoutInflater inflater, LinearLayout LinerlistNews) {
		try {
			final List<NewsJson> listNews = new AsyncTask<String, Void, List<NewsJson>>() {
				@Override
				protected List<NewsJson> doInBackground(String... params) {
					// TODO Auto-generated method stub
					return (List<NewsJson>) GetDataJson.getListNews();
				}
			}.execute("").get();
			if (listNews != null) {
				String tt = "";
				for (NewsJson newsJson : listNews) {
					TextView tieude = (TextView) inflater.inflate(
							R.layout.textview_styles, null);
					tt = "<b><span ><font color='red'>" + newsJson.getNgay()
							+ ":</font></span></b>&nbsp;&nbsp;&nbsp;&nbsp;";
					tt += "<span ><font color='#009900'>"
							+ newsJson.getTieude() + "</font></span>";
					tt += "<div>" + newsJson.getNoidung() + "</div>";
					tieude.setText(Html.fromHtml(tt));
					LinerlistNews.addView(tieude);
				}
			}
		} catch (Exception e) {
			Log.d("err", e.toString());
			e.fillInStackTrace();
		}
	}

	//
	public void getTkBieu(LayoutInflater inflater, final int mgv,
			TableLayout tkb) {
		try {
			final List<TkbieuJson> tkbieu = new AsyncTask<String, Void, List<TkbieuJson>>() {
				@Override
				protected List<TkbieuJson> doInBackground(String... params) {
					// TODO Auto-generated method stub
					return (List<TkbieuJson>) GetDataJson.getThoikhoabieu(mgv);
				}
			}.execute("").get();
			if (tkbieu != null) {
				int i = 0;
				TableRow.LayoutParams tableRowParams = new TableRow.LayoutParams();
				tableRowParams.setMargins(1, 1, 1, 1);
				tableRowParams.weight = 1;

				for (TkbieuJson tkbieuJson : tkbieu) {
					i++;
					TableRow tableRow = new TableRow(context);
					tableRow.setBackgroundColor(Color.parseColor("#d0dee9"));

					TextView tvstt = new TextView(context);
					tvstt.setBackgroundColor(Color.WHITE);
					tvstt.setGravity(Gravity.CENTER);
					tvstt.setLayoutParams(tableRowParams);
					tvstt.setText(i + "");

					TextView tvLhp = new TextView(context);
					tvLhp.setBackgroundColor(Color.WHITE);
					tvLhp.setGravity(Gravity.CENTER);
					tvLhp.setLayoutParams(tableRowParams);
					tvLhp.setText(tkbieuJson.getLophp());

					TextView tvtkb = new TextView(context);
					tvtkb.setBackgroundColor(Color.WHITE);
					tvtkb.setGravity(Gravity.CENTER);
					tvtkb.setLayoutParams(tableRowParams);
					tvtkb.setText("T" + tkbieuJson.getThu() + ","
							+ tkbieuJson.getTutiet() + "-"
							+ tkbieuJson.getDentiet() + ","
							+ tkbieuJson.getMaphong());
					tableRow.addView(tvstt, tableRowParams);
					tableRow.addView(tvLhp, tableRowParams);
					tableRow.addView(tvtkb, tableRowParams);
					tkb.addView(tableRow);
				}
			}
		} catch (Exception e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}

	//
	public void formbaongi(TableLayout tbbaonghi) {

		TableRow.LayoutParams tableRowParams = new TableRow.LayoutParams();
		tableRowParams.setMargins(1, 1, 1, 1);
		tableRowParams.weight = 1;

		int i = 0;
		for (TkbieuJson tkbieuJson : tkbieuJsons) {
			i = i + 1;
			TableRow tableRow = new TableRow(context);
			tableRow.setBackgroundColor(Color.parseColor("#d0dee9"));

			final TextView tvstt = new TextView(context);
			tvstt.setBackgroundColor(Color.WHITE);
			tvstt.setGravity(Gravity.CENTER);
			tvstt.setLayoutParams(tableRowParams);
			tvstt.setTextSize(TypedValue.COMPLEX_UNIT_SP, 13);
			tvstt.setText(i + "");

			TextView tvLhp = new TextView(context);
			tvLhp.setBackgroundColor(Color.WHITE);
			tvLhp.setGravity(Gravity.CENTER);
			tvLhp.setLayoutParams(tableRowParams);
			tvLhp.setTextSize(TypedValue.COMPLEX_UNIT_SP, 13);
			tvLhp.setText(tkbieuJson.getLophp());

			final EditText ngaynghi = new EditText(context);
			ngaynghi.setGravity(Gravity.CENTER);
			ngaynghi.setTextSize(TypedValue.COMPLEX_UNIT_SP, 12);
			ngaynghi.setLayoutParams(tableRowParams);
			final int j = i - 1;
			ngaynghi.setOnClickListener(new OnClickListener() {
				@Override
				public void onClick(View v) {
					// TODO Auto-generated method stub
					dialogframge = new DialogFragment();
					dialogframge.type = 2;
					dialogframge.context = context;
					dialogframge.depatureDate = ngaynghi;
					dialogframge.tkbieuJson = tkbieuJsons.get(j);
					FragmentManager fragmentManager = getFragmentManager();
					dialogframge.show(fragmentManager, "Ngày tháng");
				}
			});
			final EditText sotiet = new EditText(context);
			sotiet.setGravity(Gravity.CENTER);
			sotiet.setTextSize(TypedValue.COMPLEX_UNIT_SP, 13);
			sotiet.setInputType(InputType.TYPE_CLASS_NUMBER);
			sotiet.setLayoutParams(tableRowParams);
			sotiet.addTextChangedListener(new TextWatcher() {

				@Override
				public void onTextChanged(CharSequence s, int start,
						int before, int count) {
					// TODO Auto-generated method stub

				}

				@Override
				public void beforeTextChanged(CharSequence s, int start,
						int count, int after) {
					// TODO Auto-generated method stub

				}

				@Override
				public void afterTextChanged(Editable s) {
					// TODO Auto-generated method stub
					tkbieuJsons.get(j).setSotietnghi(
							Integer.parseInt(sotiet.getText().toString()));
				}
			});
			tableRow.addView(tvstt, tableRowParams);
			tableRow.addView(tvLhp, tableRowParams);
			tableRow.addView(ngaynghi, tableRowParams);
			tableRow.addView(sotiet, tableRowParams);
			tbbaonghi.addView(tableRow);
		}
	}
	//
	public void baongi(){
		try {
			final List<TkbieuJson> tkbieu = new AsyncTask<String, Void, List<TkbieuJson>>() {
				@Override
				protected List<TkbieuJson> doInBackground(String... params) {
					// TODO Auto-generated method stub
					return (List<TkbieuJson>) GetDataJson.baongi(mgv,tkbieuJsons);
				}
			}.execute("").get();
		} catch (Exception e) {
			// TODO: handle exception
		}
	}
}