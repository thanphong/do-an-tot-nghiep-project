package GvDut.Net;

import java.util.ArrayList;
import java.util.List;

import GvDut.services.GetDataJson;
import GvDut.services.LichbaobuJson;
import GvDut.services.LichnghiJson;
import GvDut.services.TkbBaonghiJson;
import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.ActionBarDrawerToggle;
import android.support.v4.widget.DrawerLayout;

import android.util.Log;
import android.view.Gravity;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TableRow;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.TableLayout;

public class BaobuActivity extends AbtractActivity {

	TableLayout tablebaobu;
	Context context=this;
	List<LichnghiJson>lichnghis=new ArrayList<LichnghiJson>();;
	Button btbaobu;
	@Override
	public void init() {
		// TODO Auto-generated method stub
		tablebaobu=(TableLayout)findViewById(R.id.TKbieuBaobu);
		btbaobu=(Button)findViewById(R.id.btbaobu);
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
		btbaobu.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				if(lichnghis.size()>0){
					Intent t=new Intent(BaobuActivity.this,FormBaobuActivity.class);
					t.putExtra("lichnghiJson",LichnghiJson.toJsonArray(lichnghis) );
					startActivity(t);
				}
				else{
					Toast.makeText(BaobuActivity.this, "Bạn chưa chọn lớp học phần!",
							Toast.LENGTH_SHORT).show();
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
					case stateSms:
						t = new Intent(BaobuActivity.this,
								SmsActivity.class);
						startActivity(t);
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
			final List<TkbBaonghiJson> tkbBaonghiJsons = new AsyncTask<String, Void, List<TkbBaonghiJson>>() {
				@Override
				protected List<TkbBaonghiJson> doInBackground(String... params) {
					// TODO Auto-generated method stub
					return (List<TkbBaonghiJson>) GetDataJson.getLichnghi(mgv);
				}
			}.execute("").get();
			if(tkbBaonghiJsons!=null){
				int i = 1;
				
				TableRow.LayoutParams tableRowParams = new TableRow.LayoutParams();
				tableRowParams.setMargins(1, 1, 1, 1);
				tableRowParams.weight = 1;
				TableRow.LayoutParams tableRowParamsbaonghi = new TableRow.LayoutParams();
				tableRowParamsbaonghi.setMargins(0, 1, 0, 1);
				tableRowParamsbaonghi.weight = 1;
				tableRowParamsbaonghi.span=3;
				TableRow.LayoutParams layout=new TableRow.LayoutParams(TableRow.LayoutParams.FILL_PARENT, TableRow.LayoutParams.FILL_PARENT);
				layout.setMargins(0, 1, 0, 1);
				for (final TkbBaonghiJson tkbBaonghiJson : tkbBaonghiJsons) {
					TableRow tableRow = new TableRow(context);
					tableRow.setBackgroundColor(Color.parseColor("#d0dee9"));
					TextView lopbaonghi = new TextView(context);
					lopbaonghi.setBackgroundColor(Color.parseColor("#bae8f4"));
					lopbaonghi.setGravity(Gravity.LEFT);
					lopbaonghi.setText("["+tkbBaonghiJson.getMaLophp()+"]"+tkbBaonghiJson.getLophp());
					lopbaonghi.setLayoutParams(tableRowParamsbaonghi);  
					
					TextView sotietbaonghi=new TextView(context);
					sotietbaonghi.setBackgroundColor(Color.parseColor("#bae8f4"));
					sotietbaonghi.setGravity(Gravity.LEFT);
					sotietbaonghi.setLayoutParams(layout);   
					sotietbaonghi.setText(tkbBaonghiJson.getSoTietBaoNghi()+"");
					
					TextView sotietdabu=new TextView(context);
					sotietdabu.setBackgroundColor(Color.parseColor("#bae8f4"));
					sotietdabu.setGravity(Gravity.LEFT);
					sotietdabu.setLayoutParams(layout);   
					sotietdabu.setText(tkbBaonghiJson.getSoTietBaoBu()+"");
					
					tableRow.addView(lopbaonghi);
					tableRow.addView(sotietbaonghi);
					tableRow.addView(sotietdabu);
					
					tablebaobu.addView(tableRow);
					List<LichnghiJson>lichnghiJsons=(List<LichnghiJson>) LichnghiJson.fromJsonArrayToObject(tkbBaonghiJson.getLichnghi());
					for (final LichnghiJson lichnghiJson : lichnghiJsons) {
						TableRow  tbrowbaonghi=new TableRow(context);
						tbrowbaonghi.setBackgroundColor(Color.parseColor("#d0dee9"));
						
						final TextView txtsttBaonghi = new TextView(context);
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
						
						tbrowbaonghi.addView(txtsttBaonghi);
						tbrowbaonghi.addView(txtngayBaonghi);
						tbrowbaonghi.addView(txtngaynghi);
						tbrowbaonghi.addView(txtsotietnghi);
						tbrowbaonghi.addView(txtsotietbus);
						
						tbrowbaonghi.setOnClickListener(new OnClickListener() {
							
							@Override
							public void onClick(View v) {
								// TODO Auto-generated method stub
								ColorDrawable txtcolor = (ColorDrawable) txtsttBaonghi
										.getBackground();
								if (txtcolor.getColor() == Color.WHITE) {
									lichnghiJson.setNgaybao(tkbBaonghiJson.getMaLophp());
									lichnghiJson.setTenLhp(tkbBaonghiJson.getLophp());
									lichnghis.add(lichnghiJson);
									txtsttBaonghi.setBackgroundColor(Color.BLUE);
								} else {
									lichnghis.remove(lichnghiJson);
									txtsttBaonghi.setBackgroundColor(Color.WHITE);
								}
								
							}
						});
						tablebaobu.addView(tbrowbaonghi);
						List<LichbaobuJson>lichbaobuJsons=(List<LichbaobuJson>) LichbaobuJson.fromJsonArrayToObject(lichnghiJson.getJsondaybu());
						for (LichbaobuJson lichbaobuJson : lichbaobuJsons) {
							i++;
							TableRow tableRowbaobu = new TableRow(context);
							tableRowbaobu.setBackgroundColor(Color.parseColor("#d0dee9"));
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
						i++;
					}
					i=1;
				}		
			}
		} catch (Exception e) {
			e.printStackTrace();
			// TODO: handle exception
		}
	}
}
