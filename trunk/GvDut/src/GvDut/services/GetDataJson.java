package GvDut.services;


import java.net.URLDecoder;
import java.util.Collection;
import java.util.List;


import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;


import org.apache.http.client.ResponseHandler;

import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;

import org.apache.http.entity.ByteArrayEntity;


import org.apache.http.impl.client.BasicResponseHandler;
import org.apache.http.impl.client.DefaultHttpClient;


import org.apache.http.util.EntityUtils;


import android.util.Log;

public class GetDataJson {
	// public static final String sURL = "http://vnbus.sytes.net:8080/vnbus/";

	// public static final String sURL="123.25.100.146:8080";
	public static final String sURL = "http://10.0.2.2:8082/DoAn/Giangvienandroids";
	private static String sessionCookie = null;

	// -----------------------cac ham da hoan thanh

	public static AccountJson checkLogin(String id, String pass) {
		try {
			Log.d("a", "bgin");
			DefaultHttpClient httpclient = new DefaultHttpClient();
			HttpPost post = new HttpPost(sURL + "/checklocgin");

			AccountJson a = new AccountJson();
			a.setAccountName(id);
			a.setPass(pass);
			post.setHeader("Accept", "application/json");
			post.setHeader("Content-type", "application/json; charset=utf-8");
			String json=a.toJson();
			
			post.setEntity(new ByteArrayEntity(json.getBytes("UTF8")));
			post.setHeader("json", json);
			HttpResponse httpResponse = httpclient.execute(post);
			// Header[] headers = httpResponse.getAllHeaders();
			// for (int i = 0; i < headers.length; i++) {
			// Header h = headers[i];
			// if (h.getName().equals("Set-Cookie"))
			// sessionCookie = h.getValue();
			// Log.d("Header Value: ", h.getValue());
			// }
			
			HttpEntity entity1 = httpResponse.getEntity();
			String s = EntityUtils.toString(entity1);
			Log.d("dee", s);
			return AccountJson.fromJsonToObject(URLDecoder.decode(s,"UTF-8"));

		} catch (Exception e) {
			// TODO Auto-generated catch block
			return null;
		}
	}
	public static String getTest(int id) {	
		// oracle = new URL("http://10.0.2.2:8080/vnbus/ss/ss");
		try {
			String Url= sURL + "/test/"+id;
			DefaultHttpClient Client = new DefaultHttpClient();
			HttpGet httpget = new HttpGet(Url);
			httpget.setHeader("Accept", "application/json");
			httpget.setHeader("Content-type", "application/json; charset=utf-8");
			//httpget.setHeader("Cookie", sessionCookie);

			ResponseHandler<String> responseHandler = new BasicResponseHandler();
			String SetServerString = Client.execute(httpget, responseHandler);
			Log.d("a", SetServerString);
			return SetServerString;
		} catch (Exception e) {
			// TODO Auto-generated catch block
			Log.d("err", e.toString());
			e.printStackTrace();
		}
		return null;
		// System.out.println(oracle.openStream());

	}

	public static Collection<NewsJson> getListNews() {
		// TODO Auto-generated method stub
		try {
			String Url= sURL + "/getNews/";
			DefaultHttpClient Client = new DefaultHttpClient();
			HttpGet httpget = new HttpGet(Url);
			httpget.setHeader("Accept", "application/json");
			httpget.setHeader("Content-type", "application/json; charset=utf-8");
			//httpget.setHeader("Cookie", sessionCookie);

			ResponseHandler<String> responseHandler = new BasicResponseHandler();
			String SetServerString = Client.execute(httpget, responseHandler);
			Log.d("a", SetServerString);
			return NewsJson.fromJsonArrayToObject(SetServerString);
		} catch (Exception e) {
			// TODO Auto-generated catch block
			Log.d("err", e.toString());
			e.printStackTrace();
		}
		return null;
	}
	public static List<TkbieuJson> getThoikhoabieu(int mgv) {
		// TODO Auto-generated method stub
		try {
			String Url= sURL + "/getTkbieu/"+mgv;
			DefaultHttpClient Client = new DefaultHttpClient();
			HttpGet httpget = new HttpGet(Url);
			httpget.setHeader("Accept", "application/json");
			httpget.setHeader("Content-type", "application/json; charset=utf-8");
			//httpget.setHeader("Cookie", sessionCookie);

			ResponseHandler<String> responseHandler = new BasicResponseHandler();
			String SetServerString = Client.execute(httpget, responseHandler);
			Log.d("a", SetServerString);
			return (List<TkbieuJson>) TkbieuJson.fromJsonArrayToObject(SetServerString);
		} catch (Exception e) {
			// TODO Auto-generated catch block
			Log.d("err", e.toString());
			e.printStackTrace();
		}
		return null;
	}
	public static List<TkbieuJson> baongi(int mgv, List<TkbieuJson> tkbieuJsons) {
		// TODO Auto-generated method stub
		try {
			String Url= sURL + "/baonghi/"+mgv;
			String json=TkbieuJson.toJsonArray(tkbieuJsons);
			DefaultHttpClient httpclient = new DefaultHttpClient();
			HttpPost post = new HttpPost(Url);
			post.setHeader("Accept", "application/json");
			post.setHeader("Content-type", "application/json; charset=utf-8");
			post.setEntity(new ByteArrayEntity(json.getBytes("UTF8")));
			post.setHeader("json", json);
			HttpResponse httpResponse = httpclient.execute(post);
			HttpEntity entity1 = httpResponse.getEntity();
			String s = EntityUtils.toString(entity1);
			Log.d("a", s);
			return (List<TkbieuJson>) TkbieuJson.fromJsonArrayToObject(s);
		} catch (Exception e) {
			// TODO Auto-generated catch block
			Log.d("err", e.toString());
			e.printStackTrace();
		}
		return null;
	}
	public static List<TkbBaonghiJson> getLichnghi(int mgv) {
		// TODO Auto-generated method stub
		try {
			String Url= sURL + "/getLichnghi/"+mgv;
			DefaultHttpClient Client = new DefaultHttpClient();
			HttpGet httpget = new HttpGet(Url);
			httpget.setHeader("Accept", "application/json");
			httpget.setHeader("Content-type", "application/json; charset=utf-8");
			//httpget.setHeader("Cookie", sessionCookie);

			ResponseHandler<String> responseHandler = new BasicResponseHandler();
			String SetServerString = Client.execute(httpget, responseHandler);
			Log.d("a", SetServerString);
			return (List<TkbBaonghiJson>) TkbBaonghiJson.fromJsonArrayToObject(SetServerString);
		} catch (Exception e) {
			// TODO Auto-generated catch block
			Log.d("err", e.toString());
			e.printStackTrace();
		}
		return null;
	}
	public static List<PhongJson> getPhongs(int mgv,LichbaobuJson lichbaobuJson) {
		// TODO Auto-generated method stub
		try {
			String Url= sURL + "/getPhong/"+mgv;
			String json=lichbaobuJson.toJson();
			DefaultHttpClient httpclient = new DefaultHttpClient();
			HttpPost post = new HttpPost(Url);
			post.setHeader("Accept", "application/json");
			post.setHeader("Content-type", "application/json; charset=utf-8");
			post.setEntity(new ByteArrayEntity(json.getBytes("UTF8")));
			post.setHeader("json", json);
			HttpResponse httpResponse = httpclient.execute(post);
			HttpEntity entity1 = httpResponse.getEntity();
			String s = EntityUtils.toString(entity1);
			Log.d("a", s);
			return (List<PhongJson>) PhongJson.fromJsonArrayToObject(s);
		} catch (Exception e) {
			// TODO Auto-generated catch block
			Log.d("err", e.toString());
			e.printStackTrace();
		}
		return null;
	}

}
