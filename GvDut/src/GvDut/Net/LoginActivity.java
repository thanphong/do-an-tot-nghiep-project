package GvDut.Net;

import GvDut.services.AccountJson;
import GvDut.services.GetDataJson;
import android.app.AlertDialog;
import android.app.Dialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.ActionBarDrawerToggle;
import android.support.v4.widget.DrawerLayout;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.AdapterView.OnItemClickListener;
import android.view.View.OnClickListener;

public class LoginActivity extends AbtractActivity {

	Button btLogin;
	EditText edUsername;
	EditText edPass;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
	}

	@Override
	public void init() {
		// TODO Auto-generated method stub
		btLogin = (Button) findViewById(R.id.btlogin);
		edUsername = (EditText) findViewById(R.id.username);
		edPass = (EditText) findViewById(R.id.pass);
	}

	@Override
	public int getLayoutContent() {
		// TODO Auto-generated method stub
		return R.layout.login_layout;
	}

	@Override
	protected Dialog onCreateDialog(int id) {
		// TODO Auto-generated method stub
		
		AlertDialog.Builder builder = new AlertDialog.Builder(this);
		final Dialog dialog;
		builder.setTitle("Thông báo!");
		switch (id) {
		case success:
			builder.setMessage("Đăng nhập thành công!").setNegativeButton("Ok",
					new DialogInterface.OnClickListener() {
						public void onClick(DialogInterface dialog, int which) {
							// TODO Auto-generated method stub
							Intent t=new Intent(LoginActivity.this,MainActivity.class);
							startActivity(t);
						}

					});
			dialog = builder.create();
			return dialog;
		case error:
			builder.setMessage("Đăng nhập thất bại!").setNegativeButton("Ok",
					new DialogInterface.OnClickListener() {

						public void onClick(DialogInterface dialog, int which) {
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
		btLogin.setOnClickListener(new OnClickListener() {
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
						ten=account.getAccountName();
						showDialog(success);
						// Log.d("username", account.getAccountName());
					}
					else{
						showDialog(error);
					}
				} catch (Exception e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
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
				switch (position) {
				case stateHome:
					t = new Intent(LoginActivity.this, MainActivity.class);
					startActivity(t);
					break;
				case stateBaobu:
					t = new Intent(LoginActivity.this,
							BaobuActivity.class);
					startActivity(t);
					break;
				case stateBaonghi:
					t = new Intent(LoginActivity.this,
							BaonghiActivity.class);
					startActivity(t);
					break;
				case stateDangnhap:
					
					break;
				case stateXemphong:
					break;
				case stateThoiKhoabieu:
					t = new Intent(LoginActivity.this,
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
		});
	}

}
