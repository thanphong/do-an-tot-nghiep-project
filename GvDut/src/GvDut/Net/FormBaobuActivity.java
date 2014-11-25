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
import android.view.ViewGroup;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.Toast;

import android.widget.TextView;
import android.widget.AdapterView.OnItemClickListener;

public class FormBaobuActivity extends AbtractActivity {

	List<LichnghiJson> lichnghiJsons;
	List<LichbaobuJson>lisLichbaobuJsons=new ArrayList<LichbaobuJson>();
	LinearLayout tbdanhsachbaobu;
	Context context=this;
	Button btbaou;
	DialogActivity dialog;
	@Override
	public void init() {
		// TODO Auto-generated method stub
		tbdanhsachbaobu = (LinearLayout) findViewById(R.id.danhsachBaobu);
		btbaou=(Button)findViewById(R.id.btdkBu);
		btbaou.setPadding(2, 2, 2, 2);
		btbaou.setTextColor(Color.WHITE);
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
			btbaou.setOnClickListener(new OnClickListener() {
				
				@Override
				public void onClick(View v) {
					// TODO Auto-generated method stub
					if(lisLichbaobuJsons.size()>0){
						try {
							final List<LichbaobuJson>lichbaobuJsons  = new AsyncTask<String, Void, List<LichbaobuJson>>() {
								@Override
								protected List<LichbaobuJson> doInBackground(String... params) {
									// TODO Auto-generated method stub
									return (List<LichbaobuJson>) GetDataJson.baoBu(mgv,lisLichbaobuJsons);
								}
							}.execute("").get();
							if(lichbaobuJsons!=null){
								Toast.makeText(FormBaobuActivity.this, "Báo dạy bù thành công!",
										Toast.LENGTH_SHORT).show();
								Intent t=new Intent(FormBaobuActivity.this,BaobuActivity.class);
								startActivity(t);
							}
							else{
								Toast.makeText(FormBaobuActivity.this, "Báo dạy bù thất bại!",
										Toast.LENGTH_SHORT).show();
							}
						} catch (Exception e) {
							e.printStackTrace();
							// TODO: handle exception
						}
					}
				}
			});
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
		
		LinearLayout.LayoutParams tableRowParams = new LinearLayout.LayoutParams(new ViewGroup.MarginLayoutParams(
				LinearLayout.LayoutParams.MATCH_PARENT,
				LinearLayout.LayoutParams.WRAP_CONTENT));
		tableRowParams.setMargins(1, 1, 1, 1);
		LinearLayout.LayoutParams lpmyLayout = new LinearLayout.LayoutParams(
				new ViewGroup.MarginLayoutParams(
						LinearLayout.LayoutParams.FILL_PARENT,
						LinearLayout.LayoutParams.WRAP_CONTENT));
		lpmyLayout.setMargins(5, 5, 5, 5);
		lpmyLayout.weight=1;
		lpmyLayout.gravity=Gravity.CENTER_VERTICAL;
		
		int i = 0;
		for (LichnghiJson lichnghiJson : lichnghiJsons) {
			LinearLayout layoutbaobu=new LinearLayout(context);
			layoutbaobu.setBackgroundDrawable(getResources().getDrawable(R.drawable.my_custom_background));
			layoutbaobu.setLayoutParams(tableRowParams);
			layoutbaobu.setOrientation(LinearLayout.VERTICAL);
			
			LinearLayout layoutstt=new LinearLayout(context);
			layoutstt.setLayoutParams(tableRowParams);
			
			layoutstt.setOrientation(LinearLayout.HORIZONTAL);
			layoutstt.setBackgroundColor(getResources().getColor(R.color.tieude));
			
			LichbaobuJson lichbaobuJson=new LichbaobuJson();
			lichbaobuJson.setLichnghi(lichnghiJson.getId());
			lisLichbaobuJsons.add(lichbaobuJson);
			i ++;
			TextView labelstt=new TextView(context);
			labelstt.setGravity(Gravity.CENTER_VERTICAL);
			labelstt.setText(getString(R.string.headerStt));
			labelstt.setTextColor(Color.WHITE);
			labelstt.setLayoutParams(lpmyLayout);
			final TextView tvstt = new TextView(context);
			tvstt.setGravity(Gravity.CENTER_VERTICAL);
			tvstt.setLayoutParams(lpmyLayout);
			tvstt.setTextSize(TypedValue.COMPLEX_UNIT_SP, 13);
			tvstt.setTextColor(Color.WHITE);
			tvstt.setText(i + "");
			layoutstt.addView(labelstt);
			layoutstt.addView(tvstt);
			
			LinearLayout layoutLhp=new LinearLayout(context);
			layoutLhp.setLayoutParams(tableRowParams);
			layoutLhp.setOrientation(LinearLayout.HORIZONTAL);
			layoutLhp.setBackgroundDrawable(getResources().getDrawable(R.drawable.background_text));
			
			TextView labellhp=new TextView(context);
			labellhp.setGravity(Gravity.CENTER_VERTICAL);
			labellhp.setText(getString(R.string.headerLhp));
			labellhp.setLayoutParams(lpmyLayout);
			
			TextView tvLhp = new TextView(context);
			tvLhp.setBackgroundColor(Color.WHITE);
			tvLhp.setGravity(Gravity.CENTER);
			tvLhp.setLayoutParams(lpmyLayout);
			tvLhp.setTextSize(TypedValue.COMPLEX_UNIT_SP, 13);
			tvLhp.setText(lichnghiJson.getTenLhp());
			layoutLhp.addView(labellhp);
			layoutLhp.addView(tvLhp);
			
			LinearLayout layoutngaybu=new LinearLayout(context);
			layoutngaybu.setLayoutParams(tableRowParams);
			layoutngaybu.setOrientation(LinearLayout.HORIZONTAL);
			layoutngaybu.setBackgroundDrawable(getResources().getDrawable(R.drawable.background_text));
			
			TextView labelngaybu=new TextView(context);
			labelngaybu.setGravity(Gravity.CENTER_VERTICAL);
			labelngaybu.setText(getString(R.string.headerngaybu));
			labelngaybu.setLayoutParams(lpmyLayout);
			
			final EditText ngaybu = new EditText(context);
			ngaybu.setGravity(Gravity.CENTER);
			ngaybu.setTextSize(TypedValue.COMPLEX_UNIT_SP, 12);
			ngaybu.setLayoutParams(lpmyLayout);
			final int j = i - 1;
			ngaybu.setOnClickListener(new OnClickListener() {
				
				@Override
				public void onClick(View v) {
					// TODO Auto-generated method stub
					dialog = new DialogActivity();
					dialog.depatureDate = ngaybu;
					dialog.context = context;
					dialog.type = 1;
					dialog.lichbaobuJson = lisLichbaobuJsons.get(j);
					FragmentManager fragmentManager = getFragmentManager();
					dialog.show(fragmentManager, "Ngày tháng");
				}
			});
			layoutngaybu.addView(labelngaybu);
			layoutngaybu.addView(ngaybu);
			
			LinearLayout layoutTutiet=new LinearLayout(context);
			layoutTutiet.setLayoutParams(tableRowParams);
			layoutTutiet.setOrientation(LinearLayout.HORIZONTAL);
			layoutTutiet.setBackgroundDrawable(getResources().getDrawable(R.drawable.background_text));
			
			TextView labeltutiet=new TextView(context);
			labeltutiet.setGravity(Gravity.CENTER_VERTICAL);
			labeltutiet.setText(getString(R.string.headertietdau));
			labeltutiet.setLayoutParams(lpmyLayout);
			
			final EditText tietdau= new EditText(context);
			tietdau.setGravity(Gravity.CENTER);
			tietdau.setTextSize(TypedValue.COMPLEX_UNIT_SP, 13);
			tietdau.setInputType(InputType.TYPE_CLASS_NUMBER);
			tietdau.setLayoutParams(lpmyLayout);
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
					if(!tietdau.getText().toString().equals(""))
						lisLichbaobuJsons.get(j).setTietdau(Integer.parseInt(tietdau.getText().toString()));
				}
			});
			layoutTutiet.addView(labeltutiet);
			layoutTutiet.addView(tietdau);
			
			LinearLayout layoutdentiet=new LinearLayout(context);
			layoutdentiet.setLayoutParams(tableRowParams);
			layoutdentiet.setOrientation(LinearLayout.HORIZONTAL);
			layoutdentiet.setBackgroundDrawable(getResources().getDrawable(R.drawable.background_text));
			
			TextView labeldentiet=new TextView(context);
			labeldentiet.setGravity(Gravity.CENTER_VERTICAL);
			labeldentiet.setText(getString(R.string.headertietcuoi));
			labeldentiet.setLayoutParams(lpmyLayout);
			
			final EditText tietcuoi= new EditText(context);
			tietcuoi.setGravity(Gravity.CENTER);
			tietcuoi.setTextSize(TypedValue.COMPLEX_UNIT_SP, 13);
			tietcuoi.setInputType(InputType.TYPE_CLASS_NUMBER);
			tietcuoi.setLayoutParams(lpmyLayout);
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
					if(!tietcuoi.getText().toString().equals(""))
						lisLichbaobuJsons.get(j).setTietcuoi(Integer.parseInt(tietcuoi.getText().toString()));
				}
			});
			layoutdentiet.addView(labeldentiet);
			layoutdentiet.addView(tietcuoi);
			
			LinearLayout layoutphong=new LinearLayout(context);
			layoutphong.setLayoutParams(tableRowParams);
			layoutphong.setOrientation(LinearLayout.HORIZONTAL);
			layoutphong.setBackgroundDrawable(getResources().getDrawable(R.drawable.background_text));
			
			TextView labelphong=new TextView(context);
			labelphong.setGravity(Gravity.CENTER_VERTICAL);
			labelphong.setText(getString(R.string.headermaphong));
			labelphong.setLayoutParams(lpmyLayout);
			
			final EditText phong = new EditText(context);
			phong.setGravity(Gravity.CENTER);
			phong.setLayoutParams(lpmyLayout);
			phong.setTextSize(TypedValue.COMPLEX_UNIT_SP, 13);
			phong.setOnKeyListener(null);
			
			phong.setOnClickListener(new OnClickListener() {
				
				@Override
				public void onClick(View v) {
					// TODO Auto-generated method stub
					dialog = new DialogActivity();
					dialog.depatureDate =phong ;
					dialog.context = context;
					dialog.type =2;
					dialog.phongJsons=getphong(lisLichbaobuJsons.get(j));
					dialog.lichbaobuJson = lisLichbaobuJsons.get(j);
					FragmentManager fragmentManager = getFragmentManager();
					dialog.show(fragmentManager, "Danh sách phòng");
				}
			});
			layoutphong.addView(labelphong);
			layoutphong.addView(phong);
			
			layoutbaobu.addView(layoutstt);
			layoutbaobu.addView(layoutLhp);
			layoutbaobu.addView(layoutngaybu);
			layoutbaobu.addView(layoutTutiet);
			layoutbaobu.addView(layoutdentiet);
			layoutbaobu.addView(layoutphong);
			tbdanhsachbaobu.addView(layoutbaobu);
			
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
