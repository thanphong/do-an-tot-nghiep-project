package GvDut.Net;

import java.util.List;

import GvDut.services.GetDataJson;
import GvDut.services.LichbaobuJson;
import GvDut.services.LichnghiJson;
import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.ActionBarDrawerToggle;
import android.support.v4.widget.DrawerLayout;

import android.view.Gravity;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TableRow;
import android.widget.TextView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.TableLayout;

public class BaobuActivity extends AbtractActivity {

	TableLayout tablebaobu;
	Context context=this;
	@Override
	public void init() {
		// TODO Auto-generated method stub
		tablebaobu=(TableLayout)findViewById(R.id.TKbieuBaobu);
		
	}

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		getLichnghi();
	}

	@Override
	public int getLayoutContent() {
		// TODO Auto-generated method stub
		return R.layout.baobu_layout;
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
		ArrayAdapter<String> adapter = new ArrayAdapter<String>(
				getBaseContext(), R.layout.drawer_list_item, getResources()
						.getStringArray(R.array.Menu));

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
				if (mgv == 0 && position!=stateHome) {
					t = new Intent(BaobuActivity.this, LoginActivity.class);
					startActivity(t);
				} else {
					switch (position) {
					case stateHome:
						t = new Intent(BaobuActivity.this, MainActivity.class);
						startActivity(t);
						break;
					case stateDangnhap:
						mgv=0;
						t = new Intent(BaobuActivity.this, MainActivity.class);
						startActivity(t);
						break;
					case stateThoiKhoabieu:
						
						break;
					case stateBaonghi:
						t = new Intent(BaobuActivity.this,
								BaonghiActivity.class);

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
	public void getLichnghi(){
		try {
			final List<LichnghiJson> lichnghis = new AsyncTask<String, Void, List<LichnghiJson>>() {
				@Override
				protected List<LichnghiJson> doInBackground(String... params) {
					// TODO Auto-generated method stub
					return (List<LichnghiJson>) GetDataJson.getLichnghi(mgv);
				}
			}.execute("").get();
			if(lichnghis!=null){
				int i = 0;
				TableRow.LayoutParams tableRowParams = new TableRow.LayoutParams();
				tableRowParams.setMargins(1, 1, 1, 1);
				tableRowParams.weight = 1;
				TableRow.LayoutParams tableRowParamsbaonghi = new TableRow.LayoutParams();
				tableRowParamsbaonghi.setMargins(0, 0, 0, 0);
				tableRowParamsbaonghi.weight = 1;
				tableRowParamsbaonghi.span=3;
				TableRow.LayoutParams layout=new TableRow.LayoutParams(TableRow.LayoutParams.FILL_PARENT, TableRow.LayoutParams.FILL_PARENT);
				for (LichnghiJson lichnghiJson : lichnghis) {
					List<LichbaobuJson> lichbaobus=(List<LichbaobuJson>) LichbaobuJson.fromJsonArrayToObject(lichnghiJson.getJsondaybu());
					i++;
					TableRow tableRow = new TableRow(context);
					tableRow.setBackgroundColor(Color.parseColor("#d0dee9"));
					
					TextView lopbaonghi = new TextView(context);
					lopbaonghi.setBackgroundColor(Color.parseColor("#bae8f4"));
					lopbaonghi.setGravity(Gravity.LEFT);
					lopbaonghi.setLayoutParams(tableRowParamsbaonghi);   
					lopbaonghi.setText("["+lichnghiJson.getMaLophp()+"]"+lichnghiJson.getLophp());
					TextView sotietbaonghi=new TextView(context);
					sotietbaonghi.setBackgroundColor(Color.parseColor("#bae8f4"));
					sotietbaonghi.setGravity(Gravity.CENTER);
					sotietbaonghi.setLayoutParams(layout);   
					sotietbaonghi.setText(lichnghiJson.getSotiet()+"");
					TextView sotietdabu=new TextView(context);
					sotietdabu.setBackgroundColor(Color.parseColor("#bae8f4"));
					sotietdabu.setGravity(Gravity.CENTER);
					sotietdabu.setLayoutParams(layout);   
					sotietdabu.setText(lichnghiJson.getSotietbu()+"");
					tableRow.addView(lopbaonghi);
					tableRow.addView(sotietbaonghi);
					tableRow.addView(sotietdabu);
					//
					
					
					TableRow tableRowbanghi = new TableRow(context);
					tableRowbanghi.setBackgroundColor(Color.parseColor("#d0dee9"));
					
					TextView txtsttBaonghi = new TextView(context);
					txtsttBaonghi.setBackgroundColor(Color.WHITE);
					txtsttBaonghi.setGravity(Gravity.CENTER);
					txtsttBaonghi.setLayoutParams(tableRowParams);   
					txtsttBaonghi.setText(i+"");
					TextView txtngayBaonghi = new TextView(context);
					txtngayBaonghi.setBackgroundColor(Color.WHITE);
					txtngayBaonghi.setGravity(Gravity.CENTER);
					txtngayBaonghi.setLayoutParams(tableRowParams);   
					txtngayBaonghi.setText(lichnghiJson.getNgaybao());
					TextView txtngaynghi = new TextView(context);
					txtngaynghi.setBackgroundColor(Color.WHITE);
					txtngaynghi.setGravity(Gravity.CENTER);
					txtngaynghi.setLayoutParams(tableRowParams);   
					txtngaynghi.setText(lichnghiJson.getNgayngi());
					TextView txtsotietnghi = new TextView(context);
					txtsotietnghi.setBackgroundColor(Color.WHITE);
					txtsotietnghi.setGravity(Gravity.CENTER);
					txtsotietnghi.setLayoutParams(tableRowParams);   
					txtsotietnghi.setText(lichnghiJson.getSotiet()+"");
					
					TextView txtsotietbus = new TextView(context);	
					txtsotietbus.setGravity(Gravity.CENTER);
					txtsotietbus.setBackgroundColor(Color.WHITE);
					txtsotietbus.setLayoutParams(tableRowParams);   
					
					tableRowbanghi.addView(txtsttBaonghi);
					tableRowbanghi.addView(txtngayBaonghi);
					tableRowbanghi.addView(txtngaynghi);
					tableRowbanghi.addView(txtsotietnghi);
					tableRowbanghi.addView(txtsotietbus);
					//
					//
					tablebaobu.addView(tableRow);
					tablebaobu.addView(tableRowbanghi);
					for (LichbaobuJson lichbaobuJson : lichbaobus) {
						i++;
						TableRow tableRowbaobu = new TableRow(context);
						tableRowbanghi.setBackgroundColor(Color.parseColor("#d0dee9"));
						
						TextView txtsttBaobu = new TextView(context);
						txtsttBaobu.setGravity(Gravity.CENTER);
						txtsttBaobu.setLayoutParams(tableRowParams);  
						txtsttBaobu.setBackgroundColor(Color.parseColor("#ffccff"));
						txtsttBaobu.setText(i+"");
						
						TextView txtngayBaobu= new TextView(context);
						txtngayBaobu.setBackgroundColor(Color.parseColor("#ffccff"));
						txtngayBaobu.setGravity(Gravity.CENTER);
						txtngayBaobu.setLayoutParams(tableRowParams);   
						txtngayBaobu.setText(lichbaobuJson.getNgaybao());
						
						TextView txtngaybu= new TextView(context);
						txtngaybu.setGravity(Gravity.CENTER);
						txtngaybu.setLayoutParams(tableRowParams);   
						txtngaybu.setBackgroundColor(Color.parseColor("#ffccff"));
						txtngaybu.setText(lichbaobuJson.getNgayday());
						
						TextView txtsotietnghis = new TextView(context);	
						txtsotietnghis.setGravity(Gravity.CENTER);
						txtsotietnghis.setBackgroundColor(Color.parseColor("#ffccff"));
						txtsotietnghis.setLayoutParams(tableRowParams);  
						
						TextView txtsotietbu = new TextView(context);						
						txtsotietbu.setGravity(Gravity.CENTER);
						txtsotietbu.setLayoutParams(tableRowParams);   
						txtsotietbu.setBackgroundColor(Color.parseColor("#ffccff"));
						txtsotietbu.setText(lichbaobuJson.getSotietbu()+"");
						
						tableRowbaobu.addView(txtsttBaobu);
						tableRowbaobu.addView(txtngayBaobu);
						tableRowbaobu.addView(txtngaybu);
						tableRowbaobu.addView(txtsotietnghis);
						tableRowbaobu.addView(txtsotietbu);
						tablebaobu.addView(tableRowbaobu);
						
					}
					//
					i=0;
				}
			}
		} catch (Exception e) {
			e.printStackTrace();
			// TODO: handle exception
		}
	}
}
