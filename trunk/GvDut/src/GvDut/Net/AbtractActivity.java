package GvDut.Net;

import java.util.ArrayList;
import java.util.Calendar;

import GvDut.services.TkbieuJson;
import android.app.Activity;

import android.os.Bundle;
import android.support.v4.app.ActionBarDrawerToggle;
import android.support.v4.widget.DrawerLayout;
import android.view.Menu;
import android.view.MenuItem;

import android.widget.ListView;


public abstract class AbtractActivity extends Activity {
	static final int DATE_DIALOG_ID = 100;
	static final int stateHome=0;
	static final int stateThoiKhoabieu=1;
	static final int stateXemphong=2;
	static final int stateBaonghi=3;
	static final int stateBaobu=4;
	static final int success=0;
	static final int error=-1;
	static final int stateDangnhap = 5;
	DrawerLayout mDrawerLayout;
	// ListView represents Navigation Drawer
	ListView mDrawerList;

	// ActionBarDrawerToggle indicates the presence of Navigation Drawer in the
	// action bar
	ActionBarDrawerToggle mDrawerToggle;
	// Title of the action bar
	String mTitle = "";
	static int mgv;
	static String ten;
	static Menu menus;
	public int year;
	public int month;
	public int day;
	ArrayList<TkbieuJson> tkbieuJsons = new ArrayList<TkbieuJson>();
	public abstract void init();
	public abstract int getLayoutContent();	
	public abstract void addButtonListener();
	public abstract void setDrawerLayout();
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(getLayoutContent());
		init();
		addButtonListener();
		setDrawerLayout();
		getCurrentDate();
	}

	@Override
	protected void onPostCreate(Bundle savedInstanceState) {
		super.onPostCreate(savedInstanceState);
		mDrawerToggle.syncState();
	}

	/** Handling the touch event of app icon */
	@Override
	public boolean onOptionsItemSelected(MenuItem item) {
		if (mDrawerToggle.onOptionsItemSelected(item)) {
			return true;
		}
		return super.onOptionsItemSelected(item);
	}

	/** Called whenever we call invalidateOptionsMenu() */
	@Override
	public boolean onPrepareOptionsMenu(Menu menu) {
		// If the drawer is open, hide action items related to the content view
		boolean drawerOpen = mDrawerLayout.isDrawerOpen(mDrawerList);

		menu.findItem(R.id.action_settings).setVisible(!drawerOpen);
		return super.onPrepareOptionsMenu(menu);
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.main, menu);
		menus=menu;
		MenuItem bedMenuItem = menu.findItem(R.id.action_settings);
		if(mgv!=0){
			bedMenuItem.setTitle(ten);
		}
		else{
			bedMenuItem.setTitle("");
		}
		return true;
	}
	public void getCurrentDate(){
		final Calendar calendar = Calendar.getInstance();
		year = calendar.get(Calendar.YEAR);
		month = calendar.get(Calendar.MONTH);
		day = calendar.get(Calendar.DAY_OF_MONTH);
		
	}

}
