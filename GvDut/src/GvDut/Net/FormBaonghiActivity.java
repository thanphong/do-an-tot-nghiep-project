package GvDut.Net;

import java.util.ArrayList;
import java.util.List;


import GvDut.services.GetDataJson;
import GvDut.services.TkbieuJson;
import android.app.AlertDialog;
import android.app.Dialog;
import android.app.FragmentManager;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Color;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.ActionBarDrawerToggle;
import android.support.v4.widget.DrawerLayout;
import android.text.Editable;
import android.text.InputType;
import android.text.TextWatcher;
import android.util.TypedValue;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.TableLayout;
import android.widget.TableRow;
import android.widget.TextView;
import android.widget.AdapterView.OnItemClickListener;

public class FormBaonghiActivity extends AbtractActivity {

	Context context = this;
	TableLayout tableBaonghi;
	DialogActivity dialog;
	Button btbaonghi;
	EditText lydo;

	@Override
	public void init() {
		// TODO Auto-generated method stub
		tableBaonghi = (TableLayout) findViewById(R.id.tableBaonghi);
		btbaonghi = (Button) findViewById(R.id.btdangkybu);
		lydo = (EditText) findViewById(R.id.lydo);
	}

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		String json = this.getIntent().getStringExtra("listTkb");
		tkbieuJsons = (ArrayList<TkbieuJson>) TkbieuJson
				.fromJsonArrayToObject(json);
		formbaongi();
	}

	@Override
	public int getLayoutContent() {
		// TODO Auto-generated method stub
		return R.layout.fom_baonghibu_layout;
	}
	
	@Override
	protected Dialog onCreateDialog(int id) {
		// TODO Auto-generated method stub
		AlertDialog.Builder builder = new AlertDialog.Builder(this);
		final Dialog dialog;
		switch (id) {
		case success:
			
			builder.setTitle("Thông báo!");
			builder.setMessage("Báo nghỉ thành công!").setNegativeButton("Ok",
							new DialogInterface.OnClickListener() {

								public void onClick(DialogInterface dialog,
										int which) {
									// TODO Auto-generated method stub
									Intent t=new Intent(FormBaonghiActivity.this,BaonghiActivity.class);
									startActivity(t);
								}

							});
			 dialog = builder.create();
			return dialog;
		case error:
			builder.setTitle("Thông báo!");
			builder.setMessage("Báo nghỉ thất bại!").setNegativeButton("Ok",
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
		//return super.onCreateDialog(id);
	}

	@Override
	public void addButtonListener() {
		// TODO Auto-generated method stub
		btbaonghi.setOnClickListener(new OnClickListener() {

			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				String ld = lydo.getText().toString().trim();
				if (ld.equals("")) {
					AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(
							context);
					// set title
					alertDialogBuilder.setTitle("Thông báo");

					// set dialog message
					alertDialogBuilder
							.setMessage("Nhập lý do báo ngỉ!")
							.setCancelable(false)
							.setPositiveButton("Yes",
									new DialogInterface.OnClickListener() {
										public void onClick(
												DialogInterface dialog, int id) {
											// if this button is clicked, close
											// current activity
											dialog.cancel();
										}
									});
					// create alert dialog
					AlertDialog alertDialog = alertDialogBuilder.create();
					// show it
					alertDialog.show();
				} else {
					tkbieuJsons.get(0).setLydo(lydo.getText().toString());
					baongi();
				}
			}
		});
	}

	@Override
	public void setDrawerLayout() {
		// TODO Auto-generated method stub

		mTitle = (String) getTitle();

		// Getting reference to the DrawerLayout
		mDrawerLayout = (DrawerLayout) findViewById(R.id.drawer_layout);
		mDrawerList = (ListView) findViewById(R.id.drawer_list);
		// Getting reference to the ActionBarDrawerToggle
		mDrawerToggle = new ActionBarDrawerToggle(this, mDrawerLayout,
				R.drawable.ic_drawer, R.string.drawer_open,
				R.string.drawer_close) {

			/** Called when drawer is closed */
			public void onDrawerClosed(View view) {
				getActionBar().setTitle(mTitle);
				invalidateOptionsMenu();

			}

			/** Called when a drawer is opened */
			public void onDrawerOpened(View drawerView) {
				getActionBar().setTitle("Chọn chức năng");
				invalidateOptionsMenu();
			}

		};

		// Setting DrawerToggle on DrawerLayout
		mDrawerLayout.setDrawerListener(mDrawerToggle);

		// Creating an ArrayAdapter to add items to the listview mDrawerList
		String[] menu=getResources().getStringArray(R.array.Menu);
		if(mgv!=0){
			menu[menu.length-1]="Thoát";
		}
		// Creating an ArrayAdapter to add items to the listview mDrawerList
		ArrayAdapter<String> adapter = new ArrayAdapter<String>(
				getBaseContext(), R.layout.drawer_list_item,menu);
//		ArrayAdapter<String> adapter = new ArrayAdapter<String>(
//				getBaseContext(), R.layout.drawer_list_item, getResources()
//						.getStringArray(R.array.Menu));

		// Setting the adapter on mDrawerList
		mDrawerList.setAdapter(adapter);

		// Enabling Home button
		getActionBar().setHomeButtonEnabled(true);

		// Enabling Up navigation
		getActionBar().setDisplayHomeAsUpEnabled(true);

		// Setting item click listener for the listview mDrawerList
		mDrawerList.setOnItemClickListener(new OnItemClickListener() {

			@Override
			public void onItemClick(AdapterView<?> parent, View view,
					int position, long id) {

				// Getting an array of rivers
				String[] rivers = getResources().getStringArray(R.array.Menu);

				// Currently selected river

				mTitle = rivers[position];
				Intent t;
				if (mgv == 0 && position != stateHome) {
					t = new Intent(FormBaonghiActivity.this, LoginActivity.class);
					startActivity(t);
				} else {
					switch (position) {
					case stateHome:
						t = new Intent(FormBaonghiActivity.this,
								MainActivity.class);
						startActivity(t);
						break;
					case stateBaonghi:
						t = new Intent(FormBaonghiActivity.this,
								BaonghiActivity.class);
						startActivity(t);
						break;
					case stateBaobu:
						t = new Intent(FormBaonghiActivity.this,
								BaobuActivity.class);
						startActivity(t);
						break;
					case stateDangnhap:
						mgv=0;
						t = new Intent(FormBaonghiActivity.this,
								MainActivity.class);
						startActivity(t);
						break;
					case stateThoiKhoabieu:
						t = new Intent(FormBaonghiActivity.this,
								ThoiKhoaBieuActivity.class);
						startActivity(t);
						break;
					default:
						break;
					}
					// Creating a fragment object
					getActionBar().setTitle(rivers[position]);
					mDrawerLayout.closeDrawer(mDrawerList);
				}
			}
		});
	}

	//
	public void formbaongi() {

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
					dialog = new DialogActivity();
					dialog.depatureDate = ngaynghi;
					dialog.context = context;
					dialog.type = 1;
					dialog.tkbieuJson = tkbieuJsons.get(j);
					FragmentManager fragmentManager = getFragmentManager();
					dialog.show(fragmentManager, "Ngày tháng");
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
			tableBaonghi.addView(tableRow);
		}
	}

	//
	public void baongi() {
		try {
			final List<TkbieuJson> tkbieu = new AsyncTask<String, Void, List<TkbieuJson>>() {
				@Override
				protected List<TkbieuJson> doInBackground(String... params) {
					// TODO Auto-generated method stub
					return (List<TkbieuJson>) GetDataJson.baongi(mgv,
							tkbieuJsons);
				}
			}.execute("").get();
			if(tkbieu!=null){
				showDialog(success);
			}
		} catch (Exception e) {
			e.printStackTrace();
			// TODO: handle exception
		}
	}
}
