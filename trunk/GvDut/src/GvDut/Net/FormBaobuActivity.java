package GvDut.Net;

import java.util.ArrayList;
import java.util.List;

import GvDut.services.GetDataJson;
import GvDut.services.LichbaobuJson;
import GvDut.services.LichnghiJson;
import GvDut.services.PhongJson;
import android.app.FragmentManager;
import android.content.Context;
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
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.TableRow;
import android.widget.TextView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.TableLayout;

public class FormBaobuActivity extends AbtractActivity {

	List<LichnghiJson> lichnghiJsons;
	List<LichbaobuJson>lisLichbaobuJsons=new ArrayList<LichbaobuJson>();
	TableLayout tbdanhsachbaobu;
	Context context=this;
	
	DialogActivity dialog;
	@Override
	public void init() {
		// TODO Auto-generated method stub
		tbdanhsachbaobu = (TableLayout) findViewById(R.id.danhsachBaobu);
	}

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		String json = this.getIntent().getStringExtra("lichnghiJson");
		lichnghiJsons = (ArrayList<LichnghiJson>) LichnghiJson
				.fromJsonArrayToObject(json);
		formBaobu();
	}

	@Override
	public int getLayoutContent() {
		// TODO Auto-generated method stub
		return R.layout.formbaobu_layout;
	}

	@Override
	public void addButtonListener() {
		// TODO Auto-generated method stub

	}

	@Override
	public void setDrawerLayout() {
		// TODO Auto-generated method stub
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
		String[] menu = getResources().getStringArray(R.array.Menu);
		if (mgv != 0) {
			menu[menu.length - 1] = "Thoát";
		}
		// Creating an ArrayAdapter to add items to the listview mDrawerList
		ArrayAdapter<String> adapter = new ArrayAdapter<String>(
				getBaseContext(), R.layout.drawer_list_item, menu);
		// ArrayAdapter<String> adapter = new ArrayAdapter<String>(
		// getBaseContext(), R.layout.drawer_list_item, getResources()
		// .getStringArray(R.array.Menu));

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
					t = new Intent(FormBaobuActivity.this, LoginActivity.class);
					startActivity(t);
				} else {
					switch (position) {
					case stateHome:
						t = new Intent(FormBaobuActivity.this,
								MainActivity.class);
						startActivity(t);
						break;
					case stateBaonghi:
						t = new Intent(FormBaobuActivity.this,
								BaonghiActivity.class);
						startActivity(t);
						break;
					case stateBaobu:
						t = new Intent(FormBaobuActivity.this,
								BaobuActivity.class);
						startActivity(t);
						break;
					case stateDangnhap:
						mgv = 0;
						t = new Intent(FormBaobuActivity.this,
								MainActivity.class);
						startActivity(t);
						break;
					case stateThoiKhoabieu:
						t = new Intent(FormBaobuActivity.this,
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
	public void formBaobu(){
		TableRow.LayoutParams tableRowParams = new TableRow.LayoutParams();
		tableRowParams.setMargins(1, 1, 1, 1);
		tableRowParams.weight = 1;

		int i = 0;
		for (LichnghiJson lichnghiJson : lichnghiJsons) {
			LichbaobuJson lichbaobuJson=new LichbaobuJson();
			lichbaobuJson.setLichnghi(lichnghiJson.getId());
			lisLichbaobuJsons.add(lichbaobuJson);
			i ++;
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
			tvLhp.setText(lichnghiJson.getTenLhp());
			
			final EditText ngaybu = new EditText(context);
			ngaybu.setGravity(Gravity.CENTER);
			ngaybu.setTextSize(TypedValue.COMPLEX_UNIT_SP, 12);
			ngaybu.setLayoutParams(tableRowParams);
			final int j = i - 1;
			ngaybu.setOnClickListener(new OnClickListener() {
				
				@Override
				public void onClick(View v) {
					// TODO Auto-generated method stub
					dialog = new DialogActivity();
					dialog.phongJsons=getphong(lisLichbaobuJsons.get(j));
					dialog.depatureDate = ngaybu;
					dialog.context = context;
					dialog.type = 1;
					dialog.lichbaobuJson = lisLichbaobuJsons.get(j);
					FragmentManager fragmentManager = getFragmentManager();
					dialog.show(fragmentManager, "Ngày tháng");
				}
			});
			
			final EditText tietdau= new EditText(context);
			tietdau.setGravity(Gravity.CENTER);
			tietdau.setTextSize(TypedValue.COMPLEX_UNIT_SP, 13);
			tietdau.setInputType(InputType.TYPE_CLASS_NUMBER);
			tietdau.setLayoutParams(tableRowParams);
			tietdau.addTextChangedListener(new TextWatcher() {
				
				@Override
				public void onTextChanged(CharSequence s, int start, int before, int count) {
					// TODO Auto-generated method stub
					
				}
				
				@Override
				public void beforeTextChanged(CharSequence s, int start, int count,
						int after) {
					// TODO Auto-generated method stub
					
				}
				
				@Override
				public void afterTextChanged(Editable s) {
					// TODO Auto-generated method stub
					lisLichbaobuJsons.get(j).setTietdau(Integer.parseInt(tietdau.getText().toString()));
				}
			});
			
			final EditText tietcuoi= new EditText(context);
			tietcuoi.setGravity(Gravity.CENTER);
			tietcuoi.setTextSize(TypedValue.COMPLEX_UNIT_SP, 13);
			tietcuoi.setInputType(InputType.TYPE_CLASS_NUMBER);
			tietcuoi.setLayoutParams(tableRowParams);
			tietcuoi.addTextChangedListener(new TextWatcher() {
				
				@Override
				public void onTextChanged(CharSequence s, int start, int before, int count) {
					// TODO Auto-generated method stub
					
				}
				
				@Override
				public void beforeTextChanged(CharSequence s, int start, int count,
						int after) {
					// TODO Auto-generated method stub
					
				}
				
				@Override
				public void afterTextChanged(Editable s) {
					// TODO Auto-generated method stub
					lisLichbaobuJsons.get(j).setTietcuoi(Integer.parseInt(tietcuoi.getText().toString()));
				}
			});
			
			TextView phong = new TextView(context);
			phong.setBackgroundColor(Color.WHITE);
			phong.setGravity(Gravity.CENTER);
			phong.setLayoutParams(tableRowParams);
			phong.setTextSize(TypedValue.COMPLEX_UNIT_SP, 13);
			phong.setOnClickListener(new OnClickListener() {
				
				@Override
				public void onClick(View v) {
					// TODO Auto-generated method stub
					dialog = new DialogActivity();
//					dialog.depatureDate = ngaybu;
					dialog.context = context;
					dialog.type =2;
					dialog.lichbaobuJson = lisLichbaobuJsons.get(j);
					FragmentManager fragmentManager = getFragmentManager();
					dialog.show(fragmentManager, "Danh sách phòng");
				}
			});
			
			tableRow.addView(tvstt, tableRowParams);
			tableRow.addView(tvLhp, tableRowParams);
			tableRow.addView(ngaybu, tableRowParams);
			tableRow.addView(tietdau, tableRowParams);
			tableRow.addView(tietcuoi, tableRowParams);
			tableRow.addView(phong, tableRowParams);
			tbdanhsachbaobu.addView(tableRow);
		}
	}
	//
	public List<PhongJson> getphong(final LichbaobuJson lichbaobuJson){
		try {
			final List<PhongJson>phongJsons  = new AsyncTask<String, Void, List<PhongJson>>() {
				@Override
				protected List<PhongJson> doInBackground(String... params) {
					// TODO Auto-generated method stub
					return (List<PhongJson>) GetDataJson.getPhongs(mgv,lichbaobuJson);
				}
			}.execute("").get();
			return phongJsons;
		} catch (Exception e) {
			e.printStackTrace();
			// TODO: handle exception
		}
		return null;
	}


}
