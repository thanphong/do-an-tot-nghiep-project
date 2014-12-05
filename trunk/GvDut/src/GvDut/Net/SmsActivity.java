package GvDut.Net;



import GvDut.services.GetDataJson;
import GvDut.services.LichnghiJson;
import GvDut.services.SmsJson;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.ActionBarDrawerToggle;
import android.support.v4.widget.DrawerLayout;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.AdapterView.OnItemClickListener;

public class SmsActivity extends AbtractActivity {

	Button btsms;
	EditText contentSms;
	TextView txtResult;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
	}

	@Override
	public void init() {
		// TODO Auto-generated method stub
		btsms=(Button)findViewById(R.id.btsms);
		contentSms=(EditText)findViewById(R.id.addr_edittext);
		txtResult=(TextView)findViewById(R.id.txtresult);
	}

	@Override
	public int getLayoutContent() {
		// TODO Auto-generated method stub
		return R.layout.sms_layout;
	}

	@Override
	public void addButtonListener() {
		// TODO Auto-generated method stub
		btsms.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				final String content=contentSms.getText().toString();
				try {
					final SmsJson lichnghiJson = new AsyncTask<String, Void, SmsJson>() {
						@Override
						protected SmsJson doInBackground(String... params) {
							// TODO Auto-generated method stub
							return  GetDataJson.sendsms(mgv,content);
						}
					}.execute("").get();
					if(lichnghiJson!=null){
						contentSms.setText("");
						txtResult.setText(lichnghiJson.getContent());
					}else{
						txtResult.setText("sai cu phap!");
					}
				} catch (Exception e) {
					e.printStackTrace();
					// TODO: handle exception
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
		String[] menu = getResources().getStringArray(R.array.Menu);
		if (mgv != 0) {
			menu[menu.length - 1] = "Thoát";
		}
		// Creating an ArrayAdapter to add items to the listview mDrawerList
		ArrayAdapter<String> adapter = new ArrayAdapter<String>(
				getBaseContext(), R.layout.drawer_list_item, menu);

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
				if (mgv == 0 && position != 0) {
					t = new Intent(SmsActivity.this, LoginActivity.class);
					startActivity(t);
				} else {
					switch (position) {
					case stateHome:
						t = new Intent(SmsActivity.this, MainActivity.class);
						startActivity(t);
						break;
					case stateDangnhap:
						mgv = 0;
						t = new Intent(SmsActivity.this, MainActivity.class);
						startActivity(t);
						break;
					case stateThoiKhoabieu:
						t = new Intent(SmsActivity.this,
								ThoiKhoaBieuActivity.class);
						startActivity(t);
						break;
					case stateBaonghi:
						t = new Intent(SmsActivity.this, BaonghiActivity.class);
						startActivity(t);
						break;
					case stateXemphong:
						break;
					case stateBaobu:
						t = new Intent(SmsActivity.this, BaobuActivity.class);

						startActivity(t);
						break;
					case stateSms:
						t = new Intent(SmsActivity.this, SmsActivity.class);
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

}
