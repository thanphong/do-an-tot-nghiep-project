package GvDut.Net;

import java.util.List;

import GvDut.services.GetDataJson;
import GvDut.services.NewsJson;

import android.content.Intent;
import android.graphics.Color;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.ActionBarDrawerToggle;
import android.support.v4.widget.DrawerLayout;
import android.text.Html;
import android.util.Log;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.AdapterView.OnItemClickListener;

public class MainActivity extends AbtractActivity {

	LinearLayout layoutNews;

	@Override
	public void init() {
		// TODO Auto-generated method stub
		layoutNews = (LinearLayout) findViewById(R.id.linearNews);
	}

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		getListNews();
	}

	@Override
	public int getLayoutContent() {
		// TODO Auto-generated method stub
		return R.layout.activity_main;
	}

	@Override
	public void addButtonListener() {
		// TODO Auto-generated method stub

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
		String[] menu=getResources().getStringArray(R.array.Menu);
		if(mgv!=0){
			menu[menu.length-1]="Thoát";
		}
		// Creating an ArrayAdapter to add items to the listview mDrawerList
		ArrayAdapter<String> adapter = new ArrayAdapter<String>(
				getBaseContext(), R.layout.drawer_list_item,menu);

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
				Intent t ;
				if (mgv == 0 && position!=0) {
					t = new Intent(MainActivity.this, LoginActivity.class);
					startActivity(t);
				} else {
					switch (position) {
					case stateHome:
						t = new Intent(MainActivity.this, MainActivity.class);
						startActivity(t);
						break;
					case stateDangnhap:
						mgv=0;
						t = new Intent(MainActivity.this, MainActivity.class);
						startActivity(t);
						break;
					case stateThoiKhoabieu:
						t = new Intent(MainActivity.this,
								ThoiKhoaBieuActivity.class);
						startActivity(t);
						break;
					case stateBaonghi:
						t = new Intent(MainActivity.this,
								BaonghiActivity.class);
						startActivity(t);
						break;
					case stateXemphong:
						break;
					case stateBaobu:
						t = new Intent(MainActivity.this,
								BaobuActivity.class);
						
						startActivity(t);
						break;
					case stateSms:
						t = new Intent(MainActivity.this,
								SmsActivity.class);
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

	public void getListNews() {
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
				LinearLayout.LayoutParams tableRowParams = new LinearLayout.LayoutParams(new ViewGroup.MarginLayoutParams(
						LinearLayout.LayoutParams.MATCH_PARENT,
						LinearLayout.LayoutParams.WRAP_CONTENT));
				tableRowParams.setMargins(1, 1, 1,1);
				
				for (NewsJson newsJson : listNews) {
					LinearLayout mylayoutNews=new LinearLayout(this);
					mylayoutNews.setLayoutParams(tableRowParams);
					mylayoutNews.setBackgroundDrawable(getResources().getDrawable(R.drawable.my_custom_background));
					TextView tieude = (TextView) getLayoutInflater().inflate(
							R.layout.textview_styles, null);
					tt = "<b><span ><font color='red'>" + newsJson.getNgay()
							+ ":</font></span></b>&nbsp;&nbsp;&nbsp;&nbsp;";
					tt += "<span ><font color='#009900'>"
							+ newsJson.getTieude() + "</font></span>";
					tt += "<div>" + newsJson.getNoidung() + "</div>";
					tieude.setText(Html.fromHtml(tt));
					tieude.setPadding(5, 5, 5, 0);
					tieude.setBackgroundColor(Color.WHITE);
					tieude.setLayoutParams(tableRowParams);
					mylayoutNews.addView(tieude);
					layoutNews.addView(mylayoutNews);
				}
			}
		} catch (Exception e) {
			Log.d("err", e.toString());
			e.fillInStackTrace();
		}
	}

}
