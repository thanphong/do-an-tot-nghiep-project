package GvDut.Net;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.List;

import GvDut.services.GetDataJson;
import GvDut.services.TkbieuJson;
import android.app.AlertDialog;
import android.app.Dialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.drawable.ColorDrawable;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.ActionBarDrawerToggle;
import android.support.v4.widget.DrawerLayout;
import android.view.Gravity;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TableLayout;
import android.widget.TableRow;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.AdapterView.OnItemClickListener;

public class BaonghiActivity extends AbtractActivity {
	TableLayout tkbieubaonghi;
	Button btbaobu;
	Context context = this;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		getTkBieuBaonghi();
	}

	@Override
	public void init() {
		// TODO Auto-generated method stub
		tkbieubaonghi = (TableLayout) findViewById(R.id.TKbieuBaonghi);
		btbaobu = (Button) findViewById(R.id.btbaonghi);
	}

	@Override
	public int getLayoutContent() {
		// TODO Auto-generated method stub
		return R.layout.baongi_layout;
	}

	@Override
	protected Dialog onCreateDialog(int id) {
		// TODO Auto-generated method stub
		AlertDialog.Builder builder = new AlertDialog.Builder(this);
		final Dialog dialog;
		builder.setTitle("Thông báo!");
		builder.setMessage("Chưa chọn lớp báo nghỉ!").setNegativeButton("Ok",
				new DialogInterface.OnClickListener() {

					public void onClick(DialogInterface dialog, int which) {
						// TODO Auto-generated method stub
						dialog.cancel();
					}

				});
		dialog = builder.create();
		return dialog;
		// return super.onCreateDialog(id);
	}

	@Override
	public void addButtonListener() {
		// TODO Auto-generated method stub
		btbaobu.setOnClickListener(new OnClickListener() {
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				if (tkbieuJsons.size() < 1) {
					showDialog(0);
				} else {
					Intent t = new Intent(BaonghiActivity.this,
							FormBaonghiActivity.class);
					String json = TkbieuJson.toJsonArray(tkbieuJsons);
					t.putExtra("listTkb", json);
					// t.putExtra("magv", mgv);
					startActivity(t);
				}
			}
		});
	}

	@Override
	public void setDrawerLayout() {
		// TODO Auto-generated method stub
		// TODO Auto-generated method stub
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
				if (mgv == 0) {
					t = new Intent(BaonghiActivity.this, LoginActivity.class);
					startActivity(t);
				} else {
					switch (position) {
					case stateHome:
						t = new Intent(BaonghiActivity.this, MainActivity.class);
						startActivity(t);
						break;
					case stateDangnhap:
						mgv = 0;
						t = new Intent(BaonghiActivity.this, MainActivity.class);
						startActivity(t);
						break;
					case stateThoiKhoabieu:
						t = new Intent(BaonghiActivity.this,
								ThoiKhoaBieuActivity.class);
						startActivity(t);
						break;
					case stateBaobu:
						t = new Intent(BaonghiActivity.this,
								BaobuActivity.class);
						startActivity(t);
						break;
					case stateXemphong:
						break;
					case stateBaonghi:
						t = new Intent(BaonghiActivity.this,
								BaonghiActivity.class);

						startActivity(t);
						break;
					case stateSms:
						t = new Intent(BaonghiActivity.this, SmsActivity.class);
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

	private void getTkBieuBaonghi() {
		// TODO Auto-generated method stub
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
				tableRowParams.width = ViewGroup.LayoutParams.MATCH_PARENT;
				tableRowParams.height = ViewGroup.LayoutParams.MATCH_PARENT;
				tableRowParams.weight = 1;
				TableRow.LayoutParams tableRowParamscheck = new TableRow.LayoutParams();
				tableRowParamscheck.setMargins(1, 1, 1, 1);
				tableRowParamscheck.width = ViewGroup.LayoutParams.WRAP_CONTENT;
				tableRowParamscheck.height = ViewGroup.LayoutParams.WRAP_CONTENT;
				final SimpleDateFormat formatter = new SimpleDateFormat("yyyy-MM-dd");
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

					tableRow.addView(tvstt, tableRowParams);
					tableRow.addView(tvLhp, tableRowParams);
					tableRow.addView(tvtkb, tableRowParams);

					tableRow.setOnClickListener(new OnClickListener() {

						@Override
						public void onClick(View v) {
							// TODO Auto-generated method stub

							ColorDrawable txtcolor = (ColorDrawable) tvstt
									.getBackground();
							try {
								if (comparedateNow(formatter.parse(tkbieuJson
										.getNgayketthuc()))) {
									if (txtcolor.getColor() == Color.WHITE) {
										tkbieuJsons.add(tkbieuJson);
										tvstt.setBackgroundColor(Color.BLUE);
									} else {
										tkbieuJsons.remove(tkbieuJson);
										tvstt.setBackgroundColor(Color.WHITE);
									}
								}else{
									Toast.makeText(context, "Lớp học phần đã hết thời gian học!",
											Toast.LENGTH_SHORT).show();
								}
							} catch (ParseException e) {
								// TODO Auto-generated catch block
								e.printStackTrace();
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
	public boolean comparedateNow(Date date) {
		Calendar calendare = Calendar.getInstance();
		if (calendare.getTime().compareTo(date) < 0)
			return true;
		return false;

	}
}
